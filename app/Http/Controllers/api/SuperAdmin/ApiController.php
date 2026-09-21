<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetApisResource;
use App\Models\Api;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $apis = Api::with(['methode']);
        if ($request->filled('search')) {
            $apis = $apis->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('scope')) {
            $apis = $apis->where('scope', $request->scope);
        }
        return GetApisResource::collection($apis->paginate(5)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
