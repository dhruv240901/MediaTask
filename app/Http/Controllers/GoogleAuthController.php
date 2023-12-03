<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
  /* function to redirect to google login page */
  public function login()
  {
    return Socialite::driver('google')->redirect();
  }

  /* function to store user account if not exist and authenticate user */
  public function callback()
  {
    try {
      $user = Socialite::driver('google')->stateless()->user();

      // Check if user with requested mail id exist or not
      $checkUser = User::where('email', $user->email)->first();

      // If user not exist then store the data in the datatabase
      if ($checkUser == null) {
        $insertData = [
          'name'              => $user->name,
          'email'             => $user->email,
          'profile_image_url' => $user->avatar,
        ];

        $authUser = User::create($insertData);
      } else {
        $authUser = $checkUser;
      }

      // authenticate user using id
      Auth::LoginUsingId($authUser->id);
      return redirect('/');
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
