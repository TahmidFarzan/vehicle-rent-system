<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\VehicleBookRentStoreRequest;
use App\Http\Requests\EventBookRentStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Feedback;
use App\VehicleBookRentRequest;
use App\EventBookRentRequest;
use App\EventPriceDetail;
use App\VehicleRentPrice;
use App\EventBookRent;
use App\VehicleBookRent;
use App\RentMail;
use App\User;
use Mail;

class DashboardController extends Controller
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
      $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
      $User=User::pluck('email');
      $EventBookRentRequest=EventBookRentRequest::orderBy('created_at','desc')->paginate(5);
      $VehicleBookRentRequest=VehicleBookRentRequest::orderBy('created_at','desc')->paginate(5);
      return view('admin.dashboard.dashboard',compact('Feedback','EventBookRentRequest','VehicleBookRentRequest','User','Users'));
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

    /** Vehicle accept controller **/
    public function store(VehicleBookRentStoreRequest $request)
    {
        $request->except('hidden_price');
        $VehicleBookRent = new VehicleBookRent();
        $VehicleBookRent->name=$request['name'];
        $VehicleBookRent->mobile=$request['mobile'];
        $VehicleBookRent->email=$request['email'];
        $VehicleBookRent->journey_date=$request['journey_date'];
        $VehicleBookRent->return_date=$request['return_date'];
        $VehicleBookRent->description=$request['description'];
        $VehicleBookRent->vehicle_amount=$request['vehicle_amount'];
        $VehicleBookRent->vehicle_type_id=$request['vehicle_type'];
        $VehicleBookRent->route_id=$request['route'];
        $VehicleBookRent->price=$request['price'];
        $VehicleBookRent->admin_id=Auth::user()->id;
        $save=$VehicleBookRent->save();
        if($save){

               $data = array(
              'name'=>$request->name,
              'mobile'=>$request->mobile,
              'admin_email'=>$request->admin_email,
              'email'=>$request->email,
              'journey_date'=>$request->journey_date,
              'return_date'=>$request->return_date,
              'description'=>$request->description,
              'vehicle_amount'=>$request->vehicle_amount,
              'vehicle_type'=>$request->vehicle_type_email,
              'route'=>$request->route_email,
              'price'=>$request->price,
            );

            Mail::send('admin.email.book_rent_email_index', $data , function($message) use ($data){
              $message->from($data['admin_email']);
              $message->to($data['email']);
              $message->subject('Book rent details');
           });
            $vbrr_delete=VehicleBookRentRequest::where('id',$request->VehicleBookRentRequest_id)->first();
            if($vbrr_delete->delete()){
                return redirect()->route('admin.index')->with(['success'=>'Successfully Book request accept.']);
            }
         }
         else{
              return redirect()->route('admin.index')->with(['error'=>'Fail to accept book request.']);
         }
    }

 /** Event accept controller **/
    public function EventBookRequestAceept(EventBookRentStoreRequest $request){
        $request->except('hidden_ticket_price','hidden_vehicle_price');
        $EventBookRent = new EventBookRent();
        $EventBookRent->name=$request['name'];
        $EventBookRent->mobile=$request['mobile'];
        $EventBookRent->email=$request['email'];
        $EventBookRent->description=$request['description'];
        $EventBookRent->vehicle_amount=$request['vehicle_amount'];
        $EventBookRent->vehicle_type_id=$request['vehicle_type'];
        $EventBookRent->event_detail_id=$request['event'];
        $EventBookRent->ticket_amount=$request['ticket_amount'];
        $EventBookRent->price=$request['price'];
        $EventBookRent->admin_id=Auth::user()->id;
        $save=$EventBookRent->save();
        if($save){

               $data = array(
              'name'=>$request->name,
              'mobile'=>$request->mobile,
              'admin_email'=>$request->admin_email,
              'email'=>$request->email,
              'description'=>$request->description,
              'vehicle_amount'=>$request->vehicle_amount,
              'ticket_amount'=>$request->ticket_amount,
              'vehicle_type'=>$request->vehicle_type_email,
              'events'=>$request->event_email,
              'price'=>$request->price,
            );

            Mail::send('admin.email.event_rent_email_index', $data , function($message) use ($data){
              $message->from($data['admin_email']);
              $message->to($data['email']);
              $message->subject('Event rent details');
           });
            $ebrr_delete=EventBookRentRequest::where('id',$request->EventBookRentRequest_id)->first();
            if($ebrr_delete->delete()){
                return redirect()->route('admin.index')->with(['success'=>'Successfully Book request accept.']);
            }
         }
         else{
              return redirect()->route('admin.index')->with(['error'=>'Fail to accept book request.']);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /** Vehicle book rent list controller **/
    public function VehicleBookRequestList(){
      $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
      $User=User::all();
      $VehicleBookRentRequest=VehicleBookRentRequest::orderBy('created_at','desc')->paginate(15);
      return view('admin.dashboard.dashboard_vehicle_request_list',compact('Feedback','VehicleBookRentRequest','User'));
    }

    /** Event book rent list controller **/
    public function EventBookRequestList(){
      $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
      $User=User::all();
      $EventBookRentRequest=EventBookRentRequest::orderBy('created_at','desc')->paginate(15);
      return view('admin.dashboard.dashboard_event_request_list',compact('Feedback','EventBookRentRequest','User'));
    }

 

    /**  Vehicle detail controller **/
    public function show($id)
    {
       $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
       $VehicleRentPrice=VehicleRentPrice::orderBy('created_at','desc')->get();
       $VehicleBookRentRequest=VehicleBookRentRequest::where('id',$id)->first();
       $ReqUser=VehicleBookRentRequest::select('email')->where('id',$id)->pluck('email')->first();
       $RegUserCount=User::select('email')->where('email',$ReqUser)->count();
       return view('admin.dashboard.dashboard_vehicle_detail',compact('Feedback','VehicleBookRentRequest','VehicleRentPrice','RegUserCount'));
    }

    /** Event detail controller **/
    public function EventBookRequestDetail($id)
    {
      $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
      $EventPriceDetail=EventPriceDetail::all();
      $EventBookRentRequest=EventBookRentRequest::where('id',$id)->first();
      $ReqUser=EventBookRentRequest::select('email')->where('id',$id)->pluck('email')->first();
      $RegUserCount=User::select('email')->where('email',$ReqUser)->count();
      return view('admin.dashboard.dashboard_event_detail',compact('Feedback','EventBookRentRequest','EventPriceDetail','EventPriceDetail','RegUserCount'));
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
    /** Vehicle Reject controller **/
    public function VehicleBookRequestReject(Request $request)
    {
       $data = array(
            'admins_email'=>$request->admins_email,
            'user'=>$request->user,
          );
       $VehicleBookRentRequest=VehicleBookRentRequest::where('id',$request->VehicleBookRentRequest_id_reject)->first();
             if($VehicleBookRentRequest->delete()){
                    Mail::send('admin.email.rent_reject_index', $data , function($message) use ($data){
                                   $message->from($data['admins_email']);
                                   $message->to($data['user']);
                                   $message->subject('Vehicle book rent details');
                                 });
                    return redirect()->route('admin.index')->with(['success'=>'Successfully rejected.']);
              }
              else{
                  return redirect()->route('admin.index')->with(['error'=>'Unable to rejected.']);
                }  
    }

   /** Event Reject controller **/
    public function EventGuestBookRequestReject(Request $request)
    {
       $data = array(
            'admins_email'=>$request->admins_email,
            'user'=>$request->user,
          );
       $EventBookRentRequest=EventBookRentRequest::where('id',$request->EventBookRentRequest_id_reject)->first();
             if($EventBookRentRequest->delete()){
                    Mail::send('admin.email.rent_reject_index', $data , function($message) use ($data){
                                   $message->from($data['admins_email']);
                                   $message->to($data['user']);
                                   $message->subject('Event book rent details');
                                 });
                    return redirect()->route('admin.index')->with(['success'=>'Successfully rejected.']);
              }
              else{
                  return redirect()->route('admin.index')->with(['error'=>'Unable to rejected.']);
                } 
    }


  
}
