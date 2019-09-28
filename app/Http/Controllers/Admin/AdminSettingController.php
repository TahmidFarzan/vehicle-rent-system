<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Feedback;
use App\Admin;

class AdminSettingController extends Controller
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
        $Admin=Admin::orderBy('created_at','desc')->get();
        $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
        return view('admin.admin_setting.admin_setting_index',compact('Admin','Feedback'));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $Admin=Admin::where('id','=',$id)->first();
         $Feedback=Feedback::orderBy('created_at','desc')->paginate(5);
         if ($Admin->id==Auth::user()->id) {
            return view('admin.admin_setting.admin_setting_edit',compact('Admin','Feedback'));
         }
         else{
            return redirect()->route('admin_setting.index')->with(['error'=>'Unauthorise to edit.']); 
         }
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
         $validator = Validator::make($request->all(), [
            'name' => array(
               'required',
               'string',
               'max:50'
              ),
            'email' => array(
               'required',
               'string',
               'email',
               'max:50',
               "unique:admins,email,$id"
              ),
            'old_password' => array(
               'required',
               'string',
               'min:6',
               'max:255'
              ),
            'password' => array(
               'required',
               'string',
               'min:6',
               'max:255',
               'confirmed'
              ),
            'password_confirmation' => array(
               'required',
               'string',
               'min:6',
               'max:255'
              ),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
         $Admin=Admin::where('id',$id)->first();
         if(Auth::user()->id==$Admin->id){
            $plain_text=$request['old_password'];
            $hashedPassword=Auth::user()->password;
            if(Hash::check($plain_text, $hashedPassword)){
                  $Admin->name = $request['name'];
                  $Admin->email = $request['email']; 
                  $hashNewPassword=$request['password'];
                  $Admin->password=Hash::make($hashNewPassword);
                  $Update=$Admin->update();
                  if($Update){
                    return redirect()->route('admin_setting.index')->with(['success'=>'Update successsfully.']);
                  }
                 else{
                    return redirect()->route('admin_setting.index')->with(['error'=>'Unable to password to update.']);
                 }
                  
            }
            else{
               return redirect()->route('admin_setting.index')->with(['error'=>'Unauthorise to password to update.']);
            }
            
         }
         else{
            return redirect()->route('admin_setting.index')->with(['error'=>'Unauthorise to update.']); 
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
        //
    }
}
