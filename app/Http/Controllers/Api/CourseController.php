<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;




class CourseController extends Controller
{
    //
    public function view_course(Request $request)
    {
        $revision=Course::all();
        $reply = [
            'failed' => false,
            'errors' => null,
            'data' => $revision,
        ];
        return response()->json($reply);
    }

//-------------------------------------------------------------
    public function register_course(Request $request)
    {


        $request->validate([
            'course_name' => 'required|string|min:6|max:100',
            'course_level' => 'required|string|min:6|max:100',
            'category_id'=>'required|string|min:6|max:8',

        ]);

        $user = new Course([
            'course_name' => $request->course_name,
            'course_level' => $request->course_level,
            'category_id' => $request->category_id,

        ]);


            if ($user->save()) {
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->plainTextToken;
                return response()->json([
                    'message' => 'Successfully register course!',
                    'accessToken' => $token,
                ], 201);
            } else {
                return response()->json(['error' => 'Provide proper details']);
            }


    }

    }
