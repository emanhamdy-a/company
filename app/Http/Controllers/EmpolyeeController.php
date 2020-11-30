<?php

namespace App\Http\Controllers;

use App\Models\Empolyee;
use App\Models\Company;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class empolyeeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    $empolyees=Empolyee::orderBy('id','ASC')->paginate(10);
    return view('admin.empolyees.index',[
      'empolyees'=> $empolyees, 'title'=>'empolyees'
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $companies=Company::select('id','name')->get();
    return view('admin.empolyees.create',[
      'title'=>'Create empolyee',
      'companies'=>$companies
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data=$request->validate([
      'first_name' => 'required|min:8|max:50',
      'last_name' => 'required|min:8|max:50',
      'phone' => 'required|numeric',
      'email' => 'required|email|max:150',
      'company_id' => 'required|integer',
      'status' => 'required|integer|in:0,1',
      'photo'=>'required|image|mimes:jpg,jpeg,png,gif,bmp|dimensions:min_width=100,min_height=100'
    ]);

    if($empolyee=Empolyee::create($data)){
      if($imageFile = $request->file('photo')) {
      $filePath=Storage::disk('public')->putFile('images', $imageFile);
      Photo::create([
        'filename' => $filePath,
        'photoable_id' => $empolyee->id,
        'photoable_type' => 'App\Models\empolyee',
      ]);
      }
      session()->flash('success', 'empolyee created successfully .');
    }else{
      session()->flash('error', 'Some thing wont worng !');
    }
    return redirect('admin/empolyees/create');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\empolyee  $empolyee
   * @return \Illuminate\Http\Response
   */
  public function show(empolyee $empolyee)
  {
    return view('admin.empolyees.show',['title'=>'empolyee Details','empolyee'=>$empolyee]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\empolyee  $empolyee
   * @return \Illuminate\Http\Response
   */

  public function edit(empolyee $empolyee)
  {
    $companies=Company::select('id','name')->get();
    return view('admin.empolyees.edit',[
      'title'=>'Edit empolyee',
      'empolyee'=>$empolyee,
      'companies'=>$companies
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\empolyee  $empolyee
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, empolyee $empolyee)
  {
    $data=$request->validate([
      'first_name' => 'required|min:8|max:50',
      'last_name' => 'required|min:8|max:50',
      'phone' => 'required|numeric',
      'email' => 'required|email|max:150',
      'company_id' => 'required|integer',
      'status' => 'required|integer|in:0,1',
      'photo'=>'image|mimes:jpg,jpeg,png,gif,bmp|dimensions:min_width=100,min_height=100'
    ]);

    $empolyee = Empolyee::findOrFail($empolyee->id);

    if($empolyee->update($data)){
      if($imageFile = $request->file('photo'))
      {
        if($filePath=Storage::disk('public')->putFile('images', $imageFile))
        {
          unlink('storage/'.$empolyee->photo->filename);
          $photo = $empolyee->photo;
          $photo->filename =$filePath;
          $photo->save();
        }
      }
    session()->flash('success', 'empolyee updated successfully .');
    }else{
    session()->flash('error', 'Some thing wont worng !');
    }
    return redirect(route('empolyees.edit', $empolyee->id));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\empolyee  $empolyee
   * @return \Illuminate\Http\Response
   */
  public function destroy(empolyee $empolyee)
  {
    $photo=$empolyee->photo;
    $photo_path=$empolyee->photo->filename;
    if($empolyee->delete()){
      if($photo->delete()){
        unlink('storage/'.$photo_path);
      }
    }
    session()->flash('success', 'empolyee deleted successfully .');
    return redirect()->back();
  }
  public function search(Request $request)
  {
    if($request->search === null){
      $request->search='@#!TR%$BVAD09(';
    }
    $empolyees= Empolyee::where('first_name', 'LIKE', '%'.$request->search.'%')
    ->orwhere('status','=',$request->status)
    ->orderBy('id','asc')
    ->paginate(10);
    return view('admin.empolyees.index',[
      'empolyees'=> $empolyees, 'title'=>'empolyees'
    ]);
  }
  public function enable($id)
  {
    $empolyee = Empolyee::findOrFail($id);
    $empolyee->status='1';
    $empolyee->save();
    session()->flash('success', 'Empolyee Activated successfully .');
    return redirect()->back();
  }

  public function disable($id)
  {
    $empolyee = Empolyee::findOrFail($id);
    $empolyee->status='0';
    $empolyee->save();
    session()->flash('success', 'Empolyee dectivated successfully .');
    return redirect()->back();
  }
}
