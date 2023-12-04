<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
  /* function to render users list table */
  public function index()
  {
    $users = User::whereNot('id', auth()->id())->orderBy('name')->paginate(10);
    return view('user.table', compact('users'));
  }

  /* function to render edit user form */
  public function edit($id)
  {
    $user = User::findOrFail($id);
    return view('user.edit', compact('user'));
  }

  /* function to update user details in database */
  public function update(Request $request, $id)
  {
    // Validate edit user form
    $request->validate([
      'name'        => 'required|string',
      'phone'       => 'nullable|min:10|max:10',
      'gender'      => 'nullable|string',
      'profile_img' => 'nullable|image'
    ]);

    // Update Data into the database
    $updateData = [
      'name'        => $request->name,
      'phone'       => $request->phone,
      'gender'      => $request->gender,
    ];

    $user = User::findOrFail($id);

    // Check if user had upload file or not
    if ($request->hasfile('profile_img')) {
      if ($user->profile_image != null) {
        $url = $user->profile_image;

        // Convert URL to file path
        $filePath = public_path(parse_url($url, PHP_URL_PATH));

        // Delete file if exist
        if (File::exists($filePath)) {
          unlink($filePath);
        }
      }
      $file = $request->file('profile_img');

      // Create thumbnail of image
      $thumbnail = Image::make($file)->resize(200, 200, function ($constraint) {
        $constraint->aspectRatio();
      });

      $name = $file->getClientOriginalName();
      $filename = pathinfo($name, PATHINFO_FILENAME);
      $extension = pathinfo($name, PATHINFO_EXTENSION);
      $date = date('dmYhisa', time());
      $filename = ($date . '_' . $filename . '.' . $extension);

      // Move the original file to the user's directory
      $file->move('user/' . $user->id, $filename);

      // Create the thumbnail directory if it doesn't exist
      $thumbnailDirectory = 'user/' . $user->id . '/thumbnail/';
      if (!file_exists($thumbnailDirectory)) {
        mkdir($thumbnailDirectory, 0777, true);
      }

      // Save the thumbnail to the specified path
      $thumbnail->save('user/' . $user->id . '/thumbnail/' . $filename);
      $updateData['profile_image'] = asset('user/' . $user->id . '/' . $filename);
    } else {
      if (!$request->has('profile_img_url')) {
        $url = $user->profile_image;

        // Convert URL to file path
        $filePath = public_path(parse_url($url, PHP_URL_PATH));

        // Delete file if exist
        if (File::exists($filePath)) {
          unlink($filePath);
        }
        $updateData['profile_image'] = null;
      }
    }

    $user->update($updateData);
    return redirect()->route('user-list')->with('success', 'User Updated Successfully');
  }

  /* function to delete user by id */
  public function destroy($id)
  {
    User::findOrFail($id)->delete();
    if (file_exists('user/'.$id)) {
      unlink('user/'.$id);
    }
    return redirect()->route('user-list')->with('success', 'user deleted successfully');
  }

  public function searchUser(Request $request)
  {
    $query=User::query();
    if($request->gender!=null){
      $query->where('gender',$request->gender);
    }
    if($request->status!=null){
      $query->where('is_active',$request->status);
    }
    if($request->limit!=null){
      $perPage=$request->limit;
    }
    if($request->search_text!=null){
      $query->where('name','Like','%'.$request->search_text.'%')->orWhere('email','Like','%'.$request->search_text.'%')->orWhere('phone','Like','%'.$request->search_text.'%');
    }

    $users=$query->whereNot('id',auth()->id())->paginate($perPage);
    return view('user.list',compact('users'));
  }
  /* Render user profile page */
  public function profile()
  {
    return view('user.profile');
  }

}
