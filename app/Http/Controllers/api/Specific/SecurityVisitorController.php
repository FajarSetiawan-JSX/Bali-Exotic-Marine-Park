<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetVisitorResource;
use App\Models\BasicInformation;
use App\Models\Date;
use App\Models\DivisionPosition;
use App\Models\User;
use App\Models\Visitor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SecurityVisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitor = Visitor::orderBy('created_at', 'desc');
        $user = Auth::user();
        $divisionposition = DivisionPosition::where('name', '=', $user->getposition())->with('position')->first();
        if ($divisionposition->position->name == 'Staff' && $user->getlevel() == 3) {
            $visitor = $visitor->whereHas('basicinformation.templete.user', function ($query) use ($user) {
                $query->where('id', '=', $user->id);
            });
        }
        $visitor = $visitor->with(['basicinformation.date', 'basicinformation.templete.user', 'supplier.supplier'])->paginate(5)->withQueryString();
        return GetVisitorResource::collection($visitor);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id',
            'name' => 'required|string',
            'type' => 'required',
            'time' => 'required|date_format:H:i',
            'total' => 'nullable|numeric',
            'information' => 'nullable|string',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => ':attribute is required.',
            'string' => ':attribute must be a string.',
            'date_format' => ':attribute must be in the format HH:mm.',
            'numeric' => ':attribute must be a number.',
            'file' => ':attribute must be a valid file.',
            'mimes' => ':attribute must be a file of type: :values.',
            'max' => ':attribute may not be greater than :max kilobytes.',
        ])->validate();
        $user = Auth::user();
        DB::beginTransaction();
        try {
            $path = null;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('visitor', 'public');
            }
            Visitor::create([
                'basic_information_id' => $valid['basic'],
                'name' => $valid['name'],
                'category' => $valid['type'],
                'time' => $valid['time'],
                'count' => $valid['total'],
                'information' => $valid['information'],
                'img' => $path
            ]);
            $user->log()->create([
                'log' => 'create new daily visitor report at ' . $valid['time']
            ]);
            DB::commit();
            return response()->json(['message' => 'Successs']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new visitor',
                'file' => 'Controller : api/Specific/SecurityVisitorController.php',
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
    public function destroy(string $id)
    {
        //
    }
}
