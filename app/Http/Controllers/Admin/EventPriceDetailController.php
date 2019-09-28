<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventPriceDetailStoreRequest;
use App\Http\Requests\EventPriceDetailUpdateRequest;
use App\EventDetail;
use App\VehicleType;
use App\EventPriceDetail;
use App\Feedback;

class EventPriceDetailController extends Controller
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
        $VehicleType=VehicleType::pluck('name','id');
        $EventDetail=EventDetail::pluck('name','id');
        $EventPriceDetail=EventPriceDetail::orderBy('created_at','asc')->paginate(5);
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.price.event.event_price_index',compact('EventPriceDetail','EventDetail','VehicleType','Feedback'));
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
    public function store(EventPriceDetailStoreRequest $request)
    {
        $epd = new EventPriceDetail();
        $epd->event_detail_id=$request['event'];
        $epd->vehicle_type_id=$request['vehicle_type'];
        $epd->ticket_price=$request['ticket_price'];
        $epd->vehicle_price=$request['vehicle_price'];
        $epd->total_price=$request['total_price'];
        $epd->admin_id=Auth::user()->id;
        $save=$epd->save();
        if($save){
            return redirect()->route('admin-event_price.index')->with(['success'=>'Successfully Save.']);
         }
         else{
              return redirect()->route('admin-event_price.index')->with(['error'=>'Fail to Save.']);
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
        $EventPriceDetail=EventPriceDetail::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.price.event.event_price_index_detail',compact('EventPriceDetail','Feedback')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $VehicleType=VehicleType::pluck('name','id');
         $EventDetail=EventDetail::pluck('name','id');
         $EventPriceDetail=EventPriceDetail::where('id',$id)->first();
         $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.price.event.event_price_index_edit',compact('EventDetail','VehicleType','EventPriceDetail','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventPriceDetailUpdateRequest $request, $id)
    {
           $epd=EventPriceDetail::where('id',$id)->first();
           $epd->event_detail_id=$request['event'];
           $epd->vehicle_type_id=$request['vehicle_type'];
           $epd->ticket_price=$request['ticket_price'];
           $epd->vehicle_price=$request['vehicle_price'];
           $epd->total_price=$request['total_price'];
           $epd->admin_id=Auth::user()->id;
           if($epd->update()){
             return redirect()->route('admin-event_price.index')->with(['success'=>'Successfully update.']);
             }
             else{
              return redirect()->route('admin-event_price.index')->with(['error'=>'Unable to update.']);
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
         $EventPriceDetail=EventPriceDetail::where('id',$id)->first();
        if($EventPriceDetail->delete()){
          return redirect()->route('admin-event_price.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-event_price.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
