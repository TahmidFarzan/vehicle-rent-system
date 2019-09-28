<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AboutUsStoreRequest;
use App\Http\Requests\AboutUsUpdateRequest;
use App\Feedback;
use App\AboutUs;

class AboutUsController extends Controller
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
        $AboutUs=AboutUs::orderBy('created_at','desc')->paginate(3);
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.about_us.about_us_index',compact('AboutUs','Feedback'));
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
    public function store(AboutUsStoreRequest $request)
    {
        $AboutUs = new AboutUs();
        $AboutUs->description=$request['description'];
        $AboutUs->admin_id=Auth::user()->id;
        $Save=$AboutUs->save();
        if($Save){
            return redirect()->route('admin-about_us.index')->with(['success'=>'Successfully Save.']);
         }
         else{
              return redirect()->route('admin-about_us.index')->with(['error'=>'Fail to Save.']);
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
        $AboutUs=AboutUs::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.about_us.about_us_detail',compact('AboutUs','Feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AboutUs=AboutUs::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.about_us.about_us_edit',compact('AboutUs','Feedback')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AboutUsUpdateRequest $request, $id)
    {
        $AboutUs=AboutUs::where('id',$id)->first();
        $AboutUs->description=$request['description'];
        $AboutUs->admin_id=Auth::user()->id;
        $Update=$AboutUs->update();
        if($Update){
            return redirect()->route('admin-about_us.index')->with(['success'=>'Successfully update.']);
         }
         else{
              return redirect()->route('admin-about_us.index')->with(['error'=>'Fail to update.']);
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
        $AboutUs=AboutUs::where('id',$id)->first();
        if($AboutUs->delete()){
          return redirect()->route('admin-about_us.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-about_us.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
