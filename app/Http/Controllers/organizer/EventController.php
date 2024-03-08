<?php

namespace App\Http\Controllers\organizer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::all();
        //dd($categories);
        $categories = Category::all();
        return view('organizer.events',['events' => $events,'categories' => $categories]);
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
       // dd($request->input());

        $data = $request->validate([
        'title' => "required",
        'description'=> "required",
        'location'=> "required",
        'total_Tickets'=> "required",
        'event_date'=> "required",
        'category_id'=> "required",   
        ]);

        // $request->input('automatique') = 'on' ? $data['automatique'] = 1 : $data['automatique'] = 0 ;
        $data['automatique'] = $request->input('automatique') == 'on' ? 1 : 0;
        $data['organizer_id'] = Auth::user()->organizer->id;
        $data['accepted'] = 0 ;
        $data['available_Tickets'] = $data['total_Tickets'] ;

        $event = Event::create($data);
       
        if ($request->hasFile('image')) {
            $event->addMediaFromRequest('image')->toMediaCollection('events');
        }
     return redirect()->route("events.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
        $event->delete(); 
        return redirect()->route("events.index");
    }
}

