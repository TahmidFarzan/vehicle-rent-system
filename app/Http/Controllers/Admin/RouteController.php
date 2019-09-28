<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Route;
use App\Feedback;


class RouteController extends Controller
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
        $Route=Route::orderBy('created_at','desc')->paginate(3);
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.route.route_index',compact('Route','Feedback'));
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
    public function store(RouteStoreRequest $request)
    {
        $request->except('to_place','from_place');
        $Route = new Route();
        $Route->time=$request['time'];
        $Route->distance=$request['distance'];
        $Route->origin=$request['origin'];
        $Route->destination=$request['destination'];
        $Route->admin_id=Auth::user()->id;
        $save=$Route->save();
        if($save){
            return redirect()->route('admin-route.index')->with(['success'=>'Successfully Save.']);
         }
         else{
              return redirect()->route('admin-route.index')->with(['error'=>'Fail to Save.']);
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
        $Route=Route::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.route.route_index_detail',compact('Route','Feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Route=Route::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.route.route_index_edit',compact('Route','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RouteUpdateRequest $request, $id)
    {
        $Route = Route::where('id',$id)->first();
        $request->except('to_place','from_place');
        $Route->time=$request['time'];
        $Route->distance=$request['distance'];
        $Route->origin=$request['origin'];
        $Route->destination=$request['destination'];

        $Route->admin_id=Auth::user()->id;
        $update=$Route->update();
        if($update){
            return redirect()->route('admin-route.index')->with(['success'=>'Successfully Save.']);
         }
         else{
              return redirect()->route('admin-route.index')->with(['error'=>'Fail to Save.']);
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
        $Route=Route::where('id',$id)->first();
        if($Route->delete()){
          return redirect()->route('admin-route.index')->with(['success'=>'Successfully delete.']);
        }
        else{
         return redirect()->route('admin-route.index')->with(['error'=>'Unable to delete.']);
        }  
    }
}
