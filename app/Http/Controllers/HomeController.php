<?php

namespace App\Http\Controllers;
use App\Models\Empolyee;
use App\Models\Company;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $empolyees=Empolyee::orderBy('id','DESC')->limit(10)->get();
    $companies=Company::orderBy('id','DESC')->limit(10)->get();
    return view('admin.home',[
      'empolyees'=> $empolyees,
      'companies'=> $companies,
      'title'=>'Newest'
    ]);
  }
}
