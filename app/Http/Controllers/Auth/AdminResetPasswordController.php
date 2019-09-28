<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Password;
use Auth;


class AdminResetPasswordController extends Controller
{
     use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function broker(){
    	return Password::broker('admins');
    }

    protected function guard(){
    	return Auth::guard('admin');
    }

     public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.admin_reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
