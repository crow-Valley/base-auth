<?php

namespace App\Services\User;

use App\Services\User\UserDomain;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;



/**
 *
 */
class UserServiceProvider extends UserDomain
{
  //
  public function login(Request $request): Array
  {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if(!$user = User::where('email',$request->email)->first()){
      throw new \Exception("User doesnt exists", 1);
    }
    if(!Hash::check($request->password, $user->password)){
      throw new \Exception("Credential Error", 2);
    }
    return [
      'user'  => $user,
      'token' => $user->createToken('accessToken')->plainTextToken
    ];


  }

  public function signup(Request $request) : Array
  {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
        'name' => 'required|string'
    ]);

    if(User::where('email',$request->email)->first())
      throw new \Exception("User already exists", 1);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);
    //
    return $this->login($request);
  }

  public function logout()
  {
    auth()->user()->tokens()->delete();
    return true;

  }

}
