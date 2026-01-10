<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create()
    {
        return view('new-event'); // your Blade file
    }
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'thumbnail' => 'nullable|image|max:2048',
        'location' => 'required|string|max:255',
        'coordination' => 'required|string', // <-- added
        'price' => 'required|integer|min:0',
        'quantity_type' => 'required|in:infinite,custom',
        'quantity' => 'nullable|integer|min:0',
        'stated_at' => 'required|date',
        'end_at' => 'nullable|date|after_or_equal:stated_at',
    ]);

    $data = $request->only([
        'title', 'description', 'location', 'coordination', 'price', 'stated_at', 'end_at'
    ]);

    // Handle quantity
    $data['quantity'] = $request->quantity_type === 'infinite' ? 0 : $request->quantity;

    // Set user
    $data['userId'] = Auth::id();

    // Set validation
    $data['validation'] = 'pending';

    // Handle thumbnail
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/thumbnails', $filename);
        $data['thumbnail'] = 'thumbnails/' . $filename;
    }

    Event::create($data);

    return redirect()->route('home')
        ->with('success', 'Event created successfully!');
}
}
