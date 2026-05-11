<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseType;
use App\Http\Requests\AddCourseTypeRequest;
use App\Http\Requests\UpdateCourseTypeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseTypes = CourseType::with('user')->latest('updated_at')->get();

        return view('pages.courses.index', compact('courseTypes'));
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
    public function store(AddCourseTypeRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        CourseType::create($data);

        return redirect()->route('courses.index')->with('success', 'Course type added successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseTypeRequest $request, string $id)
    {
        $courseTypes = CourseType::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($courseTypes->image) {
                Storage::disk('public')->delete($courseTypes->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        } else {
            unset($data['image']);
        }

        $courseTypes->update($data);

        return redirect()->route('courses.index')->with('success', 'Course type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $courseTypes = CourseType::findOrFail($id);

        if ($courseTypes->image) {
            Storage::disk('public')->delete($courseTypes->image);
        }

        $courseTypes->delete();

        return redirect()->route('courses.index')->with('delete', 'Course type deleted successfully!');
    }
}
