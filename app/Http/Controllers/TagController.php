<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the tags.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Use the Tag model with posts count
        $tags = Tag::withCount('posts')->get();

        // If no tags found using the model, use the fallback
        if ($tags->isEmpty()) {
            // Get tags from posts
            $postTags = DB::table('posts')->select('tags')->get()->pluck('tags');

            // Process tags from json columns
            $processedTags = collect();
            $tagCounts = [];
            
            foreach ($postTags as $tagJson) {
                if (!empty($tagJson)) {
                    $tagsArray = json_decode($tagJson);
                    if (is_array($tagsArray)) {
                        foreach ($tagsArray as $tag) {
                            // Count each tag occurrence
                            if (!isset($tagCounts[$tag])) {
                                $tagCounts[$tag] = 0;
                            }
                            $tagCounts[$tag]++;
                            
                            // Only add to processed tags if not already there
                            if (!$processedTags->contains('name', $tag)) {
                                $tagObj = (object)[
                                    'id' => 0,
                                    'name' => $tag,
                                    'slug' => Str::slug($tag),
                                    'posts_count' => 0
                                ];
                                $processedTags->push($tagObj);
                            }
                        }
                    }
                }
            }
            
            // Set the correct posts count for each tag
            $processedTags = $processedTags->map(function($tag) use ($tagCounts) {
                $tag->posts_count = $tagCounts[$tag->name] ?? 0;
                return $tag;
            });

            // Sort by name
            $tags = $processedTags->sortBy('name')->values();
        }

        // Ensure $tags is always defined
        if (!isset($tags)) {
            $tags = collect();
        }

        return view('dashboard.tags.index', ['tags' => $tags]);
    }
}