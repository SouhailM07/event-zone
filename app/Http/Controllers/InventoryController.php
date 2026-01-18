<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $categories = Category::all();
        $events = Event::query()
            ->where('userId', auth()->user()->id)
            ->when($req->filled('title'), function ($q) use ($req) {
                $q->where('title', 'like', '%'.$req->title.'%');
            })->when($req->filled('validation'), function ($q) use ($req) {
                $q->where('validation', $req->validation);
            })->when($req->filled('category'), function ($q) use ($req) {
                $q->whereHas('categories', function ($cat) use ($req) {
                    $cat->where('categories.id', $req->category);
                });
            })->get();

        return view('inventory', compact(['events', 'categories']));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        if (! $event) {
            return redirect()->back()->with('error', 'event not found !');
        }

        return view('view-inventory-event-page', compact('event'));
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
