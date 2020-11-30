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
      <div class="col-sm-6 text-right">
        <a href="{{route('companies.create')}}" class='btn btn-info' >Create</a>
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
      <div class="col-12">
      <div class="card col-12">
        <div class="card-header col-12">
        <div class="card-tools col-12">
            <form action="/admin/companies"
              method='post' class='row col-12'>
              @csrf
              @method('PUT')
              <div class="col-md-4 col-sm-12 ">
              </div>
              <div class="col-md-4 col-sm-12 ">
                <div class="form-group">
                  <select class="form-control" name='status'>
                    <option value=''>Status</option>
                    <option value='1'>Enabled</option>
                    <option value='0'>Disabled</option>
                  </select>
                </div>
              </div>
              <div class="input-group-append col-md-4 col-sm-12">
                <input type="text" name="search"
                  class="form-control float-right" placeholder="Search">
                <button type="submit" class="btn btn-default mb-4">
                   <i class="fas fa-search"></i>
                </button>
              </div>
            </form>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Wepsite</th>
              <th>Logo</th>
              <th class='text-center'>Actions</th>
            </tr>
          </thead>
            @if($companies)
            <tbody>
              @foreach($companies as $company)
              <tr>
                <td>{{$company->id}}</td>
                <td>{{Str::limit($company->name,30)}}</td>
                <td><a href="{{$company->wepsite}}">
                  {{Str::limit($company->wepsite,30)}}</a>
                </td>
                <td>
                  <img
                    src="{{url('/')}}/storage/@if($company->logo){{$company->logo->filename}}
                    @endif" width='60' alt="">
                </td>
                <td  class='text-center'>
                  <div class="btn-group btn-group-sm">
                    <a href="{{route('companies.show',$company)}}" class="btn btn-light">
                      <i class="fas fa-eye text-info"></i>
                    </a>
                    <form
                    action="{{route('companies.destroy', $company)}}" id="delete"
                    method=post>
                    @csrf
                    @method('DELETE')
                      <button type="submit"
                        class="btn btn-light">
                        <i class="fas fa-trash text-danger"></i>
                      </button>
                    </form>
                    <a href="{{route('companies.edit', $company->id)}}"
                      class="btn btn-light">
                      <i class="fas fa-edit text-primary"></i>
                    </a>
                    @if($company->status)
                      <a href="/admin/companies/disable/{{$company->id}}"
                        class="btn btn-light border p-2">
                        Disable
                      </a>
                      @else
                      <a href="/admin/companies/enable/{{$company->id}}"
                        class="btn btn-secondary border p-2">
                        Enable
                      </a>
                    @endif
                  </div>
                </td>
                <!-- <td>>diffForHumans()</td> -->
              </tr>
              @endforeach
            </tbody>
            @else
              <tbody>
                <tr>
                  there is no recordes .
                </tr>
              </tbody>
            @endif
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<!-- /.row -->
{{ $companies->links() }}
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
