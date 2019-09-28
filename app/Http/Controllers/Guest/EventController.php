<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventDetail;
use App\EventPriceDetail;
use App\VehicleType;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $EventDetail=EventDetail::orderBy('created_at','asc')->get();
        return view('guest.event.event_index',compact('EventDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $EventDetail=EventDetail::where('id','=',$id)->first();
        $EventPriceDetail=EventPriceDetail::all();
        return view('guest.event.event_index_detail',compact('EventDetail','EventPriceDetail'));
    }

     public function InstantBook($id)
    {
        $EventDetail=EventDetail::where('id','=',$id)->first();
        $VehicleType=VehicleType::pluck('name','id');
        return view('guest.event.event_index_detail_instant_book',compact('EventDetail','VehicleType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
