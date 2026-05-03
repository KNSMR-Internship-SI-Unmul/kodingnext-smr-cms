<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', '!=', 'admin')
                      ->where('name', '!=', 'Admin');
            }); 

        if ($request->filled('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        
        $employees = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Employees retrieved successfully',
            'data'    => EmployeeResource::collection($employees)
        ], 200);
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
        $employee = User::with('role')
            ->whereHas('role', function ($query) {
                $query->where('name', '!=', 'admin')
                      ->where('name', '!=', 'Admin');
            })
            ->find($id);

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee details retrieved successfully',
            'data'    => new EmployeeResource($employee)
        ], 200);
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
