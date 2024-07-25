<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => ['required'],
            'lname' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(6), 'confirmed'] // password_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $request->only(['fname', 'lname', 'email', 'password']);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $user = User::create($validatedData);

            Auth::login($user);

            return response()->json([
                'success' => true,
                'redirect' => route('index')
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to register: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'An error occurred'
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Extract credentials from request
        $credentials = $request->only('email', 'password');

        // Check if authentication is successful
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'email' => 'Wrong Credentials'
                ]
            ], 422);
        }

        // Regenerate the session
        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'redirect' => route('index')
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('auth.index');
    }
}