<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Http\Resources\ModuleResource;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Module::with('courseType');

        // filter berdasarkan course_type_id
        if ($request->filled('course_type_id')) {
            $query->where('course_type_id', $request->course_type_id);
        }

        // filter berdasarkan category untuk junior koder
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $modules = $query->get();

        return response()->json([
            'success' => true,
            'message' => 'Modules retrieved successfully',
            'data'    => ModuleResource::collection($modules)
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
        $module = Module::with('courseType')->find($id);

        if (!$module) {
            return response()->json([
                'success' => false,
                'message' => 'Module not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Module details retrieved successfully',
            'data'    => new ModuleResource($module)
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
