<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Tag
{
	public static function all()
	{
		$tags = DB::table('posts')->select('tags')->get()->pluck('tags');

		$tags = $tags->map(function ($item) {
			return json_decode($item);
		});

		$tags = $tags->flatten()->unique();

		return $tags;
	}
}
