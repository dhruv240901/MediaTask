<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\File;
class VideoController extends Controller
{
  use FileUpload;

  /* Render my videos mage */
  public function myVideos()
  {
    $videos=Video::orderBy('name')->paginate(6);
    return view('videos.list',compact('videos'));
  }

  /* function to render add video form */
  public function create()
  {
    $video=null;
    return view('videos.addEdit',compact('video'));
  }

  /* function to store video in database */
  public function store(Request $request)
  {
    $request->validate([
      'name'  => 'required|string',
      'video' => 'required|mimes:mp4,mov,ogg'
    ]);

    $video = Video::create([
      'name'  => $request->name,
    ]);

    if ($request->hasFile('video')) {
      $file = $request->file('video');
      $file=$this->videoUpload($file,$video);
      $video->update(['file_url' => $file['url'],'file_name' => $file['name']]);
    }

    return redirect()->route('my-videos')->with('success','Video Uploaded Successfully');
  }

  /* function to render edit video from */
  public function edit($id)
  {
    $video=Video::findOrFail($id);
    return view('videos.addEdit',compact('video'));
  }

  /* function to update video in the database */
  public function update(Request $request,$id)
  {
    $request->validate([
      'name'  => 'required|string',
      'video' => 'required|mimes:mp4,mov,ogg'
    ]);

    $video = Video::findOrFail($id);
    $video->update(['name' => $request->name]);
    if ($request->hasFile('video')) {
      $file = $request->file('video');
      $file=$this->videoUpload($file,$video);
      $video->update(['file_url' => $file['url'],'file_name' => $file['name']]);
    }

    return redirect()->route('my-videos')->with('success','Video Updated Successfully');
  }

  public function destroy($id)
  {
    Video::findOrFail($id)->delete();
    if (File::exists('user/' . auth()->id() . '/media/' . $id)) {
      // Delete the folder and its contents
      File::deleteDirectory('user/' . auth()->id() . '/media/' . $id);
    }
    return redirect()->route('my-videos')->with('success', 'Video deleted successfully');
  }

  /* Render shared videos mage */
  public function sharedVideos()
  {
    return view('videos.sharedVideos');
  }
}
