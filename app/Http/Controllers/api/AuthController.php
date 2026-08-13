<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\ForgetPassword;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken('mobile')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function forget(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'email' => 'required|exists:users,email'
        ], [
            'required' => 'The :attribute field is required.',
            'email.exists' => 'email not found'
        ])->validate();
        $user = ForgetPassword::where('email', '=', $valid['email'])->latest()->first();
        if ($user && now() < $user->created_at->addMinutes(5)) {
            return response()->json([
                'message' => 'Please wait for 5 minutes before requesting another reset email.'
            ], 429);
        }
        DB::beginTransaction();
        $token = Str::random(120);
        $hash = Hash::make($token);
        try {
            ForgetPassword::create([
                'email' => $valid['email'],
                'token' => $hash,
            ]);
            Mail::to($valid['email'])->send(new ResetPassword($token, $valid['email']));
            DB::commit();
            return response()->json(['message' => 'ok']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function changepas(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'token' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&^()_\-+=.,:;"\'<>\/\\\\[\]{}|`~]/',
                'confirmed',
            ],
        ], [
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.confirmed' => 'Password confirmation does not match.',
        ])->validate();

        $forget = ForgetPassword::where('email', '=', $valid['email'])->latest()->first();
        if (!$forget) {
            return response()->json(['message' => 'user not found'], 500);
        }
        if (!Hash::check($valid['token'], $forget->token)) {
            return response()->json(['message' => 'Token doesnt match'], 429);
        }
        if (now() > $forget->created_at->addMinutes(5)->addSeconds(10)) {
            return response()->json(['message' => 'Token has expired'], 429);
        }

        DB::beginTransaction();
        try {
            $user = User::where('email', '=', $valid['email'])->first();
            $hash = Hash::make($valid['password']);
            $user->update([
                'password' => $hash
            ]);
            $forget->update([
                'used' => now()
            ]);
            $user->log()->create([
                'log' => 'Change password'
            ]);
            DB::commit();
            return response()->json(['message' => 'succes']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'Message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
