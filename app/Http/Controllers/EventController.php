<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function viewInventory(){
        $events=auth()->user()->events;
        return view('inventory',compact('events'));
    }

    public function create(){
        $categories=Category::all();
        return view('new-event',compact('categories'));
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
        'stated_at' => 'required|date',
        'end_at' => 'nullable|date|after_or_equal:stated_at',
        'categories' => 'required|array',          
        'categories.*' => 'exists:categories,id',  
    ]);

    $data = $request->only([
        'title', 'description', 'location', 'coordination', 'price', 'stated_at', 'end_at'
    ]);

    $data['quantity'] = $request->quantity_type === 'infinite' ? 0 : $request->quantity;
    $data['userId'] = Auth::id();
    $data['validation'] = 'pending';

    if ($request->hasFile('thumbnail')) {
        $thumbnailPath = $request->file('thumbnail')->store("thumbnails",'public');
        $data['thumbnail'] = '/storage/' . $thumbnailPath;
    }

    $event = Event::create($data);
    $event->categories()->attach($request->categories);

    return redirect()->route('home')
        ->with('success', 'Event created successfully!');
}

    public function destroy(Request $req){
        try {
        $data=$req->validate(["eventId"=>"required"]);
        $event=Event::find($data['eventId']);
        // ! check for 404
            if(!$event) return redirect()->back()->with("error",'Event Not Found !');
        // ! delete thumbnail
            if($event->thumbnail && Storage::disk('public')->exist($event->thumbnail)){
                Storage::disk("public")->delete($event->thumbnail);
            }
            $event->delete();
            return redirect()->back()->with("success",'Event Deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!')->with("errorMsg",$th);

        }
    }
}
