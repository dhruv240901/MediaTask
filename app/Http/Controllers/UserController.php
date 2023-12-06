<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\AjaxResponse;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
  use AjaxResponse,FileUpload;

  /* function to render users list table */
  public function index(Request $request)
  {
    $request->validate([
      'gender'      => 'nullable|string',
      'status'      => 'nullable|string',
      'limit'       => 'nullable|string',
      'search_text' => 'nullable|string'
    ]);

    $query = User::query();

    if ($request->gender != null) {
      $query->where('gender', $request->gender);
    }

    if ($request->status != null) {
      $query->where('is_active', $request->status);
    }

    if ($request->order != null) {
      $order = $request->order;
    } else {
      $order = 'ASC';
    }

    if ($request->limit != null) {
      $perPage = $request->limit;
    } else {
      $perPage = 10;
    }

    if ($request->search_text != null) {
      $query->where('name', 'Like', '%' . $request->search_text . '%')
        ->orWhere('email', 'Like', '%' . $request->search_text . '%')
        ->orWhere('phone', 'Like', '%' . $request->search_text . '%');
    }
    $users = $query->whereNot('id', auth()->id())->orderBy('name', $order)->paginate($perPage);

    if ($request->is_ajax == true) {
      return view('user.list', compact('users'));
    }
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
      $file = $request->file('profile_img');
      $filepath=$this->profileImageUpload($file,$user);
      $updateData['profile_image'] = $filepath;
    } else {
      if (!$request->has('profile_img_url')) {
        if (File::exists('user/' . $user->id . '/profile')) {
          // Delete the folder and its contents
          File::deleteDirectory('user/' . $user->id . '/profile');
        }
        $updateData['profile_image'] = null;
      }
    }

    $user->update($updateData);
    return redirect()->route('user-list')->with('success', 'User Updated Successfully');
  }

  public function updateStatus(Request $request)
  {
    // Validate Update User Status Request
    $request->validate([
      'checked' => 'required'
    ]);
    $user = User::findOrFail($request->id);

    // Inactivate user if user is Activated
    if ($request->checked == "false") {
      $user->update(['is_active' => false]);
      $message = "User Inactivated Successfully";
    }

    // Activate user if user is Inactivated
    if ($request->checked == "true") {
      $user->update(['is_active' => true]);
      $message = "User Activated Successfully";
    }

    $response = $this->success(200, $message);
    return $response;
  }
  /* function to delete user by id */
  public function destroy($id)
  {
    User::findOrFail($id)->delete();
    if (file_exists('user/' . $id)) {
      unlink('user/' . $id);
    }
    return redirect()->route('user-list')->with('success', 'user deleted successfully');
  }

  /* Render user profile page */
  public function profile()
  {
    return view('user.profile');
  }
}
