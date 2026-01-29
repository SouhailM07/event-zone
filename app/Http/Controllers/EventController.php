<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $req)
    {
        $title = $req->title;
        $selectedCategory = $req->category;

        $categories = Category::query()
            ->when($selectedCategory, function ($q) use ($selectedCategory) {
                $q->where('id', $selectedCategory);
            })
            ->with(['events' => function ($q) use ($req) {
                $q->where('validation', 'approved')
                    ->when($req->filled('title'), function ($q) use ($req) {
                        $q->where('title', 'like', '%'.$req->title.'%');
                    });
            }])
            ->get();

        $eventsByCategory = $categories
            ->map(fn ($category) => [
                'type' => $category->name,
                'events' => $category->events,
                'count' => $category->events->count(),
            ])
            ->filter(fn ($item) => $item['count'] > 0)
            ->values();

        $totalEvents = $eventsByCategory->sum('count');

        return view('view-events-page', compact(
            'eventsByCategory',
            'title',
            'totalEvents',
            'selectedCategory'
        ));
    }

    public function show($id)
    {

        $event = Event::find($id);

        // if(! $event) reerect to 404
        return view('view-event-page', compact('event'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('new-event', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'location' => 'required|string|max:255',
            'coordination' => 'required|string',
            'price' => 'required|integer|min:0',
            'quantity_type' => 'required|in:infinite,custom',
            'quantity' => 'nullable|integer|min:0',
            'started_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:stated_at',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data = $request->only([
            'title', 'description', 'location', 'coordination', 'price', 'started_at', 'end_at',
        ]);

        $data['quantity'] = $request->quantity_type === 'infinite' ? 0 : $request->quantity;
        $data['userId'] = Auth::id();
        $data['validation'] = 'pending';

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = '/storage/'.$thumbnailPath;
        }

        $event = Event::create($data);
        $event->categories()->attach($request->categories);

        return redirect()->route('home')
            ->with('success', 'Event created successfully!');
    }

    public function destroy($id)
    {
        try {
            $event = Event::find($id);
            // ! check for 404
            if (! $event) {
                return redirect()->back()->with('error', 'Event Not Found !');
            }
            // ! delete thumbnail
            if ($event->thumbnail && Storage::disk('public')->exist($event->thumbnail)) {
                Storage::disk('public')->delete($event->thumbnail);
            }
            $event->delete();

            return redirect()->back()->with('success', 'Event Deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!')->with('errorMsg', $th);
        }
    }

    public function edit($id)
    {
        $categories = Category::all();
        $event = Event::find($id);
        if (! $event) {
            return redirect()->back()->with('error', 'event was not found');
        }

        return view('edit-event-page', compact(['event', 'categories']));
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (! $event) {
            return redirect()->back()->with('error', 'Event not found!');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'location' => 'required|string|max:255',
            'coordination' => 'required|string',
            'price' => 'required|integer|min:0',
            'quantity_type' => 'required|in:infinite,custom',
            'quantity' => 'nullable|integer|min:0',
            'started_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:started_at',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data = $request->only([
            'title',
            'description',
            'location',
            'coordination',
            'price',
            'started_at',
            'end_at',
        ]);

        // quantity logic
        $data['quantity'] = $request->quantity_type === 'infinite'
            ? 0
            : $request->quantity;

        if ($request->hasFile('thumbnail')) {

            // delete old thumbnail if exists
            if ($event->thumbnail) {
                $oldPath = str_replace('/storage/', '', $event->thumbnail);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $data['thumbnail'] = '/storage/'.$thumbnailPath;
        }

        // update event
        $event->update($data);

        // sync categories (remove old, add new)
        $event->categories()->sync($request->categories);

        return redirect()
            ->route('home')
            ->with('success', 'Event updated successfully!');
    }
}
