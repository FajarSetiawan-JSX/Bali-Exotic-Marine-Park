<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetUsersResource;
use App\Http\Resources\General\GetUserContractsResource;
use App\Http\Resources\General\GetUserResource;
use App\Models\AssignSupervisor;
use App\Models\ContractUser;
use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Templete;
use App\Models\User;
use App\Models\UserDivisionPosition;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
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
        $users = User::whereHas('divisionPosition.divisionPosition.division.level', function ($query) {
            $query->where('level', '!=', 1);
        });
        if ($user->getlevel() == 2) {
            $id = AssignSupervisor::where('user_id', '=', $user->id)->pluck('division_id')->toArray();
            $users = $users->whereHas('divisionPosition.divisionPosition.division', function ($query) use ($id) {
                $query->whereIn('id', $id);
            })->where('id', '!=', $user->id);
        }
        if ($user->getlevel() == 3) {
            if ($user->getposition() == 'Admin HRD') {
                $users = $users;
            } else {
                $users = $users->whereHas('divisionPosition.divisionPosition.division', function ($query) use ($user) {
                    $query->where('name', '=', $user->getdivision())->where('id', '!=', $user->id);
                });
            }
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
            'position' => 'required|exists:division_positions,id',
            'religion' => 'nullable|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Other',
            'tk' => 'nullable|string|in:TK/O,K/0','K/1','K/2',
        ], [
            'required' => 'The field :attribute require.',
            'unique' => ':attribute is already registered.',
            'digits' => 'The :attribute must be 16 digits long.',
            'in' => ':attribute not in list',
            'date' => 'Only date formats are allowed.',
            'digits_between' => 'The number of digits must be between 9 and 13.',
            'string' => 'The field :attribute must be string',
            'max' => 'maximum character length 100',
            'min' => 'minimal character length 8',
            'exists' => 'The value of :attribute is not exist',
            'regex' => 'The :attribute must contain at least one digit.',
            'phone.different' => 'The phone number and emergency phone number must be different.',
            'emergency.different' => 'The emergency phone number must be different from the phone number.',
        ])->validate();
        $cekposition = DivisionPosition::where('id', '=', $valid['position'])->first();
        if ($cekposition->position->name === 'Head' && $valid['email'] === null) {
            return response()->json(['message' => 'The field email is required.'], 422);
        }
        $jabatanuser = UserDivisionPosition::where('division_position_id', '=', $valid['position'])->with('divisionPosition.position')->first();
        if ($jabatanuser && $jabatanuser->divisionPosition->position->name === 'Head') {
            return response()->json(['message' => 'The position of head has already been filled.'], 422);
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
                'address' => $valid['address'],
                'religion' => $valid['religion'],
                'status_tk' => $valid['tk']
            ]);
            $user->divisionPosition()->create([
                'division_position_id' => $valid['position']
            ]);

            foreach ($division->worktime as $worktime) {
                if ($worktime->work == 1) {
                    foreach ($worktime->worktime->time as $time) {
                        $templete = Templete::create([
                            'division_work_time_id' => $worktime->id,
                            'user_id' => $user->id,
                            'name' => $time->name,
                        ]);
                        $templete->templetetime()->create([
                            'time_id' => $time->id,
                        ]);
                    }
                } else {
                    $templete = $worktime->templete()->create([
                        'user_id' => $user->id,
                        'name' => 'Off Day',
                    ]);
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
            'position' => 'required|exists:positions,id',
            'religion' => 'nullable|string|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu|Other',
            'tk' => 'nullable|string|in:TK/O,K1'
        ], [
            'required' => 'The field :attribute require.',
            'unique' => ':attribute is already registered.',
            'digits' => 'The :attribute must be 16 digits long.',
            'in' => ':attribute not in list',
            'date' => 'Only date formats are allowed.',
            'digits_between' => 'The number of digits must be between 9 and 13.',
            'string' => 'The field :attribute must be string',
            'max' => 'maximum character length 100',
            'min' => 'minimal character length 8',
            'exists' => 'The value of :attribute is not exist',
            'regex' => 'The :attribute must contain at least one digit.',
            'phone.different' => 'The phone number and emergency phone number must be different.',
            'emergency.different' => 'The emergency phone number must be different from the phone number.',
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
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
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
                'address' => $valid['address'],
                'religion' => $valid['religion'],
                'status_tk' => $valid['tk']
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
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
            $name = $user->name;
            $user->delete();
            $admin = Auth::user();
            $admin->log()->create([
                'log' => 'Super Admin delete ' . $name . ' account at ' . today()->format('d-m-Y')
            ]);
            DB::commit();
            return response()->json(['message' => 'Success delete user']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete user',
                'file' => 'Controller : api/SuperAdmin/Master/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function additional(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'bank' => 'required|string|max:15',
            'health' => 'required|string|max:13',
            'work' => 'required|string|max:11'
        ], [
            'required' => ':attribute is required',
            'string' => ':attribute must be string',
            'max' => ':attribute maximal :max characters'
        ])->validate();
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found!'], 404);
        }
        $bank_hash = hash_hmac('sha256', $valid['bank'], config('app.key'));
        $health_hash = hash_hmac('sha256', $valid['health'], config('app.key'));
        $work_hash = hash_hmac('sha256', $valid['work'], config('app.key'));

        $cekbank = User::where('id', '!=', $user->id)->where('rekening_hash', '=', $bank_hash)->exists();
        $cekhealth = User::where('id', '!=', $user->id)->where('bpjs_kes_hash', '=', $health_hash)->exists();
        $cekwork = User::where('id', '!=', $user->id)->where('bpjs_tk_hash', '=', $work_hash)->exists();
        if ($cekbank) {
            return response()->json(['message' => 'Bank Account already exist'], 422);
        }
        if ($cekhealth) {
            return response()->json(['message' => 'Health Social Security Agency ID'], 422);
        }
        if ($cekwork) {
            return response()->json(['message' => 'Employment Social Security Agency ID'], 422);
        }
        DB::beginTransaction();
        try {
            $user->update([
                'rekening' => encrypt($valid['bank']),
                'rekening_hash' => $bank_hash,
                'bpjs_kes' => encrypt($valid['health']),
                'bpjs_kes_hash' => $health_hash,
                'bpjs_tk' => encrypt($valid['work']),
                'bpjs_tk_hash' => $work_hash
            ]);
            $admin = Auth::user();
            $admin->log()->create([
                'log' => 'Super Admin update additional information ' . $user->name . ' account at ' . today()->format('d-m-Y')
            ]);
            $result = [
                'bank' => decrypt($user->rekening),
                'health' => decrypt($user->bpjs_kes),
                'work' => decrypt($user->bpjs_tk),
            ];
            DB::commit();
            return response()->json(['data' => $result]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update Additional user',
                'file' => 'Controller : api/SuperAdmin/Master/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function contracts(Request $request, $id)
    {
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found!'], 404);
        }
        $contracts = ContractUser::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->with(['contract', 'user']);
        if ($request->filled('search')) {
            $contracts->whereHas('contract', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')->orWhere('duration', 'like', '%' . $request->search . '%');
            });
        }
        return GetUserContractsResource::collection($contracts->paginate(10)->withQueryString());
    }

    public function newcontract(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'contract' => 'required|exists:contracts,id',
            'in' => 'required|date',
        ], [
            'required' => ':attribute is required',
            'exists' => ':attribute not found',
            'date' => ':attribute must be date format'
        ])->validate();
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
            $user->contract()->create([
                'contract_id' => $valid['contract'],
                'in' => $valid['in']
            ]);
            $admin = Auth::user();
            $admin->log()->create([
                'log' => 'You create new contract for ' . $user->name . ' account at ' . today()->format('d-m-Y')
            ]);
            $user->log()->create([
                'log' => 'You have new contract at ' . today()->format('d-m-Y') . ' by ' . $admin->name
            ]);
            $contract = $user->contract()->latest()->with(['contract'])->first();
            $result = [
                'id' => $contract->id,
                'name' => $contract->contract->name,
                'id_contract' => $contract->contract->id,
                'duration' => $contract->contract->duration,
                'id_user' => $user->id,
                'user' => $user->name,
                'in' => $contract->in,
                'expired' => Carbon::parse($contract->in)->addMonths($contract->contract->duration)->toDateString(),
            ];
            DB::commit();
            return response()->json(['data' => $result]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new contract user',
                'file' => 'Controller : api/SuperAdmin/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function updatecontract(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'contract' => 'required|exists:contracts,id',
            'in' => 'required|date',
        ], [
            'required' => ':attribute is required',
            'exists' => ':attribute not found',
            'date' => ':attribute must be date format'
        ])->validate();
        $contractuser = ContractUser::where('id', '=', $id)->first();
        if (!$contractuser) {
            return response()->json(['message' => 'Contract Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
            $contractuser->update([
                'contract_id' => $valid['contract'],
                'in' => $valid['in']
            ]);
            $admin = Auth::user();
            $admin->log()->create([
                'log' => 'You update contract for ' . $contractuser->user->name . ' account at ' . today()->format('d-m-Y')
            ]);
            $contractuser->user->log()->create([
                'log' => 'Your contract has been updated at ' . today()->format('d-m-Y') . ' by ' . $admin->name
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update contract']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update contract user',
                'file' => 'Controller : api/SuperAdmin/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function deletecontract($id)
    {
        $contractuser = ContractUser::where('id', '=', $id)->first();
        if (!$contractuser) {
            return response()->json(['message' => 'Contract Not Found!'], 404);
        }
        DB::beginTransaction();
        try {
            $contractuser->delete();
            $admin = Auth::user();
            $admin->log()->create([
                'log' => 'You delete contract for ' . $contractuser->user->name . ' account at ' . today()->format('d-m-Y')
            ]);
            $contractuser->user->log()->create([
                'log' => 'Your contract has been deleted at ' . today()->format('d-m-Y') . ' by ' . $admin->name
            ]);
            DB::commit();
            return response()->json(['message' => 'Success delete contract']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete contract user',
                'file' => 'Controller : api/SuperAdmin/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function alluserdownloadpdf()
    {
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $users = User::whereHas('divisionPosition.divisionPosition.division.level', function ($q) {
                $q->where('level', '!=', 1);
            })->get();
            $total = $users->count();
            $users = $users->map(function ($item) {
                $kontrak = $item->contract()->latest()->first();
                $kontrakIn = $kontrak?->created_at;
                $duration = $kontrak?->contract?->duration;
                $kontrakExp = ($kontrakIn && $duration) ? Carbon::parse($kontrakIn)->addMonths($duration) : null;
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'nik' => decrypt($item->nik),
                    'division' => $item->getdivision(),
                    'position' => $item->getposition(),
                    'ttl' => $item->born_at ?? '-' . ', ' . $item->birthday ?? '-',
                    'religion' => $item->religion ?? '-',
                    'jk' => $item->gender ?? '-',
                    'address' => $item->address ?? '-',
                    'status' => $item->status_tk ?? '-',
                    'phone' => decrypt($item->phone),
                    'email' => $item->email ?? '-',
                    'emergency' => decrypt($item->emergency),
                    'bank' => $item->rekening ? decrypt($item->rekening) : '-',
                    'bpjskes' => $item->bpjs_kes ? decrypt($item->bpjs_kes) : '-',
                    'bpjsker' => $item->bpjs_tk ? decrypt($item->bpjs_tk) : '-',
                    'in' => $item->created_at?->format('d-m-Y'),
                    'kontrak_in' => $kontrakIn ? Carbon::parse($kontrakIn)->format('d-m-Y') : '-',
                    'kontrak_exp' => $kontrakExp ? $kontrakExp->format('d-m-Y') : '-',
                ];
            });
            $tanggal = now()->format('d-m-Y');
            $by = $user->getlevel() == 1 ? 'Admin' : 'HRD';
            $divisi = $user->getlevel() == 1 ? 'Admin' : 'Office';
            $pdf = Pdf::loadView('AllUserPdf', ['users' => $users, 'tanggal' => $tanggal, 'by' => $by, 'divisi' => $divisi, 'total' => $total]);
            DB::commit();
            return $pdf->download('alluser' . '.pdf');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Download PDF all user',
                'file' => 'Controller : api/SuperAdmin/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
    public function userdownloadpdf($id)
    {
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $creator = Auth::user();
            $user = [
                'id' => $user->id,
                'name' => $user->name,
                'nik' => decrypt($user->nik),
                'division' => $user->getdivision(),
                'position' => $user->getposition(),
                'ttl' => $user->born_at ?? '-' . ', ' . $user->birthday ?? '-',
                'religion' => $user->religion ?? '-',
                'jk' => $user->gender ?? '-',
                'address' => $user->address ?? '-',
                'status' => $user->status_tk ?? '-',
                'phone' => decrypt($user->phone),
                'email' => $user->email ?? '-',
                'emergency' => decrypt($user->emergency),
                'bank' => $user->rekening ? decrypt($user->rekening) : '-',
                'bpjskes' => $user->bpjs_kes ? decrypt($user->bpjs_kes) : '-',
                'bpjsker' => $user->bpjs_tk ? decrypt($user->bpjs_tk) : '-',
                'in' => $user->created_at?->format('d-m-Y'),
            ];
            $contracts = ContractUser::where('user_id', '=', $user['id'])->orderBy('created_at', 'desc')->with(['contract'])->get();
            $result = $contracts->map(function ($contract) {
                $exp = Carbon::parse($contract->created_at)->addMonths($contract->contract->duration);
                return [
                    'kontrak' => $contract->contract->name,
                    'in' => $contract->created_at->format('d-m-Y'),
                    'expired' => $exp->format('d-m-Y'),
                    'duration' => $contract->contract->duration . ' bulan',
                    'status' => now() < $exp ? 'Aktif' : 'Expired',
                ];
            });
            $tanggal = now()->format('d-m-Y');
            $by = $creator->getlevel() == 1 ? 'Admin' : 'HRD';
            $divisi = $creator->getlevel() == 1 ? 'Admin' : 'Office';
            $pdf = Pdf::loadView('UserPdf', ['user' => $user, 'tanggal' => $tanggal, 'by' => $by, 'divisi' => $divisi, 'contracts' => $result]);
            DB::commit();
            return $pdf->download('user' . '.pdf');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Download PDF all user',
                'file' => 'Controller : api/SuperAdmin/UsersController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
    public function alluserdownloadxlsx() {}
    public function userdownloadxlsx($id) {}
}
