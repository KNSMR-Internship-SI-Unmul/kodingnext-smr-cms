<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectReview;
use App\Http\Requests\AddProjectReviewRequest;
use App\Http\Requests\UpdateProjectReviewRequest;

class ProjectReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_project_id' => 'required|exists:student_projects,id',
            'rating'             => 'required|integer|min:1|max:5',
            'review_content'     => 'required|string',
            'is_approved'        => 'nullable|boolean',
        ]);

        $validated['is_approved'] = $request->has('is_approved');

        ProjectReview::create($validated);

        return redirect()->route('student-projects.index')->with('success', 'Project review added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = ProjectReview::findOrFail($id);

        $validated = $request->validate([
            'rating'         => 'required|integer|min:1|max:5',
            'review_content' => 'required|string',
            'is_approved'    => 'nullable|boolean',
        ]);

        $validated['is_approved'] = $request->has('is_approved');

        $review->update($validated);

        return redirect()->route('student-projects.index')->with('success', 'Project review updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = ProjectReview::findOrFail($id);
        
        $review->delete();

        return redirect()->route('student-projects.index')->with('delete', 'Project review deleted successfully!');
    }
}
