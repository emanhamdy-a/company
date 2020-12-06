<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class CompanyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $companies=Company::orderBy('id','ASC')->paginate(10);
    return view('admin.companies.index',[
      'companies'=> $companies, 'title'=>'Companies'
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.companies.create',[
      'title'=>'Create Company'
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
      'name' => 'required|min:8|max:100',
      'wepsite' => 'required|url|max:150',
      'email' => 'required|email|max:150',
      'status' => 'required|integer|in:0,1',
      'logo'=>'required|image|mimes:jpg,jpeg,png,gif,bmp|dimensions:min_width=100,min_height=100'
    ]);

    if($company=Company::create($data)){
      if($imageFile = $request->file('logo')) {
      $filePath=Storage::disk('public')->putFile('images', $imageFile);
      Photo::create([
        'filename' => $filePath,
        'photoable_id' => $company->id,
        'photoable_type' => 'App\Models\Company',
      ]);
      }
      session()->flash('success', 'Company created successfully .');
    }else{
      session()->flash('error', 'Some thing wont worng !');
    }
    return redirect('admin/companies/create');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function show(Company $company)
  {
    return view('admin.companies.show',['title'=>'company Details','company'=>$company]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */

  public function edit(Company $company)
  {
    return view('admin.companies.edit',[
      'company'=> $company, 'title'=>'Edit Company'
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Company $company)
  {
    $data=$request->validate([
      'name' => 'required|min:8|max:100',
      'wepsite' => 'required|url|max:150',
      'email' => 'required|email|max:150',
      'status' => 'required|integer|in:0,1',
      'logo'=>'image|mimes:jpg,jpeg,png,gif,bmp|dimensions:min_width=100,min_height=100'
    ]);

    $company = Company::findOrFail($company->id);

    if($company->update($data)){
      if($imageFile = $request->file('logo'))
      {
        if($filePath=Storage::disk('public')->putFile('images', $imageFile))
        {
          unlink('storage/'.$company->logo->filename);
          $logo = $company->logo;
          $logo->filename =$filePath;
          $logo->save();
        }
      }
    session()->flash('success', 'Company updated successfully .');
    }else{
    session()->flash('error', 'Some thing wont worng !');
    }
    return redirect(route('companies.edit', $company->id));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function destroy(Company $company)
  {
    $logo=$company->logo;
    $logo_path=$company->logo->filename;
    if($company->delete()){
      if($logo->delete()){
        unlink('storage/'.$logo_path);
      }
    }
    session()->flash('success', 'Company deleted successfully .');
    return redirect()->back();
  }
  public function search(Request $request)
  {

    $companies= Company::where('name', 'LIKE', '%'.$request->search.'%')
    ->where('status','LIKE',$request->status)
    ->orderBy('id','asc')
    ->paginate(10);

    $title='Companies';

    if(request()->ajax()) {
      return view('admin.companies.index',compact('companies','title'))->renderSections()['content'];
    }
    return view('admin.companies.index',[
      'companies'=> $companies, 'title'=>$title
    ]);
  }
  public function enable($id)
  {
    $company = Company::findOrFail($id);
    $company->status='1';
    $company->save();
    if(request()->ajax()) {
      return response()->json(['status' => true,
        'html'=> '<a href="/admin/companies/disable/' . $company->id . '"
        class="btn btn-light border p-2 deactivated"
        id="activated' . $company->id . '">
        Disable
        </a>'
      ]);
    }
    session()->flash('success', 'Company Activated successfully .');
    return redirect()->back();
  }

  public function disable($id)
  {
    $company = Company::findOrFail($id);
    $company->status='0';
    $company->save();
    if(request()->ajax()) {
      return response()->json(['status' => true,
        'html'=> '<a href="/admin/companies/enable/' . $company->id . '"
        class="btn btn-secondary border p-2 activated"
        id="deactivated' . $company->id . '">
        Enable
        </a>'
      ]);
    }
    session()->flash('success', 'Company Deactivated successfully .');
    return redirect()->back();
  }
}
