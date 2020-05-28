<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;


class AuthController extends Controller
{






  public function register(Request $request)
  {
        $this->validate($request,[
            'email' => 'required|email|max:190',
            'password' => 'required|string|min:5',
        ]);



        #check user exists or not
        if (User::where('email',$request->input('email'))->count()==1)
        {
            return response([
                'data'  => 'user exists',
                'status'    => 'error',
            ]);
        }


        $user = User::create([
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
            'level'     => 'user',
            'api_token' => str_random(100),
          ]);

        // Auth::login($user, true);

        return response([
            'data'  => $user,
            'status' => '200',
        ]);


  }




  public function login(Request $request)
    {

        $this->validate($request,[
            'email' => 'required|email|max:190|exists:users',
            'password' => 'required|string|min:5',
        ]);
        #validation inputs and check email exists or not



        $user = User::where('email',$request->input('email'))->first();
        if(! Hash::check($request->input('password'), $user->password))
        {
            return response([
                'data' => 'password is wrong',
                'status' => 'error'
            ]);
        }


        $user->update([
            'api_token' => str_random(100),
        ]);

        return response([
            'data' => $user,
            'status' => '200'
        ]);



    }


    public function user()
    {
        $user = Auth::user();
        return response([
            'data'  => $user,
            'status' => '200',
        ]);
    }





}
