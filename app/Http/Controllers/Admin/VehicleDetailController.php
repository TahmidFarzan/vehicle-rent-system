<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\VehicleDetailStoreRequest;
use App\Http\Requests\VehicleDetailUpdateRequest;
use App\VehicleType;
use App\VehicleDetail;
use App\Feedback;

class VehicleDetailController extends Controller
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
        $VehicleDetail=VehicleDetail::orderBy('created_at','desc')->paginate(3);
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.vehicle.vehicle_index',compact('VehicleType','VehicleDetail','Feedback'));
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
    public function store(VehicleDetailStoreRequest $request)
    {
         $vd = new VehicleDetail();
         $vd->admin_id=Auth::user()->id;
         $vd->name = $request['name'];
         $vd->type_id = $request['type']; 
         $vd->seat=$request['seat'];
         $vd->licence_no=$request['licence_no'];

          $image_file=$request->file('image');
          $image=$request->image->getClientOriginalName();
          $img_name=date('Ymdhis') . '-' . $image;
           if($image_file){
                 $vd->image_name=$img_name;  
               if($vd->save()){
                    Storage::disk('vehicle_image')->put($img_name, File::get($image_file) );
                    return redirect()->route('admin-vehicle.index')->with(['success'=>'Successfully save.']);
                 }
                 else{
                   return redirect()->route('admin-vehicle.index')->with(['error'=>'Unable to save.']);
                 }
             }

             else{
                return redirect()->route('admin-vehicle.index')->with(['error'=>'Error to save.']);
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
        $VehicleDetail=VehicleDetail::where('id','=',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.vehicle.vehicle_index_detail',compact('VehicleDetail','Feedback'));
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
        $VehicleDetail=VehicleDetail::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.vehicle.vehicle_index_edit',compact('VehicleType','VehicleDetail','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleDetailUpdateRequest $request, $id)
    {
          $VehicleDetail=VehicleDetail::where('id',$id)->first();
          $VehicleDetail->name=$request['name'];
          $VehicleDetail->type_id=$request['type'];
          $VehicleDetail->seat=$request['seat'];
          $VehicleDetail->licence_no=$request['licence_no'];
          $VehicleDetail->admin_id=Auth::user()->id;  
          $file=$request->file('image'); 
          if($file){
                 $img_found = Storage::disk('vehicle_image')->exists( $VehicleDetail->image_name );
                 if ($img_found) {
                   $img=public_path()."/image/vehicle/".$VehicleDetail->image_name;
                   $img_delete=unlink($img);
                   $image=$request->image->getClientOriginalName();
                   $img_name=date('Ymdhis') . '-' . $image ;
                   $VehicleDetail->image_name=$img_name;  
                    if($VehicleDetail->update()){
                      Storage::disk('vehicle_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-vehicle.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                       return redirect()->route('admin-vehicle.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                 else{
                      $image=$request->image->getClientOriginalName();
                      $img_name=date('Ymdhis') . '-' . $image ;
                      $VehicleDetail->image_name=$img_name;  
                      if($VehicleDetail->update()){
                       Storage::disk('vehicle_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-vehicle.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                        return redirect()->route('admin-vehicle.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                  
             }
            else{  
                 if($VehicleDetail->update()){
                    return redirect()->route('admin-vehicle.index')->with(['success'=>'Successfully update.']);
                 }
                 else{
                   return redirect()->route('admin-vehicle.index')->with(['error'=>'Unable to update.']);
                 }  
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
        $VehicleDetail=VehicleDetail::where('id',$id)->first();
        $img_found = Storage::disk('vehicle_image')->exists( $VehicleDetail->image_name );
        if($img_found){
          $img=public_path()."/image/vehicle/".$VehicleDetail->image_name;
          $img_delete=unlink($img);
         if($img_delete){
             $Delete=$VehicleDetail->delete();
             if($Delete){
               return redirect()->route('admin-vehicle.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-vehicle.index')->with(['error'=>'Unable to Delete.']);
               }  
         }
         else{
          return redirect()->route('admin-vehicle.index')->with(['error'=>'Error to delete.']);    
         }
        }
        else{
             $Delete=$VehicleDetail->delete();
             if($Delete){
               return redirect()->route('admin-vehicle.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-vehicle.index')->with(['error'=>'Unable to Delete.']);
               }  
        }  
    }
}
