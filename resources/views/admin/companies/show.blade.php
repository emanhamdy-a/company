@extends('admin.index')
@section('content')
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body">
        <div class="row">
          <!-- clearfix -->
          <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
            <h3 class="text-primary"><i class="fas fa-paint-brush"></i>
              @if($title) {{$title}} @endif
            </h3>
            <p class="text-muted"><img
             src="{{url('/')}}/storage/{{$company->logo->filename}}"
              width='300' class='pt-4' alt=""></p>
            <br>
            <div class="text-muted">
              <p class="text-md">Company name :
                <b class="d-block pt-2">{{$company->name}} .</b>
              </p>
              <p class="text-md">Company status :
                @if($company->status)
                  <b class="d-block pt-2 text-success">
                    Activaetd .
                  </b>
                  @else
                  <b class="d-block pt-2 text-danger">
                    Deactivated .
                  </b>
                  @endif
              </p>
              <p class="text-md">Company created at :
                <b class="d-block pt-2">
                  {{$company->created_at->diffForHumans()}}</b>
              </p>
              <p class="text-md">Company updated at :
                <b class="d-block pt-2">
                  {{$company->updated_at->diffForHumans()}} .</b>
              </p>
            </div>

            <h5 class="mt-5 text-muted">Contact at .</h5>
            <ul class="list-unstyled">
              <li>
                <a href="{{$company->email}}" class="btn-link text-secondary">
                  <i class="far fa-fw fa-envelope"></i> {{$company->email}}
                </a>
              </li>
              <li>
                <a href="{{$company->wepsite}}" class="btn-link text-secondary">
                  <i class="fas fa-link"></i> {{$company->wepsite}}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
@endsection
