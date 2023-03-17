<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Course;
use App\Models\UserCourse;

class CourseApiController extends Controller
{

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100|unique:courses,name',
            'amount' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        return response()->json([
            'message' => 'Course created successfully',
            'course' => auth('instructor')->user()->courses()->create($request->all())
        ], 201);
    }

    public function enroll(Request $request){
    	$validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        return response()->json([
            'message' => 'User successfully registered',
            'course' => auth()->user()->userCourse()->create($request->all())
        ], 201);
    }

    public function delete(Request $request){
    	$validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course = Course::find($request->course_id);
        if ($course) {
            $course->delete();

            return response()->json([
                'message' => 'Deleted course successfully',
            ], 201);
        }

        return response()->json([
            'message' => 'Course not exist'
        ], 201);
    }
}