<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reply;

class ReplyApiController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|integer',
            'post_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $post = Post::where('id', $request->post_id)
            ->whereIn('course_id', auth('student')->user()->courses()->pluck('id'))
            ->first();

        if ($post) {
            $reply = $post->replies()->create([
                'content' => $request->content,
                'user_id' => auth('student')->user()->id,
            ]);

            return response()->json([
                'message' => 'Reply successfully',
                'post' => $reply,
            ], 201);
        }

        return response()->json([
            'message' => `You can't reply this post`,
        ], 201);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rep_id' => 'required|integer',
            'post_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $reply = Reply::find($request->rep_id);
        if ($reply && auth('instructor')->user()) {
            $reply->delete();
        }

        if ($reply && auth('user')->user() && in_array($request->rep_id ,auth('user')->user()->replies()->pluck('id'))) {
            $reply->delete();
        }

        return response()->json([
            'message' => `You can't delete this reply`,
        ], 201);
    }
}