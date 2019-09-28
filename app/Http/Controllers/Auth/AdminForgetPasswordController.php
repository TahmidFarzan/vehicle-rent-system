<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Password;

class AdminForgetPasswordController extends Controller
{
     use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     protected function broker(){
        return Password::broker('admins');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.admin_email');
    }
}
