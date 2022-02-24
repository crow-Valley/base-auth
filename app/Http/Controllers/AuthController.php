<?php

namespace App\Http\Controllers;

use App\Services\User\UserServiceProvider;
use Illuminate\Http\Request;



class AuthController extends Controller
{
  public function __construct()
  {
    $this->provider = new UserServiceProvider();
  }

  public function login(Request $request)
  {
    try {

      return $this->correct($this->provider->login($request));

    } catch (\Exception $e) {

      return $this->incorrect($e->getCode(),$e->getMessage());

    }

  }


    public function signup(Request $request)
    {
      try {

        return $this->correct($this->provider->signup($request));

      } catch (\Exception $e) {

        return $this->incorrect($e->getCode(),$e->getMessage());

      }
    }

    public function logout(Request $request)
    {
      try {

        return $this->correct($this->provider->logout());

      } catch (\Exception $e) {

        return $this->incorrect($e->getCode(),$e->getMessage());

      }
    }

    public function user()
    {
      return $this->correct(auth()->user());

    }
}
