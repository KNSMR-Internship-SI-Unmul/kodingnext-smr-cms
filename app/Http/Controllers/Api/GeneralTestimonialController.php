<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GeneralTestimonial;
use App\Http\Resources\GeneralTestimonialResource;
use Illuminate\Http\Request;

class GeneralTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = GeneralTestimonial::where('is_published', true)
                                          ->latest()
                                          ->get();

        return response()->json([
            'success' => true,
            'message' => 'General testimonials retrieved successfully',
            'data'    => GeneralTestimonialResource::collection($testimonials)
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
        $testimonial = GeneralTestimonial::where('is_published', true)
                                         ->find($id);

        if (!$testimonial) {
            return response()->json([
                'success' => false,
                'message' => 'Testimonial not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Testimonial details retrieved successfully',
            'data'    => new GeneralTestimonialResource($testimonial)
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
