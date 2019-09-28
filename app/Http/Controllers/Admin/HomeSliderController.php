<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\HomeSliderStoreRequest;
use App\Http\Requests\HomeSliderUpdateRequest;
use App\HomeSlider;
use App\Feedback;

class HomeSliderController extends Controller
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
         $HomeSlider=HomeSlider::orderBy('created_at','desc')->paginate(3);
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.home.slider.slider_index',compact('HomeSlider','Feedback'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function DuplicateSequence(Request $request){
       $HomeSlider=HomeSlider::select('slider_sequence')->where('id',$request->id)->first();
       return ($HomeSlider->slider_sequence);
    }

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
    public function store(HomeSliderStoreRequest $request)
    {
         $hs = new HomeSlider();
         $hs->admin_id=Auth::user()->id;
         $hs->slider_url = $request['url'];
         $hs->slider_alt = $request['alt_text'];
         $hs->slider_sequence = $request['slider_sequence'];
          $image_file=$request->file('image');
          $image=$request->image->getClientOriginalName();
          $img_name=date('Ymdhis') . '-' . $image;
           if($image_file){
                 $hs->slider_name=$img_name;  
               if($hs->save()){
                    Storage::disk('slider_image')->put($img_name, File::get($image_file) );
                    return redirect()->route('admin-home_slider.index')->with(['success'=>'Successfully save.']);
                 }
                 else{
                   return redirect()->route('admin-home_slider.index')->with(['error'=>'Unable to save.']);
                 }
             }

             else{
                return redirect()->route('admin-home_slider.index')->with(['error'=>'Error to save.']);
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
        $HomeSlider=HomeSlider::where('id','=',$id)->first();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.home.slider.slider_index_detail',compact('HomeSlider','Feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $HomeSlider=HomeSlider::where('id','=',$id)->first();
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
         return view('admin.home.slider.slider_index_edit',compact('HomeSlider','Feedback'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeSliderUpdateRequest $request, $id)
    {
          $HomeSlider=HomeSlider::where('id',$id)->first();
          $HomeSlider->slider_url=$request['url'];
          $HomeSlider->slider_alt = $request['alt_text'];
          $HomeSlider->slider_sequence = $request['slider_sequence'];
          $HomeSlider->admin_id=Auth::user()->id;  
          $file=$request->file('image'); 
          if($file){
                 $img_found = Storage::disk('slider_image')->exists( $HomeSlider->slider_name );
                 if ($img_found) {
                   $img=public_path()."/image/home/slider/".$HomeSlider->slider_name;
                   $img_delete=unlink($img);
                   $image=$request->image->getClientOriginalName();
                   $img_name=date('Ymdhis') . '-' . $image ;
                   $HomeSlider->slider_name=$img_name;  
                    if($HomeSlider->update()){
                      Storage::disk('slider_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-home_slider.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                       return redirect()->route('admin-home_slider.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                 else{
                      $image=$request->image->getClientOriginalName();
                      $img_name=date('Ymdhis') . '-' . $image ;
                      $HomeSlider->slider_name=$img_name;  
                      if($HomeSlider->update()){
                       Storage::disk('slider_image')->put($img_name, File::get($file) );
                       return redirect()->route('admin-home_slider.index')->with(['success'=>'Successfully update.']);
                      }
                    else{
                        return redirect()->route('admin-home_slider.index')->with(['error'=>'Unable to update.']);
                      }
                 }
                  
             }
            else{  
                 if($HomeSlider->update()){
                    return redirect()->route('admin-home_slider.index')->with(['success'=>'Successfully update.']);
                 }
                 else{
                   return redirect()->route('admin-home_slider.index')->with(['error'=>'Unable to update.']);
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
        $HomeSlider=HomeSlider::where('id',$id)->first();
        $img_found = Storage::disk('slider_image')->exists( $HomeSlider->slider_name );
        if($img_found){
          $img=public_path()."/image/home/slider/".$HomeSlider->slider_name;
          $img_delete=unlink($img);
         if($img_delete){
             $Delete=$HomeSlider->delete();
             if($Delete){
               return redirect()->route('admin-home_slider.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-home_slider.index')->with(['error'=>'Unable to Delete.']);
               }  
         }
         else{
          return redirect()->route('admin-home_slider.index')->with(['error'=>'Error to delete.']);    
         }
        }
        else{
             $Delete=$HomeSlider->delete();
             if($Delete){
               return redirect()->route('admin-home_slider.index')->with(['success'=>'Successfully Delete.']);
             }
             else{
               return redirect()->route('admin-home_slider.index')->with(['error'=>'Unable to Delete.']);
               }  
        }
    }
}
