<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetNotificationResource;
use App\Http\Resources\Specific\GetNotificationsResource;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserDivisionPosition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notifications = Notification::orderBy('created_at', 'desc')->with(['user.user', 'user.divisionPosition']);
        if ($request->filled('search')) {
            $cari = $request->search;
            $notifications = $notifications->whereHas('user.user', function ($q) use ($cari) {
                $q->where('name', 'like', '%' . $cari . '%');
            });
        }
        if ($request->filled('from') && $request->filled('to')) {
            $notifications = $notifications->whereBetween('created_at', [$request->from . ' 00:00:00', $request->to . ' 23:59:59']);
        }
        return GetNotificationsResource::collection($notifications->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'notification' => 'required|max:200',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => ':attribute is required.',
            'file' => ':attribute must be a valid file.',
            'mimes' => ':attribute must be a file of type: :values.',
            'max' => ':attribute may not be greater than :max kilobytes.',
        ])->validate();
        $user = Auth::user();
        $position = UserDivisionPosition::where('id', '=', $user->id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $path = null;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('notification', 'public');
            }
            $data = Notification::create([
                'user_division_position_id' => $position->id,
                'notification' => $valid['notification'],
                'img' => $path
            ]);
            $data->load(['user.user', 'user.divisionPosition']);
            $user->log()->create([
                'log' => 'create new notification at ' . now()->format('d-m-Y')
            ]);
            DB::commit();
            return new GetNotificationResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new notification',
                'file' => 'Controller : api/Specific/NotificationController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notif = Notification::where('id', '=', $id)->first();
        if (!$notif) {
            return response()->json(['message' => ''], 404);
        }
        DB::beginTransaction();
        try {
            if ($notif->img) {
                Storage::disk('public')->delete($notif->img);
            }
            $notif->delete();
            DB::commit();
            return response()->json(['message' => 'Success Delete']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete Notification',
                'file' => 'Controller : api/Specific/NotificationController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
