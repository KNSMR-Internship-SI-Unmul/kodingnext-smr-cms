<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Http\Resources\PromotionResource;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $today = now()->format('Y-m-d');
        
        $promotions = Promotion::with('user')
            ->whereDate('start_date', '<=', $today) 
            ->whereDate('end_date', '>=', $today)
            ->orderBy('end_date', 'asc') 
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Active promotions retrieved successfully',
            'data'    => PromotionResource::collection($promotions)
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
        $promotion = Promotion::with('user')->find($id);

        if (!$promotion) {
            return response()->json([
                'success' => false,
                'message' => 'Promotion not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Promotion details retrieved successfully',
            'data'    => new PromotionResource($promotion)
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
