<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  /* function to render login page */
  public function login()
  {
    return view('auth.login');
  }

  /* function to logout user */
  public function logout()
  {
    auth()->logout();
    return redirect()->route('login')->with('success','Logout Successfully');
  }
}
