<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentProject;
use App\Http\Resources\StudentProjectResource;
use Illuminate\Http\Request;

class StudentProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentProject::with(['module', 'student'])
                    ->where('is_published', true);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('student', function($studentQuery) use ($search) {
                      $studentQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('module_id')) {
            $query->where('module_id', $request->module_id);
        }

        $studentProjects = $query->latest('date')->get();

        return response()->json([
            'success' => true,
            'message' => 'Student projects retrieved successfully',
            'data'    => StudentProjectResource::collection($studentProjects)
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
        $studentProject = StudentProject::with(['module', 'student'])
                            ->where('is_published', true)
                            ->find($id);

        if (!$studentProject) {
            return response()->json([
                'success' => false,
                'message' => 'Student project not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student project details retrieved successfully',
            'data'    => new StudentProjectResource($studentProject)
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
