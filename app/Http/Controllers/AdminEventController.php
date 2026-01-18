<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $events = Event::query()
            ->when($request->filled('title'), function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->title.'%');
            })
            ->when($request->filled('validation'), function ($q) use ($request) {
                $q->where('validation', $request->validation);
            })
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->whereHas('categories', function ($cat) use ($request) {
                    $cat->where('categories.id', $request->category);
                });
            })
            ->get();

        return view('admin.events-admin', compact('events', 'categories'));
    }

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
            return redirect()->back()->with('error', 'Event not found 404');
        }

        return view('view-event-admin-page', compact('event'));
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
    public function update(Request $req, string $id)
    {
        try {
            $event = Event::find($id);
            if (! $event) {
                return redirect()->back()->with('error', 'Event not found 404');
            }
            $data = $req->validate([
                'validation' => 'required|in:pending,approved,rejected',
                'whyRejected' => 'nullable|string',
            ]);
            $whyRejected = $data['validation'] == 'approved' ? '' : $data['whyRejected'];
            $event->update([
                'validation' => $data['validation'],
                'whyRejected' => $whyRejected,
            ]);

            return redirect()->back()->with('success', 'event validation was updated');
        } catch (\Throwable $th) {
            dd($th);

            return redirect()->back()->with('error', 'Something went wrong!')->with('errorMsg', $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
