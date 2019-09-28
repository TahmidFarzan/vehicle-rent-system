<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EventDetailStoreRequest;
use App\Http\Requests\EventDetailUpdateRequest;
use App\EventDetail;
use App\EventType;
use App\Feedback;

class EventDetailController extends Controller
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
        $EventType=EventType::pluck('name','id');
        $EventDetail=EventDetail::orderBy('created_at','desc')->paginate(3);
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.event.event_index',compact('EventType','EventDetail','Feedback'));
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
    public function store(EventDetailStoreRequest $request)
    {
         $ed = new EventDetail();
         $ed->admin_id=Auth::user()->id;
         $ed->name = $request['name'];
         $ed->event_type_id = $request['type']; 
         $ed->descriptaion = $request['descriptaion'];
         $ed->address = $request['address'];
         $ed->map = $request['map'];
         $ed->organizar = $request['organizar'];
         $ed->patner = $request['patner'];
         $ed->start_time = $request['start_time'];
         $ed->start_date = $request['start_date'];
         $ed->end_time = $request['end_time'];
         $ed->end_date = $request['end_date'];     

          $image_file=$request->file('image');
          $image=$request->image->getClientOriginalName();
          $img_name=date('Ymdhis') . '-' . $image;
           if($image_file){
                 $ed->image_name=$img_name;  
               if($ed->save()){
                    Storage::disk('event_image')->put($img_name, File::get($image_file) );
                    return redirect()->route('admin-event.index')->with(['success'=>'Successfully save.']);
                 }
                 else{
                   return redirect()->route('admin-event.index')->with(['error'=>'Unable to save.']);
                 }
             }

             else{
                return redirect()->route('admin-event.index')->with(['error'=>'Error to save.']);
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
        $EventDetail=EventDetail::where('id','=',$id)->first();
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.event.event_index_detail',compact('EventDetail','Feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $EventDetail=EventDetail::where('id',$id)->first();
        $EventType=EventType::pluck('name','id');
        $Feedback=Feedback::orderBy('created_at','asc')->paginate(5);
        return view('admin.event.event_index_edit',compact('EventDetail','EventType','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventDetailUpdateRequest $request, $id)
    {
         $ed=EventDetail::where('id',$id)->first();
         $ed->admin_id=Auth::user()->id;
         $ed->name = $request['name'];
         $ed->event_type_id = $request['type']; 
         $ed->descriptaion = $request['descriptaion'];
         $ed->organizar = $request['organizar'];
         $ed->address = $request['address'];
         $ed->map = $request['map'];
         $ed->patner = $request['patner'];
         $ed->start_time = $request['start_time'];
         $ed->start_date = $request['start_date'];
         $ed->end_time = $request['end_time'];
         $ed->end_date = $request['end_date'];  
          $file=$request->file('image'); 
          if($file){
                 $img_found = Storage::disk('event_image')->exists( $ed->image_name );
                 if ($img_found) {
                   $img=public_path()."/image/event/".$ed->image_name;
                   $img_delete=unlink($img);
                   $image=$request->image->getClientOriginalName();
                   $img_name=date('Ymdhis') . '-' . $image ;
                   $ed->image_name=$img_name;  
                    if($ed->update()){
                      Storage::disk('event_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-event.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                       return redirect()->route('admin-event.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                 else{
                      $image=$request->image->getClientOriginalName();
                      $img_name=date('Ymdhis') . '-' . $image ;
                      $ed->image_name=$img_name;  
                      if($ed->update()){
                       Storage::disk('event_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-event.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                        return redirect()->route('admin-event.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                  
             }
            else{  
                 if($ed->update()){
                    return redirect()->route('admin-event.index')->with(['success'=>'Successfully update.']);
                 }
                 else{
                   return redirect()->route('admin-event.index')->with(['error'=>'Unable to update.']);
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
        $EventDetail=EventDetail::where('id',$id)->first();
        $img_found = Storage::disk('event_image')->exists( $EventDetail->image_name );
        if($img_found){
          $img=public_path()."/image/event/".$EventDetail->image_name;
          $img_delete=unlink($img);
         if($img_delete){
             $Delete=$EventDetail->delete();
             if($Delete){
               return redirect()->route('admin-event.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-event.index')->with(['error'=>'Unable to Delete.']);
               }  
         }
         else{
          return redirect()->route('admin-event.index')->with(['error'=>'Error to delete.']);    
         }
        }
        else{
             $Delete=$EventDetail->delete();
             if($Delete){
               return redirect()->route('admin-event.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-event.index')->with(['error'=>'Unable to Delete.']);
               }  
        } 
    }
}
