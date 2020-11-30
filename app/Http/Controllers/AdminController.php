<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
  public function index(){
    return view('admin.login');
  }

  public function login() {
    $credentials = request()->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);
    $rememberme = request()->rememberme ? true :false;
    if (Auth::attempt($credentials,$rememberme)) {
      return redirect('/admin');
    }else{
      return redirect('/admin/login');
    }
  }

  public function logout() {
    if(Auth::check()) {
      Auth::logout();
      return redirect('admin/login');
    }else {
      return redirect('/');
    }
  }
}
