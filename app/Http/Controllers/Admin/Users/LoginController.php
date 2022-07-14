<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $title = "Tao Lê";
        return view('admin.users.login',compact(['title']));
    }

    public function login(Request $request){
        $request ->validate([
            "email"=>"required|email:filter",
            "password"=>"required"
        ]);

        if (Auth::attempt(["email"=>$request->email,"password"=>$request->password],$request->remember)) {
            return redirect()->route('admin');
        }
      
        return redirect()->back()->with('error','user name or email not exists!');

    }
}
