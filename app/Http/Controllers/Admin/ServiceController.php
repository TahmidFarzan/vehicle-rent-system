<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Service;
use App\Feedback;

class ServiceController extends Controller
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
        $Service=Service::orderBy('created_at','desc')->paginate(5);
         return view('admin.service.service_index',compact('Service','Feedback'));
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
    public function store(ServiceStoreRequest $request)
    {
         $Service = new Service();
         $Service->admin_id=Auth::user()->id;
         $Service->name = $request['name'];
         $Service->description = $request['description'];
          $image_file=$request->file('image');
          $images=$request->image->getClientOriginalName();
          $img_name=date('Ymdhis') . '-' . $images;
           if($image_file){
                 $Service->image_name=$img_name;  
               if($Service->save()){
                    Storage::disk('service_image')->put($img_name, File::get($image_file) );
                    return redirect()->route('admin-service.index')->with(['success'=>'Successfully save.']);
                 }
                 else{
                   return redirect()->route('admin-service.index')->with(['error'=>'Unable to save.']);
                 }
             }

             else{
                return redirect()->route('admin-service.index')->with(['error'=>'Error to save.']);
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
        $Service=Service::where('id',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.service.service_index_detail',compact('Service','Feedback')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $Service=Service::where('id','=',$id)->first();
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
         return view('admin.service.service_index_edit',compact('Service','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
        $Service=Service::where('id',$id)->first();
        $Service->admin_id=Auth::user()->id;
        $Service->name = $request['name'];
        $Service->description = $request['description'];
          $file=$request->file('image'); 
          if($file){
                 $img_found = Storage::disk('service_image')->exists( $Service->image_name );
                 if ($img_found) {
                   $img=public_path()."/image/service/".$Service->image_name;
                   $img_delete=unlink($img);
                   $image=$request->image->getClientOriginalName();
                   $img_name=date('Ymdhis') . '-' . $image ;
                   $Service->image_name=$img_name;  
                    if($Service->update()){
                      Storage::disk('service_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-service.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                       return redirect()->route('admin-service.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                 else{
                      $image=$request->image->getClientOriginalName();
                      $img_name=date('Ymdhis') . '-' . $image ;
                      $Service->image_name=$img_name;  
                      if($Service->update()){
                       Storage::disk('service_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-service.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                        return redirect()->route('admin-service.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                  
             }
            else{  
                 if($Service->update()){
                    return redirect()->route('admin-service.index')->with(['success'=>'Successfully update.']);
                 }
                 else{
                   return redirect()->route('admin-service.index')->with(['error'=>'Unable to update.']);
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
        $Service=Service::where('id',$id)->first();
        $img_found = Storage::disk('service_image')->exists( $Service->image_name );
        if($img_found){
          $img=public_path()."/image/service/".$Service->image_name;
          $img_delete=unlink($img);
         if($img_delete){
             $Delete=$Service->delete();
             if($Delete){
               return redirect()->route('admin-service.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-service.index')->with(['error'=>'Unable to Delete.']);
               }  
         }
         else{
          return redirect()->route('admin-service.index')->with(['error'=>'Error to delete.']);    
         }
        }
        else{
             $Delete=$Service->delete();
             if($Delete){
               return redirect()->route('admin-service.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-service.index')->with(['error'=>'Unable to Delete.']);
               }  
        }
    
    }
}
