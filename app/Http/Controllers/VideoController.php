<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    /* Render my videos mage */
    public function myVideos()
    {
        return view('videos.list');
    }
    /* function to render add video form */
    public function create()
    {
        return view('videos.addEdit');
    }

    /* function to store video in database */
    public function store(Request $request)
    {
        dd($request->all());
    }

     /* Render shared videos mage */
    public function sharedVideos()
    {
        return view('videos.sharedVideos');
    }
}
