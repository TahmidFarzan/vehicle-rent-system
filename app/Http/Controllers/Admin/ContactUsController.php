<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactUsStoreRequest;
use App\Http\Requests\ContactUsUpdateRequest;
use App\ContactUs;
use App\Feedback;

class ContactUsController extends Controller
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
         $ContactUs=ContactUs::orderBy('created_at','desc')->paginate(3);
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
         return view('admin.contact.contact_index',compact('ContactUs','Feedback'));
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
    public function store(ContactUsStoreRequest $request)
    {
           $cu = new ContactUs();
           $cu->admin_id=Auth::user()->id;
           $cu->office=$request['office'];
           $cu->address=$request['address'];
           $cu->cell=$request['cell'];
           $cu->email=$request['email'];
           if($cu->save()){
             return redirect()->route('admin-contact.index')->with(['success'=>'Successfully save.']);
             }
             else{
              return redirect()->route('admin-contact.index')->with(['error'=>'Unable to save.']);
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
        $ContactUs=ContactUs::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.contact.contact_index_detail',compact('ContactUs','Feedback')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $ContactUs=ContactUs::where('id',$id)->first();
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.contact.contact_index_edit',compact('ContactUs','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUsUpdateRequest $request, $id)
    {
           $cu=ContactUs::where('id',$id)->first();
           $cu->admin_id=Auth::user()->id;
           $cu->office=$request['office'];
           $cu->address=$request['address'];
           $cu->cell=$request['cell'];
           $cu->email=$request['email'];
           if($cu->update()){
             return redirect()->route('admin-contact.index')->with(['success'=>'Successfully update.']);
             }
             else{
              return redirect()->route('admin-contact.index')->with(['error'=>'Unable to update.']);
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
        $ContactUs=ContactUs::where('id',$id)->first();
        if($ContactUs->delete()){
          return redirect()->route('admin-contact.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-contact.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
