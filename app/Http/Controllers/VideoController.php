<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function myVideos()
    {
        return view('videos.list');
    }

    public function sharedVideos()
    {
        return view('videos.sharedVideos');
    }
}
