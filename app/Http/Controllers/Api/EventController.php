<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = now()->format('Y-m-d');

        $events = Event::with('user')
            ->whereDate('event_date', '<=', $today)
            ->orderBy('event_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Event documentation retrieved successfully',
            'data'    => EventResource::collection($events)
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
        $event = Event::with('user')->find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found',
                'data'    => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event details retrieved successfully',
            'data'    => new EventResource($event)
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
