<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Post;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\MarkdownConverter;
use App\Models\PageView;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Auth;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Transformers\TextNormalizer;
use Rubix\ML\Transformers\WordCountVectorizer;
use Rubix\ML\Transformers\TfIdfTransformer;
use Rubix\ML\Tokenizers\Word;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource with support for filters.
     *
     * Does not include pagination at the moment.
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('filterByTag')) {
            return view('post.index', [
                'title' => 'Posts with '. __('blog.tag') .' ' . $request->get('filterByTag'),
                'filter' => 'Filtered by '. __('blog.tag') .' "' . $request->get('filterByTag') . '"',
                'posts' => Post::whereJsonContains('tags', $request->get('filterByTag'))->get(),
            ]);
        }

        if ($request->has('author')) {
            $author = User::findOrFail($request->get('author'));

            return view('post.index', [
                'title' => 'Posts by ' . $author->name,
                'filter' => 'Filtered by author ' . $author->name,
                'posts' => $author->posts,
            ]);
        }

        return view('post.index', [
            'posts' => Post::all(),
        ]);
    }

    public function dashboardPosts(){
        $posts = Post::paginate(10);

        return view('dashboard.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Post::class);

        if (config('blog.easyMDE.enabled')) {
            if (!$request->has('draft_id')) {
                return redirect(route('posts.create', ['draft_id' => time()]));
            };

            return view('post.create', [
                'draft_id' => $request->get('draft_id'),
            ]);
        }

        return view('post.create');
    }

    /**
     * Store a new blog post.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return Illuminate\Http\Response
     */
    
     public function store(StorePostRequest $request)
     {
        $validated = $request->validated();
 
        if (isset($validated['tags'])) {
            $validated['tags'] = json_decode($validated['tags'], true);
        }
 
        return (new CreatesNewPost)->store($request->user(), $validated);
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        // Get post views
        $views = PageView::all();
        $post_url = '/' . 'posts/' . $post->slug;
        $views = $views->where('page', $post_url)->count();

        // Generate formatted HTML from markdown
        $markdown = (new MarkdownConverter($post->body))->toHtml();
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                if (!empty($post->tags)) {
                    foreach ($post->tags as $tag) {
                        $query->orWhereJsonContains('tags', $tag);
                    }
                }
            })
            ->get();
        
            return view('post.show', [
            'post' => $post,
            'markdown' => $markdown,
            'like_count' => $post->likes()->count(),
            'user_has_liked' => Auth::check() ? $post->likes()->where('likes.user_id', Auth::id())->exists() : false,
            'relatedPosts' => $relatedPosts,
            'postViews' => $views,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        if (config('blog.easyMDE.enabled')) {
            if (!$request->has('draft_id')) {
                return redirect(route('posts.edit', [
                    'post' => $post,
                    'draft_id' => time(),
                ]));
            };

            return view('post.edit', [
                'post' => $post,
                'draft_id' => $request->get('draft_id'),
            ]);
        }

        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // The incoming request is valid and authorized...
        
        // Retrieve the validated input data...
        $validated = $request->validated();
        
        // Check if post has tags set, and serialize them to array
        if (isset($validated['tags'])) {
            $validated['tags'] = json_decode($validated['tags'], true);
        }
        
        // Update the post
        $post->update($validated);

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Update the published_at date in the specified resource in storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function publish(Post $post)
    {
        $this->authorize('update', $post);

        $post->published_at = now();
        $post->save();
        return back()->with('success', 'Successfully Published Post!');
    }

    /**
     * Update the published_at date in the specified resource in storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function unpublish(Post $post)
    {
        $this->authorize('update', $post);

        $post->published_at = null;
        $post->save();
        return back()->with('success', 'Successfully Unpublished Post!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return back()->with('success', 'Successfully Deleted Post!');
    }

    /**
     * Toggle like for the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function like(Post $post)
    {
        $like = $post->likes()->where('likes.user_id', Auth::user()->id);

        // If the user has already liked the post, remove the like
        if ($like->exists()) {
            $like->delete();
            return back();
        }

        // Otherwise, create a new like for the post
        $like = $post->likes()->make([
            'user_id' => Auth::user()->id,
        ]);

        $notification = Notification::create([
            'type' => 'Like',
            'user_id' => $post->user->id,
            'content' => Auth::user()->name . " liked your post #" . $post->id,
        ]);

        $notification->timestamps = false;
        $notification->save();

        $like->timestamps = false;
        $like->save();

        return back();
    }

    /**
     * Toggle bookmark for the specified post.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function bookmark(Post $post)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->where('post_id', $post->id)->first();

        // If the user has already bookmarked the post, remove the bookmark
        if ($bookmark) {
            $bookmark->delete();
            return back();
        }

        // Otherwise, create a new bookmark for the post
        $bookmark = new Bookmark([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ]);
        $bookmark->timestamps = false;
        $bookmark->save();

        return back();
    }

    public function dashboardEdit($id){
        $post = Post::find($id);
        return view('dashboard.posts.edit', ['post' => $post]);
    }

    public function dashboardUpdate(Request $request, $id){
        $post = Post::find($id);
        // Update post fields
        $post->title = $request->input('title');
        $post->slug = $request->input('slug') ?: Str::slug($request->input('title'));
        $post->description = $request->input('description');
        $post->body = $request->input('body');
        $post->status = $request->input('status');
        $post->save();

        return redirect()->route('dashboard.posts.index');
    }

    public function dashboardDestroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('dashboard.posts.index');
    }
}