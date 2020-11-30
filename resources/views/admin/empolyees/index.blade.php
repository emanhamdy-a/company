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
        <a href="{{route('empolyees.create')}}" class='btn btn-info' >Create</a>
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
            <form action="/admin/empolyees"
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
              <th>First name</th>
              <th>Phone</th>
              <th>photo</th>
              <th class='text-center'>Company logo</th>
              <th class='text-center'>Actions</th>
            </tr>
          </thead>
          @if($empolyees)
          <tbody>
          @foreach($empolyees as $empolyee)
          <tr>
            <td>{{$empolyee->id}}</td>
            <td>{{Str::limit($empolyee->first_name,30)}}</td>
            <td>{{$empolyee->phone}}</a>
            </td>
            <td>
              <img
                src="{{url('/')}}/storage/@if($empolyee->photo){{$empolyee->photo->filename}}
                @endif" width='60' alt="">
            </td>
            <td class='text-center'>
              <img
                src="{{url('/')}}/storage/@if($empolyee->company->logo){{$empolyee->company->logo->filename}}
                @endif" width='60' alt="">
            </td>
            <td  class='text-center'>
              <div class="btn-group btn-group-sm">
                <a href="{{route('empolyees.show',$empolyee)}}" class="btn btn-light">
                  <i class="fas fa-eye text-info"></i>
                </a>
                <form
                 action="{{route('empolyees.destroy', $empolyee)}}" id="delete"
                 method=post>
                 @csrf
                 @method('DELETE')
                  <button type="submit"
                    class="btn btn-light">
                    <i class="fas fa-trash text-danger"></i>
                  </button>
                </form>
                <a href="{{route('empolyees.edit', $empolyee->id)}}"
                  class="btn btn-light">
                  <i class="fas fa-edit text-primary"></i>
                </a>
                @if($empolyee->status)
                  <a href="/admin/empolyees/disable/{{$empolyee->id}}"
                    class="btn btn-light border p-2">
                    Disable
                  </a>
                  @else
                  <a href="/admin/empolyees/enable/{{$empolyee->id}}"
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
        <tfoot>
        </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<!-- /.row -->
{{ $empolyees->links() }}
</div><!--/. container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
