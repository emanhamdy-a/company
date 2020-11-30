@extends('admin.index')
@section('content')
<div class="content-wrapper">
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
            <div class="row col-12">

              <p class="text-muted col-6"><img
                src="{{url('/')}}/storage/{{$empolyee->photo->filename}}"
                width='300' class='pt-4' alt="">
              </p>
              <br>
              <p class="text-muted col-6"><img
                src="{{url('/')}}/storage/@if($empolyee->company->logo){{$empolyee->company->logo->filename}}
                  @endif"
                width='300' class='pt-4' alt="">
              </p>
              <br>
            </div>
            <div class="text-muted">
              <p class="text-md">First name :
                <b class="d-block pt-2">{{$empolyee->first_name}} .</b>
              </p>
              <p class="text-md">Last name :
                <b class="d-block pt-2">{{$empolyee->first_name}} .</b>
              </p>
              <p class="text-md">empolyee status :
                @if($empolyee->status)
                  <b class="d-block pt-2 text-success">
                    Activaetd .
                  </b>
                  @else
                  <b class="d-block pt-2 text-danger">
                    Deactivated .
                  </b>
                  @endif
              </p>
              <p class="text-md">empolyee created at :
                <b class="d-block pt-2">
                  {{$empolyee->created_at->diffForHumans()}}</b>
              </p>
              <p class="text-md">empolyee updated at :
                <b class="d-block pt-2">
                  {{$empolyee->updated_at->diffForHumans()}} .</b>
              </p>
            </div>

            <h5 class="mt-5 text-muted">Contact at .</h5>
            <ul class="list-unstyled">
              <li>
                <a href="{{$empolyee->email}}" class="btn-link text-secondary">
                  <i class="far fa-fw fa-envelope"></i> {{$empolyee->email}}
                </a>
              </li>
              <li>
                <a
                  class="btn-link text-secondary">
                  <i class="fas fa-phone"></i> {{$empolyee->phone}}
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
</div>
@endsection
