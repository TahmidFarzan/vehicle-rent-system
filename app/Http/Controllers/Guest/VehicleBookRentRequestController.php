<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleBookRentRequestStoreRequest;
use App\VehicleBookRentRequest;
use App\Route;
use App\VehicleType;
use App\VehicleRentPrice;
use App\VehicleDetail;

class VehicleBookRentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $VehicleType=VehicleType::pluck('name','id');
      $Route=Route::all();
      return view('guest.book_rent.vehicle.vehicle_rent_index',compact('VehicleType','Route'));
    }

     public function GetPrice(Request $request){
       $VehicleRentPrice=VehicleRentPrice::select('total_price')->where('route_id','=',$request->route_id)->where('vehicle_type_id','=',$request->vehicle_type_id)->first();
       return ($VehicleRentPrice->total_price);

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
    public function store(VehicleBookRentRequestStoreRequest $request)
    {
        $vbr = new VehicleBookRentRequest();
        $vbr->name=$request['name'];
        $vbr->mobile=$request['mobile'];
        $vbr->email=$request['email'];
        $vbr->journey_date=$request['journey_date'];
        $vbr->return_date=$request['return_date'];
        $vbr->description=$request['description'];
        $vbr->vehicle_amount=$request['vehicle_amount'];
        $vbr->vehicle_type_id=$request['vehicle_type'];
        $vbr->route_id=$request['route'];
        $save=$vbr->save();
        if($save){
            return redirect()->route('vehicle-rent.index')->with(['success'=>'Successfully Book request send.']);
         }
         else{
              return redirect()->route('vehicle-rent.index')->with(['error'=>'Fail to send book request.']);
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
