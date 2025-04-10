<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TagsAnalyticsController extends Controller
{
    public function index()
    {
        // Get basic tag statistics
        $totalTags = Tag::count();

        $mostUsedTag = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first();

        $lastMonth = Carbon::now()->subMonth();
        $recentlyAddedTags = Tag::where('created_at', '>=', $lastMonth)->count();

        $unusedTags = Tag::doesntHave('posts')->count();

        // Get top 10 tags by post count
        $topTags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get();

        // Get top tags from this month
        $topMonthlyTags = Tag::withCount(['posts' => function($query) use ($lastMonth) {
                $query->where('posts.created_at', '>=', $lastMonth);
            }])
            ->orderBy('posts_count', 'desc')
            ->take(10)
            ->get()
            ->map(fn($tag) => [
                'name' => $tag->name,
                'monthly_count' => $tag->posts_count
            ]);

        // Get tag growth data (new tags per month for the last 6 months)
        $tagGrowthData = DB::table('tags')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Simulated related tags data
        $relatedTags = collect([
            ['name' => 'Laravel', 'co_occurrence' => 32],
            ['name' => 'PHP', 'co_occurrence' => 28],
            ['name' => 'JavaScript', 'co_occurrence' => 24],
            ['name' => 'Vue.js', 'co_occurrence' => 20],
            ['name' => 'React', 'co_occurrence' => 18],
            ['name' => 'CSS', 'co_occurrence' => 15],
            ['name' => 'Database', 'co_occurrence' => 12],
        ]);

        // Get tag engagement data
        $tagEngagementData = Tag::withCount('posts')
            ->with(['posts' => function($query) {
                $query->withCount(['likes', 'comments']);
            }])
            ->having('posts_count', '>', 0)
            ->take(8)
            ->get()
            ->map(fn($tag) => [
                'name' => $tag->name,
                'avg_likes' => round($tag->posts->avg('likes_count') ?? 0, 1),
                'avg_comments' => round($tag->posts->avg('comments_count') ?? 0, 1)
            ]);

        // Prepare main tags list
        $tags = Tag::withCount('posts')
            ->withCount(['posts as recent_posts_count' => function($query) use ($lastMonth) {
                $query->where('posts.created_at', '>=', $lastMonth);
            }])
            ->with(['posts' => function($query) {
                $query->latest();
            }])
            ->orderBy('posts_count', 'desc')
            ->paginate(15);

        // Calculate trend percentage and average engagement
        $tags->getCollection()->transform(function($tag) use ($lastMonth) {
            $prevMonth = Carbon::now()->subMonths(2)->startOfMonth();
            $prevMonthCount = Post::whereHas('tags', fn($query) => $query->where('tags.id', $tag->id))
                ->whereBetween('created_at', [$prevMonth, $lastMonth])
                ->count();

            $trend = ($prevMonthCount > 0)
                ? round((($tag->recent_posts_count - $prevMonthCount) / $prevMonthCount) * 100)
                : ($tag->recent_posts_count > 0 ? 100 : 0);

            $lastUsed = Post::whereHas('tags', fn($query) => $query->where('tags.id', $tag->id))
                ->latest()
                ->first()?->created_at;

            $avgEngagement = Post::whereHas('tags', fn($query) => $query->where('tags.id', $tag->id))
                ->withCount(['likes', 'comments'])->get()
                ->avg(fn($post) => ($post->likes_count + $post->comments_count)) ?? 0;

            $tag->trend = $trend;
            $tag->last_used = $lastUsed;
            $tag->avg_engagement = round($avgEngagement, 1);

            return $tag;
        });

        return view('dashboard.tags.analytics', compact(
            'totalTags', 
            'mostUsedTag', 
            'recentlyAddedTags', 
            'unusedTags',
            'topTags',
            'topMonthlyTags',
            'tagGrowthData',
            'relatedTags',
            'tagEngagementData',
            'tags'
        ));
    }
}
