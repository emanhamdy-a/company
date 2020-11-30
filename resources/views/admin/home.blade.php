@extends('admin.index')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@if($title) {{$title}} @endif</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1">
               <i class="fa fa-user-circle"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Latest Empolyees</span>
                  <span class="info-box-number">
                  </span>
                </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
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
              <!-- /.card-header -->
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1">
               <i class="fa fa-truck"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Latest Compnies</span>
                <span class="info-box-number">
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
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
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
