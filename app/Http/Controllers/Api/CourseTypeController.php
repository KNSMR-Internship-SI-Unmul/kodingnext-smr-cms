<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseType;
use App\Http\Resources\CourseTypeResource;
use Illuminate\Http\Request;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseTypes = CourseType::orderBy('id', 'asc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Course types retrieved successfully',
            'data'    => CourseTypeResource::collection($courseTypes)
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
        $courseType = CourseType::find($id);

        if (!$courseType) {
            return response()->json([
                'success' => false,
                'message' => 'Course type not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Course type details retrieved successfully',
            'data'    => new CourseTypeResource($courseType)
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
