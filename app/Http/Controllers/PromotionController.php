<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\User;
use App\Http\Requests\AddPromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Promotion::with('user')->latest('updated_at');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('start_date', '<=', $request->date)
                  ->whereDate('end_date', '>=', $request->date);
        }

        $perPage = $request->input('per_page', 10);

        $promotions = $query->paginate($perPage)->withQueryString();

        return view('pages.promotions.index', compact('promotions'));
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
    public function store(AddPromotionRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = 1;
        // $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('promotions', 'public');
        }

        Promotion::create($data);

        return redirect()->route('promotions.index')->with('success', 'Promotion added successfully!');
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
    public function update(UpdatePromotionRequest $request, string $id)
    {
        $promotion = Promotion::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($promotion->image) {
                Storage::disk('public')->delete($promotion->image);
            }
            $data['image'] = $request->file('image')->store('promotions', 'public');
        } else {
            unset($data['image']);
        }

        $promotion->update($data);

        return redirect()->route('promotions.index')->with('success', 'Promotion updated successfully!');   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promotion = Promotion::findOrFail($id);

        if ($promotion->image) {
            Storage::disk('public')->delete($promotion->image);
        }

        $promotion->delete();

        return redirect()->route('promotions.index')->with('delete', 'Promotion deleted successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No promotions selected.');
        }

        $promotions = Promotion::whereIn('id', $ids)->get();

        foreach ($promotions as $promotion) {
            if ($promotion->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($promotion->image);
            }
            $promotion->delete();
        }

        return redirect()->route('promotions.index')->with('delete', count($ids) . ' promotions deleted successfully!');
    }
}
