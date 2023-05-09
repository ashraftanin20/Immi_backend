<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //

    public function createComment(Request $request) {
        try {
            
            /** @var Comment $comment */
            $comment = Comment::create(['comment_body' => $request['comment_body'], 'user_id' => $request['user_id'],
                                'post_id' => $request['post_id'], 'created_at' => now(), 'updated_at' => now()]);
            
            return response()->json(['comment' => $comment, 'message' => 'comment added successfully']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Something goes wrong while adding comment!',
                'error' => $e->getMessage(),
            ],500);
        }
       
    }

    public function getComments(Request $request) {
        /** @var Comment $comments */
        $comments = DB::table('comments')
                            ->join('users', 'comments.user_id', '=', 'users.id')
                            ->select('comments.*', 'users.name as user_name')
                            ->where('comments.post_Id', '=', $request['post_id'])
                            ->get();  
        return response()->json(['comments' => $comments, 'message' => 'Success']);
    }
}
