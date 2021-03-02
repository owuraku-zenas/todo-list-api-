<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function userData(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        // Auth::logout();

        // $request->session()->invalidate();

        // $request->user()->token()->revoke();

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Successfully Logged out',
        ]);

        // try {

        //     $revoked = $request->user->tokens()->where('id', $request->bearerToken())->delete();

        // } catch (Exception $errors) {
        //     return response()->json([
        //         'status_code' => 500,
        //         'message' => 'Error Occured in Revoking User Token',
        //         'error' => $errors,
        //     ]);
        // }


        $request->session()->regenerateToken();
    }
}
