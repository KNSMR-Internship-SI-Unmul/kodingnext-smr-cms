<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentProject;
use App\Models\Module;
use App\Models\CourseType; 
use App\Models\Student;
use App\Http\Requests\AddStudentProjectRequest;
use App\Http\Requests\UpdateStudentProjectRequest;
use Illuminate\Support\Facades\Storage;

class StudentProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentProject::with(['module.courseType', 'student', 'projectReview'])->latest('updated_at');
            
        $modules = Module::all();
        $courseTypes = CourseType::all();
        $students = Student::all();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('student', function($studentQuery) use ($search) {
                      $studentQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('course_type_id')) {
            $query->whereHas('module', function ($moduleQuery) use ($request) {
                $moduleQuery->where('course_type_id', $request->course_type_id);
            });
        }

        $studentProjects = $query->paginate(10)->withQueryString(); 

        return view('pages.student-projects.index', compact('studentProjects', 'modules', 'courseTypes', 'students'));
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
    public function store(AddStudentProjectRequest $request)
    {
        $data = $request->validated();
        
        $data['is_published'] = $request->has('is_published'); 

        if ($request->hasFile('media')) {
            $data['media'] = $request->file('media')->store('student-projects', 'public');
        }

        StudentProject::create($data);

        return redirect()->route('student-projects.index')->with('success', 'Student project added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $studentProject = StudentProject::with(['module.courseType', 'student', 'projectReview'])->findOrFail($id);

        return view('pages.student-projects.show', compact('studentProject'));
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
    public function update(UpdateStudentProjectRequest $request, string $id)
    {
        $studentProject = StudentProject::findOrFail($id);
        $data = $request->validated();

        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('media')) {
            if ($studentProject->media) {
                Storage::disk('public')->delete($studentProject->media);
            }
            $data['media'] = $request->file('media')->store('student-projects', 'public');
        } else {
            unset($data['media']); 
        }

        $studentProject->update($data);

        return redirect()->route('student-projects.index')->with('success', 'Student project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $studentProject = StudentProject::findOrFail($id);

        if ($studentProject->media) {
            Storage::disk('public')->delete($studentProject->media);
        }

        $studentProject->delete();

        return redirect()->route('student-projects.index')->with('delete', 'Student project deleted successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No student-projects selected.');
        }

        $studentProjects = StudentProject::whereIn('id', $ids)->get();

        foreach ($studentProjects as $studentProject) {
            if ($studentProject->media) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($studentProject->media);
            }
            $studentProject->delete();
        }

        return redirect()->route('student-projects.index')->with('delete', count($ids) . ' student-projects deleted successfully!');
    }
}