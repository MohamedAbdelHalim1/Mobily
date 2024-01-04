<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Authenticatable;

class AdminLoginController extends Controller
{
    //
use AuthenticatesUsers;

    public function admin_login(){

        return view('admin.auth.login');
    }
    public function check_login(Request $request){
        $request->validate([

            'email' => ['required' , 'email'],
            'password' => ['required' , 'string'],
        ]);

        $credentials = [

            'email' => $request->email,
            'password' => $request->password,
        ];
        //we will check and if true we will store in session of admin guard
   

        if(Auth::guard('admin')->attempt($credentials)){  //attempt will check and if true will store in session

            return redirect('/admin/home');
        }else{
            return redirect()
            ->back()->withInput(['email'=>$request->email])
            ->with('error','this credential does not match our records');
        }

    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
