<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VehicleRentPriceStoreRequest;
use App\Http\Requests\VehicleRentPriceUpdateRequest;
use App\Feedback;
use App\VehicleRentPrice;
use App\VehicleType;
use App\Route;

class VehicleRentPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $Route=Route::all();
        $VehicleType=VehicleType::pluck('name','id');
        $VehicleRentPrice=VehicleRentPrice::orderBy('created_at','asc')->paginate(5);
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.price.vehicle_rent.vehicle_rent_index',compact('VehicleRentPrice','Route','VehicleType','Feedback'));
    }

      public function GetDistance(Request $request){
       $Route=Route::select('distance')->where('id',$request->id)->first();
       return ($Route->distance);

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
    public function store(VehicleRentPriceStoreRequest $request)
    {
        $vrp = new VehicleRentPrice();
        $vrp->route_id=$request['route'];
        $vrp->vehicle_type_id=$request['vehicle_type'];
        $vrp->distance_price=$request['distance_price'];
        $vrp->rent_price=$request['rent_price'];
        $vrp->total_price=$request['total_price'];
        $vrp->admin_id=Auth::user()->id;
        $save=$vrp->save();
        if($save){
            return redirect()->route('admin-vehicle_rent_price.index')->with(['success'=>'Successfully Save.']);
         }
         else{
              return redirect()->route('admin-vehicle_rent_price.index')->with(['error'=>'Fail to Save.']);
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
        $VehicleRentPrice=VehicleRentPrice::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.price.vehicle_rent.vehicle_rent_index_detail',compact('VehicleRentPrice','Feedback')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Route=Route::all();
        $VehicleType=VehicleType::pluck('name','id');
        $VehicleRentPrice=VehicleRentPrice::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.price.vehicle_rent.vehicle_rent_index_edit',compact('VehicleRentPrice','Route','VehicleType','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRentPriceUpdateRequest $request, $id)
    {
           $vrp=VehicleRentPrice::where('id',$id)->first();
           $vrp->route_id=$request['route'];
           $vrp->vehicle_type_id=$request['vehicle_type'];
           $vrp->distance_price=$request['distance_price'];
           $vrp->rent_price=$request['rent_price'];
           $vrp->total_price=$request['total_price'];
           $vrp->admin_id=Auth::user()->id;
           if($vrp->update()){
             return redirect()->route('admin-vehicle_rent_price.index')->with(['success'=>'Successfully update.']);
             }
             else{
              return redirect()->route('admin-vehicle_rent_price.index')->with(['error'=>'Unable to update.']);
             }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $VehicleRentPrice=VehicleRentPrice::where('id',$id)->first();
        if($VehicleRentPrice->delete()){
          return redirect()->route('admin-vehicle_rent_price.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-vehicle_rent_price.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
