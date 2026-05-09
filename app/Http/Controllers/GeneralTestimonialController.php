<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralTestimonial;
use App\Http\Requests\AddGeneralTestimonialRequest;
use App\Http\Requests\UpdateGeneralTestimonialRequest;

class GeneralTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $testimonial = GeneralTestimonial::with('user')->latest('updated_at');

        $perPage = $request->input('per_page', 10);

        $testimonials = $testimonial->paginate($perPage)->withQueryString();

        return view('pages.general-testimonials.index', compact('testimonials'));
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
    public function store(AddGeneralTestimonialRequest $request)
    {
        $data = $request->validated();
        // $data['user_id'] = auth()->id();

        $data['is_published'] = $request->has('is_published'); 
        $data['user_id'] = 1;

        GeneralTestimonial::create($data);

        return redirect()->route('general-testimonials.index')->with('success', 'Testimonial added successfully!');
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
    public function update(UpdateGeneralTestimonialRequest $request, string $id)
    {
        $testimonial = GeneralTestimonial::findOrFail($id);
        $data = $request->validated();

        $data['is_published'] = $request->has('is_published');
        $data['user_id'] = 1;

        $testimonial->update($data);

        return redirect()->route('general-testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = GeneralTestimonial::findorFail($id);
        $testimonial->delete();

        return redirect()->route('general-testimonials.index')->with('delete', 'Testimonial deleted successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No testimonials selected.');
        }

        GeneralTestimonial::whereIn('id', $ids)->delete();

        return redirect()->route('general-testimonials.index')->with('delete', count($ids) . ' testimonials deleted successfully!');
    }
}
