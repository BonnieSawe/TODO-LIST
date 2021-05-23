<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthUserResource;
use  Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function current(Request $request)
    {
        return response()->json($request->user());
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email')
        ]);

        $user->token = $user->createToken('TODOAppToken')->plainTextToken;

        $success['data'] = new AuthUserResource($user);

        return $this->sendResponse($success, 'Registered successfully');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } 

        if (!Auth::attempt( request(['email', 'password']))) { 
            return $this->sendError('These credentials do not match our records.', null);
        }

        $user = auth()->user();
        $user->token = $user->createToken('TODOAppToken')->plainTextToken;

        $success['data'] = new AuthUserResource($user);

        return $this->sendResponse($success, 'Welcome back');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->sendResponse(null, 'See you later');

    }
}
