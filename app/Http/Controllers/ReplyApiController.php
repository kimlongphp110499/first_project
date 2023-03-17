<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reply;
use Validator;

class ReplyApiController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'post_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $post = Post::where('id', $request->post_id)
            ->whereIn('course_id', auth('student')->user()->userCourses()->pluck('id'))
            ->first();

        if ($post) {
            $reply = Reply::create([
                'content' => $request->content,
                'user_id' => auth('student')->user()->id,
                'post_id' => $post->id
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
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $reply = Reply::find($request->rep_id);
        if ($reply && auth('instructor')->user()) {
            $reply->delete();

            return response()->json([
                'message' => 'Delete successfully'
            ], 201);
        }

        if ($reply && auth('student')->user() && in_array($request->rep_id, auth('student')->user()->replies()->pluck('id')->toArray())) {
            $reply->delete();

            return response()->json([
                'message' => 'Delete successfully'
            ], 201);
        }

        return response()->json([
            'message' => `You can't delete this reply`
        ], 201);
    }
}