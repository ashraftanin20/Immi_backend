<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Database\Query\JoinClause;

class PostController extends Controller
{
    public function posts() {
        /** @var Post $post */
        $posts = DB::table('categories')
                        ->join('posts', 'categories.id', '=', 'posts.category_id')
                        ->join('users', 'posts.send_id' ,'=', 'users.id')
                        ->select('categories.id as category_id', 'categories.name as category', 'posts.*', 'users.name')->get();
        return response()->json(['data' => $posts, 'message' => 'Success']);
    }

    public function latestPosts() {
        /** @var Post $post */
        $posts = DB::table('posts')->select('posts.id', 'posts.title', 'posts.post_body' )->latest()
                        ->limit(3)->get();
        return response()->json(['data' => $posts, 'message' => 'Success']);
    }

    public function post(Request $request) {
        /** @var Post $post */
        $post = DB::table('posts')
                            ->join('categories', 'posts.category_id', '=', 'categories.id')
                            ->join('users', 'posts.send_id', '=', 'users.id')
                            ->select('categories.name as category', 'posts.*', 'users.name as user_name')
                            ->where('posts.id', '=', $request['id'])
                            ->get()->first();  
        return response()->json(['post' => $post, 'message' => 'Success']);
    }

    public function createPost(Request $request) {
        try {
            
            /** @var Post $post */
            $post = Post::create(['title' => $request['title'], 'post_body' => $request['post_body'],
                                'send_id' => $request['user_id'], 'category_id' => $request['category_id'],
                            'created_at' => now(), 'updated_at' => now()]);
            
            return response()->json(['post' => $post, 'message' => 'post created successfully']);
            //\Log::error($request);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while creating post!',
                'error' => $e->getMessage(),
            ],500);
        }
       
    }
}
