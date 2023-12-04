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

     /* Render shared videos mage */
    public function sharedVideos()
    {
        return view('videos.sharedVideos');
    }
}
