<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VehicleBookRentMailRequest;
use App\Feedback;
use App\VehicleBookRent;
Use App\RentMail;
use Mail;

class VehicleBookRentController extends Controller
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
         $VehicleBookRent=VehicleBookRent::orderBy('created_at','desc')->paginate(15);
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.book_rent.vehicle.vehicle_index',compact('VehicleBookRent','Feedback'));
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
    public function store(VehicleBookRentMailRequest $request)
    {
        $RentMail = new RentMail();
        $RentMail->subject=$request['subject'];
        $RentMail->message=$request['message'];
        $RentMail->from=$request['admin'];
        $RentMail->to=$request['email'];
        $RentMail->admin_id=Auth::user()->id;
        $save=$RentMail->save();
        if($save){
               $data = array(
              'subject'=>$request->subject,
              'BodyMessage'=>$request->message,
              'journey_date'=>$request->journey_date,
              'return_date'=>$request->return_date,
              'admin'=>$request->admin,
              'email'=>$request->email,
            );

            Mail::send('admin.email.vehicle_rent_email_index', $data , function($message) use ($data){
              $message->from($data['admin']);
              $message->to($data['email']);
              $message->subject($data['subject']);
           });
            return redirect()->route('admin-vehicle_book_rent.index')->with(['success'=>'Successfully Email sent.']);
         }
         else{
              return redirect()->route('admin-vehicle_book_rent.index')->with(['error'=>'Fail to sent email.']);
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
        $VehicleBookRent=VehicleBookRent::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.book_rent.vehicle.vehicle_index_detail',compact('VehicleBookRent','Feedback'));
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
        $VehicleBookRent=VehicleBookRent::where('id',$id)->first();
        if($VehicleBookRent->delete()){
          return redirect()->route('admin-vehicle_book_rent.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-vehicle_book_rent.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}