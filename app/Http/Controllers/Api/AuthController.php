<?php

namespace App\Http\Controllers\Api;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;


class AuthController extends Controller
{
    //

    public function register_student(Request $request)
    {

        $request->validate([
            'username' => 'required|string|min:6|max:100|unique:students',
            'name' => 'required|string|min:6|max:100',
            'password'=>'required|string|min:6|max:8',
            'phone_number'=>'required|string|min:11|max:11',
            'address'=>'required|string|min:10|max:100',
            'email'=>'required|string|min:25|max:100|unique:students',
            'image_id'=>'required|numeric',
            'gender_id'=>'required|numeric',
        ]);

        $user = new Student([
            'username'  => $request->username,
            'name'  => $request->name,
            'password' => bcrypt($request->password),
            'confirm_password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'image_id' => $request->image_id,
            'gender_id' => $request->gender_id,
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;
            return response()->json([
                'message' => 'Successfully created student!',
                'accessToken'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = request(['username','password']);
        $token = Auth::attempt($credentials);
        if(!Auth::attempt($credentials))
        {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'accessToken' =>$token,
            'user' =>$user,
            'token_type' => 'Bearer',
        ]);

    }



    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);

    }

}
