<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|max:255',
            ]);
            
            if($validator->fails()) {
                return response([
                    'error' => $validator->errors()->all()
                ], 422);
            }

            $password = Hash::make($request->password);
            $remember_token = Str::random(env('TOKEN_LENGTH'));

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'remember_token' => $remember_token,
            ]);

            return response()->json([
                'status_code' => 200,
                'message' => 'Registration Successfull',
            ]);


        } catch (Exception $errors) {

            return response()->json([
                'status_code' => 500,
                'message' => 'Error Occured in Registration',
                'error' => $errors,
            ]);
        }
    }
    public function login(Request $request)
    {
        try {
            
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $password = Hash::make($request->password);
            if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                return response()->json([
                    'status_code' => 422,
                    'message' => 'Unathorized',
                ]);

            };

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {

                return response()->json([
                    'status_code' => 500,
                    'message' => 'Password Match',
                ]);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);

        }catch(Exception $errors) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error Occured in Registration',
                'error' => $errors,
            ]);
        }
    }
}
