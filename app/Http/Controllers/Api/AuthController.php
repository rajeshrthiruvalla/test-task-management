<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator  = Validator::make($request->all(),[
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json(["status"=>false,
                                     "message"=>$validator->errors()->first()],400);
        }
        if (Auth::attempt($validator->validated())) {
            $user=User::find(Auth::id());
            $token = $user->createToken('Token Name')->accessToken;
            return response()->json(["status"=>true,
                                     "message"=>"Login Successfully",
                                      "token"=>$token]);
        }

        return response()->json(["status"=>false,
                                 "message"=>"Invalid username or password"],401);
    }
    public function register(Request $request): JsonResponse
    {
        $validator  = Validator::make($request->all(),[
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password'=>'required|same:password'
        ]);
        if ($validator->fails()) {
            return response()->json(["status"=>false,
                                     "message"=>$validator->errors()->first()],400);
        }
         $user=new User();
         $user->name=$request->name;
         $user->email=$request->email;
         $user->password=$request->password;
         $user->save();

         $token = $user->createToken('Token Name')->accessToken;
         return response()->json(["status"=>true,
                                  "message"=>"Registered Successfully",
                                   "token"=>$token]);
    }
    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return response()->json(["status"=>true,
                                 "message"=>"Logout Successfully"]);
    }
}
