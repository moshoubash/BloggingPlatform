<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        // Validate and get the post content
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $blogContent = $validatedData['body'];

        // Define stopwords
        $stopwords = ["i", "me", "my", "myself", "we", "our", "ours", "ourselves",
        "you", "your", "yours", "yourself", "yourselves", "he", "him", "his", "himself",
        "she", "her", "hers", "herself", "it", "its", "itself", "they", "them", "their",
        "theirs", "themselves", "what", "which", "who", "whom", "this", "that", "these",
        "those", "am", "is", "are", "was", "were", "be", "been", "being", "have", "has",
        "had", "having", "do", "does", "did", "doing", "a", "an", "the", "and", "but", "if",
        "or", "because", "as", "until", "while", "of", "at", "by", "for", "with", "about",
        "against", "between", "into", "through", "during", "before", "after", "above",
        "below", "to", "from", "up", "down", "in", "out", "on", "off", "over", "under",
        "again", "further", "then", "once", "here", "there", "when", "where", "why", "how",
        "all", "any", "both", "each", "few", "more", "most", "other", "some", "such", "no",
        "nor", "not", "only", "own", "same", "so", "than", "too", "very", "s", "t", "can",
        "will", "just", "don", "should", "now", "it's", "we're", "we'll", "they're", "can't", 
        "won't", "isn't", "don't", "he's", "she's", "i'm", "aren't", "government", "house", 
        'committee', 'would', 'speaker', 'motion', 'mr', 'mrs', 'ms', 'member', 'minister', 
        'canada', 'members', 'time', 'prime', 'one', 'parliament', 'us', 'bill', 'act', 'like', 
        'canadians', 'people', 'said', 'want', 'could', 'issue', 'today', 'hon', 'order', 'party', 
        'canadian', 'think', 'also', 'new', 'get', 'many', 'say', 'look', 'country', 'legislation',
        'law', 'department', 'two', 'day', 'days', 'madam', 'must', "that's", "okay",
        "thank", "really", "much", "there's", 'yes', 'no'];

        // Pre-process the current post
        $processedContent = $this->removeStopwords($blogContent, $stopwords);

        // Step 1: Normalize text
        $samples = [[$processedContent]];
        $normalizer = new TextNormalizer();
        $normalizer->transform($samples);
        $normalizedText = $samples[0][0];

        // Step 2: Retrieve all posts to create a corpus
        $allPosts = Post::all()->pluck('body')->toArray();

        // Preprocess all posts
        $corpus = [];
        foreach ($allPosts as $postContent) {
            $processedPost = $this->removeStopwords($postContent, $stopwords);
            $samples = [[$processedPost]];
            $normalizer->transform($samples);
            $corpus[] = $samples[0][0];
        }

        // Add the current post to the corpus
        $corpus[] = $normalizedText;

        // Step 3: Create dataset for the corpus
        $dataset = new Unlabeled(array_map(fn($text) => [$text], $corpus));

        // Step 4: Tokenize and vectorize the corpus
        $vectorizer = new WordCountVectorizer(PHP_INT_MAX, 1, 0.8);
        $dataset->apply($vectorizer);

        // Step 5: Apply TF-IDF to the corpus
        $tfidf = new TfIdfTransformer();
        $dataset->apply($tfidf);

        // Step 6: Extract TF-IDF scores for the current post
        $samples = $dataset->samples();
        $currentPostVector = $samples[array_key_last($samples)]; // Last sample is the current post

        // Tokenize the current post to get words
        $tokenizer = new Word();
        $words = $tokenizer->tokenize($normalizedText);

        // Remove duplicates from words while preserving order
        $uniqueWords = array_values(array_unique($words));

        // Pair words with their TF-IDF scores
        $wordScores = [];
        foreach ($uniqueWords as $index => $word) {
            if (isset($currentPostVector[$index])) {
                $wordScores[$word] = $currentPostVector[$index];
            }
        }

        // Sort by score in descending order
        arsort($wordScores);

        // Get top 5 words
        $tags = array_slice(array_keys($wordScores), 0, 5);

        // Convert tags to array
        $validatedData['tags'] = $tags;

        // Set default featured image if none is provided
        if (empty($validatedData['featured_image'])) {
            $validatedData['featured_image'] = 'https://placehold.co/960x640';
        }

        if($request->stripe_subscription_id == 1){
            $validatedData['is_premium'] = true;
        }

        // Create the post
        return (new CreatesNewPost)->store($request->user(), $validatedData);
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

    private function removeStopwords(string $text, array $stopwords): string
    {
        $stopwordsLookup = array_flip(array_map('strtolower', $stopwords));
        $words = preg_split('/\s+/', $text);
        $filteredWords = array_filter($words, function($word) use ($stopwordsLookup) {
            $word = preg_replace('/[^\p{L}\p{N}]/u', '', strtolower($word));
            return $word !== '' && !isset($stopwordsLookup[$word]);
        });
        return implode(' ', $filteredWords);
    }
}