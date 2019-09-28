<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
     public function __construct()
    {
         $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){

    	 return view('auth.admin_login');
    }


    public function AdminLogin(Request $request){

    	   $this->validate($request, [
              'email' => 'required|string',
               'password' => 'required|string|min:6',
           ]);

         if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)) {
             return redirect()->intended(route('admin.index'));
         }
         else{
               return redirect()->back()->withInput($request->only('email','remember'))->with(['error'=>'Email or Password is incorrect.']);
         }

      }

      // public function AdminLogout(){
     //	Auth::guard('admin')->logout();
    //	return redirect('/');
   // }
}
