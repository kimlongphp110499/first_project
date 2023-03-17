<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Post;
use Validator;

class PostApiController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|between:2,100|unique:posts,title',
            'content' => 'required|string',
            'course_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $course = Course::where('id', $request->course_id)
            ->where('instructor_id', auth('instructor')->user()->id)
            ->first();

        if ($course) {
            $post = $course->posts()->create([
                'title' => $request->title,
                'content' => $request->content
            ]);

            return response()->json([
                'message' => 'Post created successfully',
                'post' => $post
            ], 201);
        }

        return response()->json([
            'message' => `Course not exist. Can't make a post`,
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
            ->whereIn('course_id', auth('student')->user()->userCourses()->pluck('course_id'))
            ->first();

        if ($post) {
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