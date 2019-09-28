<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventBookRentRequestStoreRequest;
use App\EventBookRentRequest;
use App\EventDetail;
use App\VehicleType;
use App\VehicleDetail;
use App\EventPriceDetail;

class EventBookRentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $EventDetail=EventDetail::pluck('name','id');
        $VehicleType=VehicleType::pluck('name','id');
        return view('guest.book_rent.event.event_rent_index',compact('EventDetail','VehicleType'));
    }

    public function GetPrice(Request $request){
       $EventPriceDetail=EventPriceDetail::select('vehicle_price')->where('event_detail_id','=',$request->event_id)->where('vehicle_type_id','=',$request->vehicle_type_id)->first();
       return ($EventPriceDetail->vehicle_price);

    }

    public function CountVehicle(Request $request){
       $VehicleDetail=VehicleDetail::where('type_id','=',$request->vehicle_type_id)->count();
       return ($VehicleDetail);

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
    public function store(EventBookRentRequestStoreRequest $request)
    {
        $ebr = new EventBookRentRequest();
        $ebr->name=$request['name'];
        $ebr->mobile=$request['mobile'];
        $ebr->email=$request['email'];
        $ebr->description=$request['description'];
        $ebr->vehicle_amount=$request['vehicle_amount'];
        $ebr->ticket_amount=$request['ticket_amount'];
        $ebr->vehicle_type_id=$request['vehicle_type'];
        $ebr->event_detail_id=$request['event'];
        $save=$ebr->save();
        if($save){
            return redirect()->route('event-rent.index')->with(['success'=>'Successfully Book request send.']);
         }
         else{
              return redirect()->route('event-rent.index')->with(['error'=>'Fail to send book request.']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
