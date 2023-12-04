<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('user.table');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  /* Render user profile page */
  public function profile()
  {
    return view('user.profile');
  }

  /* Render edit profile page form */
  public function editProfile()
  {
    return view('user.editProfile');
  }

  /* Update edit profile page form details into the database */
  public function updateProfile(Request $request)
  {
    // Validate edit profile form
    $request->validate([
      'name'        => 'required|string',
      'phone'       => 'nullable|min:10|max:10',
      'gender'      => 'nullable|string',
      'profile_img' => 'nullable'
    ]);

    // Check if gender not selected then put gender null
    if ($request->gender == "null") {
      $gender = null;
    } else {
      $gender = $request->gender;
    }

    // Update Data into the database
    $updateData = [
      'name'        => $request->name,
      'phone'       => $request->phone,
      'gender'      => $gender,
    ];

    $user = User::findOrFail(auth()->id());

    // Check if user had upload file or not
    if ($request->hasfile('profile_img')) {
      $url =$user->profile_image;

      // Convert URL to file path
      $filePath = public_path(parse_url($url, PHP_URL_PATH));

      // Delete file if exist
      if (File::exists($filePath)) {
        unlink($filePath);
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
      $file->move('user/' . auth()->id(), $filename);

      // Create the thumbnail directory if it doesn't exist
      $thumbnailDirectory = 'user/' . auth()->id() . '/thumbnail/';
      if (!file_exists($thumbnailDirectory)) {
        mkdir($thumbnailDirectory, 0777, true);
      }

      // Save the thumbnail to the specified path
      $thumbnail->save('user/' . auth()->id() . '/thumbnail/' . $filename);
      $updateData['profile_image'] = asset('user/' . auth()->id() . '/' . $filename);
    }

    $user->update($updateData);
    return redirect()->route('user-profile')->with('success', 'Profile Updated Successfully');
  }
}
