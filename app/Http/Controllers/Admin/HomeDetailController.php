<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\HomeDetailStoreRequest;
use App\Http\Requests\HomeDetailUpdateRequest;
use App\HomeDetail;
use App\Feedback;

class HomeDetailController extends Controller
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
         $HomeDetail=HomeDetail::orderBy('created_at','desc')->paginate(3);
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.home.home.home_index',compact('HomeDetail','Feedback'));
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
    public function store(HomeDetailStoreRequest $request)
    {
        
        $HomeDetail = new HomeDetail();
        $HomeDetail->description=$request['description'];
        $HomeDetail->admin_id=Auth::user()->id;
        $save=$HomeDetail->save();
        if($save){
            return redirect()->route('admin-home_detail.index')->with(['success'=>'Successfully Save.']);
         }
         else{
              return redirect()->route('admin-home_detail.index')->with(['error'=>'Fail to Save.']);
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
         $HomeDetail=HomeDetail::where('id',$id)->first();
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.home.home.home_index_detail',compact('HomeDetail','Feedback')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $HomeDetail=HomeDetail::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.home.home.home_index_edit',compact('HomeDetail','Feedback')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeDetailUpdateRequest $request, $id)
    {
        $HomeDetail=HomeDetail::where('id',$id)->first();
        $HomeDetail->description=$request['description'];
        $HomeDetail->admin_id=Auth::user()->id;
        $update=$HomeDetail->update();
        if($update){
            return redirect()->route('admin-home_detail.index')->with(['success'=>'Successfully update.']);
         }
         else{
              return redirect()->route('admin-home_detail.index')->with(['error'=>'Fail to update.']);
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
        $HomeDetail=HomeDetail::where('id',$id)->first();
        if($HomeDetail->delete()){
          return redirect()->route('admin-home_detail.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-home_detail.index')->with(['error'=>'Unable to Delete.']);
        }  
    }
}
