<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CrudProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|min:8|regex:/^(?=.*\d)[A-Za-z0-9_]+$/|unique:users,username,' . $id,
            'nik' => 'required|digits:16',
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'nullable|in:male,female',
            'birthday' => 'nullable|date',
            'phone' => 'required|digits_between:9,13|different:emergency',
            'emergency' => 'required|digits_between:9,13|different:phone',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string'
        ], [
            'required' => 'The field :attribute require.',
            'unique' => ':attribute is already registered.',
            'digits' => 'The :attribute must be 16 digits long.',
            'in' => 'Only male or female value',
            'date' => 'Only date formats are allowed.',
            'digits_between' => 'The number of digits must be between 9 and 13.',
            'string' => 'The field :attribute must be string',
            'max' => 'maximum character length 100',
            'min' => 'minimal character length 8',
            'exists' => 'The value of :attribute is not exist',
            'regex' => 'The :attribute must contain at least one digit.',
            'phone.different' => 'The phone number and emergency phone number must be different.',
            'emergency.different' => 'The emergency phone number must be different from the phone number.'
        ])->validate();
        $nikhash = hash_hmac('sha256', $valid['nik'], config('app.key'));
        $phonehash = hash_hmac('sha256', $valid['phone'], config('app.key'));
        $emergencyhash = hash_hmac('sha256', $valid['emergency'], config('app.key'));
        $ceknik = User::where('id', '!=', $id)->where('nik_hash', '=', $nikhash)->exists();
        $cekphone = User::where('id', '!=', $id)->where('phone_hash', '=', $phonehash)->exists();
        $cekemergency = User::where('id', '!=', $id)->where('emergency_hash', '=', $emergencyhash)->exists();

        if ($ceknik) {
            return response()->json(['message' => 'ID Number (NIK) is already registered'], 409);
        }
        if ($cekphone) {
            return response()->json(['message' => 'Phone number is already registered'], 409);
        }
        if ($cekemergency) {
            return response()->json(['message' => 'Emergency phone number is already registered'], 409);
        }
        $user = User::where('id', '=', $id)->first();
        if ($user->division->level->level != 1) {
            return response()->json(['message' => 'Access not allowed'], 403);
        }
        DB::beginTransaction();
        try {
            $user = User::where('id', '=', $id)->first();
            $user->update([
                'name' => $valid['name'],
                'nik' => encrypt($valid['nik']),
                'nik_hash' => $nikhash,
                'username' => $valid['username'],
                'email' => $valid['email'],
                'phone' => encrypt($valid['phone']),
                'phone_hash' => $phonehash,
                'emergency' => encrypt($valid['emergency']),
                'emergency_hash' => $emergencyhash,
                'gender' => $valid['gender'],
                'born_at' => $valid['city'],
                'address' => $valid['address']
            ]);
            $user->log()->create([
                'log' => 'Update profile at ' . today()->format('d-m-Y')
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update profile']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new user',
                'file' => 'Controller : api/CrudProfileController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function image(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'profile' => 'required|image|mimes:png,jpg|max:1024'
        ], [
            'required' => 'Please select a profile image',
            'image' => 'File must be an image',
            'mimes' => 'Only png or jpg file are allowed',
            'max' => 'File is too large.'
        ])->validate();

        dd($request->all());
        return response()->json(['message' => 'success']);
    }
}
