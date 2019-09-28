<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\RentMail;
use App\Feedback;


class RentMailController extends Controller
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
        $RentMail=RentMail::orderBy('created_at','desc')->paginate(15);
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.rent_mail.rent_mail_index',compact('RentMail','Feedback'));
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
        $RentMail=RentMail::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.rent_mail.rent_mail_index_detail',compact('RentMail','Feedback'));
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
        $RentMail=RentMail::where('id',$id)->first();
        if($RentMail->delete()){
          return redirect()->route('admin-rent_mail.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-rent_mail.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
