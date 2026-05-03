<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\CourseType;
use App\Http\Requests\AddModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Module::with('courseType')->latest('updated_at');
        $courseTypes = CourseType::all();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('course_type_id')) {
            $query->where('course_type_id', $request->course_type_id);
        }

        $modules = $query->get();

        return view('pages.modules.index', compact('modules', 'courseTypes'));
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
    public function store(AddModuleRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('modules', 'public');
        }

        Module::create($data);

        return redirect()->route('modules.index')->with('success', 'Module added successfully!');
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
    public function update(UpdateModuleRequest $request, string $id)
    {
        $module = Module::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($module->image) {
                Storage::disk('public')->delete($module->image);
            }
            $data['image'] = $request->file('image')->store('modules', 'public');
        } else {
            unset($data['image']);
        }

        $module->update($data);

        return redirect()->route('modules.index')->with('success', 'Module updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module = Module::findOrFail($id);

        if ($module->image) {
            Storage::disk('public')->delete($module->image);
        }

        $module->delete();

        return redirect()->route('modules.index')->with('delete', 'Module deleted successfully!');
    }
}
