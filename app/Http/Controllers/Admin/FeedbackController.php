<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackReplyRequest;
use Mail;
use App\Feedback;
use App\User;

class FeedbackController extends Controller
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
      $Feedback=Feedback::orderBy('created_at','desc')->paginate(10);
      $User=User::orderBy('created_at','desc')->get();
      return view('admin.feedback.feedback_index_all',compact('Feedback','User'));
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

    public function ReplayMail(FeedbackReplyRequest $request)
    {
         $data = array(
            'email' =>$request->email, 
            'subject' =>$request->subject, 
            'bodyMessage' =>$request->message,
            'admin' =>$request->admin,
            'id'=>$request->id,
        );
          Mail::send('admin.email.email_index', $data , function($message) use ($data){
            $message->from($data['admin']);
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
         $FeedbackDelete=Feedback::where('id',$request->id)->first();
        if($FeedbackDelete->delete()){
          return redirect()->route('admin-feedback.index')->with(['success'=>'Successfully delete.']);
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
        $Feedbacks=Feedback::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        $User=User::orderBy('created_at','desc')->get();
        return view('admin.feedback.feedback_index_detail',compact('Feedbacks','Feedback','User'));
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
        $Feedback=Feedback::where('id',$id)->first();
        if($Feedback->delete()){
          return redirect()->route('admin-feedback.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-feedback.index')->with(['error'=>'Unable to delete.']);
        }  
    }

   
}
