<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Liquiasset;
use App\Models\Liquijob;

use App\Http\Resources\EventResource;

use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    // app/Http/Controllers/EventController.php
    public function index()
    {
        $events = Liquijob::all()->toArray();
        $allevents = [];
        
        foreach($events as $k => $event){
            $allevents[$k]['id'] = $event['id'];
            $allevents[$k]['title'] = $event['location_address'];
            $allevents[$k]['start'] = $event['start_date'];
        }
        //dd($allevents);

        //return response()->json($events,200);



        $data = $allevents;

  

        return response()->json($data);
        //return $events;
        // foreach($event as $events){
        //     $events_arr['title'] = $event['']
        // }
        //dd($events);

        //return EventResource::collection($events);
        //return EventResource::collection($events);
    }
    
    // // app/Http/Resources/EventResource.php
    // public function toArray($request)
    // {
    //     return [
    //         'title' => $this->title,
    //         'start' => $this->start_date,
    //         'end' => $this->end_date,
    //     ];
    // }
}