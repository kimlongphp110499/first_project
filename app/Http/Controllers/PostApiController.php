<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Post;

class PostApiController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100|unique:post,title',
            'content' => 'required|integer',
            'course_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $course = Course::where('id', $request->course_id)
            ->where('instructor_id', auth()->user()->id)
            ->first();

        if ($course) {
            $post = $course->create([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json([
                'message' => 'Post created successfully',
                'course' => $post
            ], 201);
        }

        return response()->json([
            'message' => `Course not exist. Can't make a post`,
            'course' => auth()->user()->courses()->where('id', $request->course_id)->create($request->all())
        ], 201);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $post = Post::where('id', $request->id)
            ->whereIn('course_id', auth()->user()->courses()->pluck('id'))
            ->first();

        if ($post) {
            $post = $course->create([
                'title' => $request->title,
                'content' => $request->content,
            ]);

            return response()->json([
                'message' => 'Access successfully',
                'post' => $post
            ], 201);
        }

        return response()->json([
            'message' => `You can't access this post`,
        ], 201);
    }
}