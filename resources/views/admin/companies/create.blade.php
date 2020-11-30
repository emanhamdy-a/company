@extends('admin.index')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
    <div class="row mb-5">
      <div class="col-sm-6">
        <h3 class="m-0 text-secondary">
          @if($title) {{$title}} @endif
        </h3>
      </div><!-- /.col -->
      @if(session()->has('success'))
      <div class="alert alert-success col-12">
        <h4>{{ session('success') }}</h4>
      </div>
      @endif

      @if(session()->has('error'))
      <div class="alert alert-danger col-12">
        <h4>{{ session('error') }}</h4>
      </div>
      @endif
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <!-- form start -->
            <form method="post" action="/admin/companies"
              enctype="multipart/form-data" autocomplete="off" >
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="createCompanyName">Company name</label>
                  <input type="text" name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    id="createCompanyName"
                    placeholder="Enter company name" aria-invalid="false"
                    value="@if(old('name')) {{ old('name') }} @endif"/>
                    @error('name')
                      <span id="createCompanyName-error"
                        class="error invalid-feedback">
                        {{ $message }}
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="createCompanyWepsite">Company wepsite</label>
                  <input type="text" name="wepsite"
                   class="form-control @error('wepsite') is-invalid @enderror"
                   id="createCompanyWepsite"
                   placeholder="Enter company wepsite" aria-invalid="false"
                   value="@if(old('wepsite')) {{ old('wepsite') }} @endif"/>
                  @error('wepsite')
                    <span id="createCompanyWepsite-error"
                    class="error invalid-feedback">
                    {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createCompanyEmail">Company email</label>
                  <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="createCompanyEmail"
                   placeholder="Enter company email" aria-invalid="false"
                   value="@if(old('email')) {{ old('email') }} @endif"/>
                  @error('email')
                    <span id="createCompanyEmail-error"
                    class="error invalid-feedback">
                    {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createCompanyStatus">Company status</label>
                  <select name="status"
                    class="form-control @error('status') is-invalid @enderror"
                    id="createCompanyStatus" aria-invalid="false">
                    <option value="">Select company status</option>
                    <option value="1"
                      <?php if(old('status') && old('status') =='1'){
                      echo "selected"; } ?> >Enabled
                    </option>
                    <option value="0"
                      <?php if(old('status')==='0'){
                        echo "selected";} ?> >Disabled
                    </option>
                  </select>
                  @error('status')
                    <span id="createCompanyStatus-error"
                    class="error invalid-feedback">
                    {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createCompanylogo">Company logo</label>
                  <input type="file" name="logo"
                  class="form-control @error('logo') is-invalid @enderror"
                  id="createCompanylogo"
                  placeholder="Enter company logo" aria-invalid="false"/>
                  @error('logo')
                    <span id="createCompanylogo-error"
                    class="error invalid-feedback">
                    {{ $message }}
                    </span>
                  @enderror
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="/admin/companies" class="btn btn-secondary ml-4">
                  Cancel</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
          </div>
      </div>
    <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
