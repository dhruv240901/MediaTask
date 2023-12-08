<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
  /* function to return home page*/
  public function index()
  {
    return view('dashboard');
  }
}
