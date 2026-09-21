<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetUsersResource;
use App\Http\Resources\General\GetUserResource;
use App\Models\AssignSupervisor;
use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\User;
use App\Models\UserDivisionPosition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $users = User::query();
        if ($user->getlevel() == 2) {
            $id = AssignSupervisor::where('user_id', '=', $user->id)->pluck('division_id')->toArray();
            $users = $users->whereHas('divisionPosition.divisionPosition.division', function ($query) use ($id) {
                $query->whereIn('id', $id);
            });
        }
        if ($request->filled('search')) {
            $users->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('filter')) {
            $divisi = $request->filter;
            $users->whereHas('divisionPosition.divisionPosition.division', function ($query) use ($divisi) {
                $query->where('name', '=', $divisi);
            });
        }
        $users = $users->paginate(6)->withQueryString();
        return GetUsersResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|min:8|regex:/^(?=.*\d)[A-Za-z0-9_]+$/|unique:users,username',
            'nik' => 'required|digits:16',
            'email' => 'nullable|unique:users,email',
            'gender' => 'nullable|in:male,female',
            'birthday' => 'nullable|date',
            'phone' => 'required|digits_between:9,13|different:emergency',
            'emergency' => 'required|digits_between:9,13|different:phone',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'division' => 'required|exists:divisions,id',
            'position' => 'required|array|min:1',
            'position.*' => 'exists:division_positions,id'
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
        foreach ($valid['position'] as $position) {
            $cekposition = DivisionPosition::where('id', '=', $position)->first();
            if ($cekposition->position->name === 'Head' && $valid['email'] === null) {
                return response()->json(['message' => 'The field email is required.'], 422);
            }
            $jabatanuser = UserDivisionPosition::where('division_position_id', '=', $position)->with('divisionPosition.position')->first();
            if ($jabatanuser && $jabatanuser->divisionPosition->position->name === 'Head') {
                return response()->json(['message' => 'The position of head has already been filled.'], 422);
            }
        }

        $nikhash = hash_hmac('sha256', $valid['nik'], config('app.key'));
        $phonehash = hash_hmac('sha256', $valid['phone'], config('app.key'));
        $emergencyhash = hash_hmac('sha256', $valid['emergency'], config('app.key'));
        $ceknik = User::where('nik_hash', '=', $nikhash)->exists();
        $cekphone = User::where('phone_hash', '=', $phonehash)->exists();
        $cekemergency = User::where('emergency_hash', '=', $emergencyhash)->exists();
        if ($ceknik) {
            return response()->json(['message' => 'ID Number (NIK) is already registered'], 409);
        }
        if ($cekphone) {
            return response()->json(['message' => 'Phone number is already registered'], 409);
        }
        if ($cekemergency) {
            return response()->json(['message' => 'Emergency phone number is already registered'], 409);
        }
        DB::beginTransaction();
        try {
            $division = Division::where('id', '=', $valid['division'])->with('worktime.templete', 'worktime.worktime.time')->first();
            $user = User::create([
                'name' => $valid['name'],
                'nik' => encrypt($valid['nik']),
                'nik_hash' => $nikhash,
                'username' => $valid['username'],
                'email' => $valid['email'],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'phone' => encrypt($valid['phone']),
                'phone_hash' => $phonehash,
                'emergency' => encrypt($valid['emergency']),
                'emergency_hash' => $emergencyhash,
                'gender' => $valid['gender'],
                'born_at' => $valid['city'],
                'address' => $valid['address']
            ]);
            foreach ($valid['position'] as $position) {
                $user->divisionPosition()->create([
                    'division_position_id' => $position
                ]);
            }
            foreach ($division->worktime as $worktime) {
                $templete = $worktime->templete()->create([
                    'user_id' => $user->id,
                    'name' => $user->name . ' - ' . $worktime->worktime->name,
                ]);
                if ($worktime->work == 1) {
                    foreach ($worktime->worktime->time as $time) {
                        $templete->templetetime()->create([
                            'time_id' => $time->id,
                        ]);
                    }
                }
            }

            $user->log()->create([
                'log' => $user->name .  'Registered since ' . today()->format('d-m-Y')
            ]);
            DB::commit();
            return response()->json(['message' => 'Success create new user']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new user',
                'file' => 'Controller : api/SuperAdmin/Master/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found!', 404]);
        }
        return new GetUserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
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
            'address' => 'nullable|string',
            'division' => 'required|exists:divisions,id',
            'position' => 'required|exists:positions,id'
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
        $cekemergency = User::where('emergency_hash', '=', $emergencyhash)->exists();
        $cekposition = User::where('id', '!=', $id)->where('division_id', '=', $valid['division'])->whereHas('position.position', function ($query) {
            $query->where('name', '=', 'Head');
        })->exists();
        if ($ceknik) {
            return response()->json(['message' => 'ID Number (NIK) is already registered'], 409);
        }
        if ($cekphone) {
            return response()->json(['message' => 'Phone number is already registered'], 409);
        }
        if ($cekemergency) {
            return response()->json(['message' => 'Emergency phone number is already registered'], 409);
        }
        if ($cekposition && $valid['position'] == 1) { //1 adalah ID posisi head
            return response()->json(['message' => 'The position of head has already been filled.'], 409);
        }
        DB::beginTransaction();
        try {
            $user = User::where('id', '=', $id)->first();
            $user->update([
                'division_id' => $valid['division'],
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
            $user->position()->create([
                'position_id' => $valid['position']
            ]);
            $user->log()->create([
                'log' => 'Super Admin update profile at ' . today()->format('d-m-Y')
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update user']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new user',
                'file' => 'Controller : api/SuperAdmin/Master/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function status(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'status' => 'required'
        ], [
            'required' => 'empty data is not allowed'
        ])->validate();
        $user = User::where('id', '=', $id)->firstOrFail();
        if ($user->getlevel() === 1) {
            return response()->json(['message' => 'Super Admin is not allowed to change the status'], 403);
        }
        DB::beginTransaction();
        try {
            $user->update([
                'status' => $valid['status']
            ]);
            $user->log()->create([
                'log' => 'User status changed to ' . ($user->status == 1 ? 'Active' : 'Non active') . ''
            ]);
            DB::commit();
            return response()->json(['message' => 'Success change status']);
        } catch (Exception $e) {
            Db::rollBack();
            Log::error([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['message' => 'Server Error!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json(['message' => 'Fitur Maintenance'], 409);
    }
}
