<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventBookRentMailRequest;
use App\Feedback;
use App\EventBookRent;
Use App\RentMail;
use App\User;
use Mail;

class EventBookRentController extends Controller
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
         $EventBookRent=EventBookRent::orderBy('created_at','desc')->paginate(15);
         $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
         $User=User::orderBy('created_at','desc')->get();
        return view('admin.book_rent.event.event_index',compact('EventBookRent','Feedback','User'));
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
    public function store(EventBookRentMailRequest $request)
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
              'event'=>$request->event,
              'admin'=>$request->admin,
              'email'=>$request->email,
            );

            Mail::send('admin.email.event_rent_email', $data , function($message) use ($data){
              $message->from($data['admin']);
              $message->to($data['email']);
              $message->subject($data['subject']);
           });
            return redirect()->route('admin-event_book_rent.index')->with(['success'=>'Successfully Email sent.']);
         }
         else{
              return redirect()->route('admin-event_book_rent.index')->with(['error'=>'Fail to sent email.']);
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
        $EventBookRent=EventBookRent::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        $User=User::orderBy('created_at','desc')->get();
        return view('admin.book_rent.event.event_index_detail',compact('EventBookRent','Feedback','User'));
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
        $EventBookRent=EventBookRent::where('id',$id)->first();
        if($EventBookRent->delete()){
          return redirect()->route('admin-event_book_rent.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-event_book_rent.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
