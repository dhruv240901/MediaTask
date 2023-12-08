<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Traits\AjaxResponse;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use App\Traits\FilterTrait;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
  use FileUpload, AjaxResponse, FilterTrait;

  /* Render my videos mage */
  public function myVideos(Request $request)
  {
    $request->validate([
      'search_text' => 'nullable|string',
      'status'      => 'nullable|boolean',
    ]);

    $query = Video::query();

    if ($request->search_text != null) {
      $query->where('name', 'Like', '%' . $request->search_text . '%');
    }

    $request['per_page'] = 6;
    $query = $query->where('created_by', auth()->id());
    $videos = $this->Filter($query, $request);

    $otherUsers = User::whereNot('id', auth()->id())->get();

    if ($request->is_ajax == true) {
      return view('videos.list', compact('videos', 'otherUsers'));
    }
    return view('videos.table', compact('videos', 'otherUsers'));
  }

  /* function to render add and edit video form */
  public function addEdit($id = null)
  {
    $video = null;
    if ($id) {
      $video = Video::findOrFail($id);
    }
    return view('videos.addEdit', compact('video'));
  }

  /* function to store and update video in database */
  public function storeUpdate(Request $request, $id = null)
  {
    $request->validate([
      'name'      => 'required|string',
      'video'     => 'nullable|mimes:mp4,mov,ogg',
      'is_active' => 'nullable|boolean'
    ]);

    $video = Video::updateOrCreate([
      'id'  => $id,
    ], [
      'name'      => $request->name,
      'is_active' => $request->is_active ?? false
    ]);

    if ($request->hasFile('video')) {
      $file = $request->file('video');
      $file = $this->videoUpload($file, $video);
      $video->update(['file_url' => $file['url'], 'file_name' => $file['name']]);
    }

    return redirect()->route('my-videos')->with('success', 'Video Uploaded Successfully');
  }

  /* function to delete video */
  public function destroy($id)
  {
    Video::findOrFail($id)->delete();
    $this->deleteFile('user/' . auth()->id() . '/media/' . $id);
    return redirect()->route('my-videos')->with('success', 'Video deleted successfully');
  }

  /* function to share video */
  public function shareVideo(Request $request)
  {
    $request->validate([
      'videoId'        => 'required|string',
      'sharedUserList' => 'nullable|array',
    ]);

    $video = Video::findOrFail($request->videoId);
    if ($request->sharedUserList) {

      // Delete Old users of requested video from the database
      $video->users()->detach();

      // Add New Users of requested video in the database
      foreach ($request->sharedUserList as $key => $userId) {
        $video->users()->attach($request->sharedUserList[$key]);
      }
    } else {

      // Delete Old users of requested video from the database
      $video->users()->detach();
    }

    return redirect()->route('my-videos')->with('success', 'Video Shared successfully');
  }

  /* Render shared videos page */
  public function sharedVideos(Request $request)
  {
    $request->validate([
      'search_text'    => 'nullable|string',
      'status'         => 'nullable|boolean',
      'sharedUserList' => 'nullable|array'
    ]);

    $query = auth()->user()->videos()->where('is_active',true)->where(function ($query) use ($request) {
      if ($request->search_text != null) {
        $query->where('name', 'Like', '%' . $request->search_text . '%');
      }
      if ($request->sharedUserList != null) {
        $query->whereIn('created_by', $request->sharedUserList);
      }
    });
    $request['per_page'] = 6;
    $sharedVideos = $this->Filter($query, $request);

    $otherUsers = User::whereNot('id', auth()->id())->get();
    if ($request->is_ajax == true) {
      return view('videos.sharedVideosList', compact('sharedVideos', 'otherUsers'));
    }

    return view('videos.sharedVideos', compact('sharedVideos', 'otherUsers'));
  }
}
