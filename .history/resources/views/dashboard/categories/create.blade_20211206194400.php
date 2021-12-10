@extends('dashboard.layouts.main')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Category</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row">

            @foreach ($errors->all() as $msg)
            <div class="col-12">
              <div class="alert alert-danger">{{ $msg }}</div>
            </div>
            @endforeach


            @if (session()->has('status'))
            @if (session('status'))
            <div class="col-12">
              <div class="alert alert-success">Category Addition : SUCCESS </div>
            </div>
            @else
            <div class="col-12">
              <div class="alert alert-danger">Category Addition : FAILED </div>
            </div>
            @endif
            @endif

          </div>
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Adding New Category :</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" enctype="multipart/form-data" action="{{ URL('dashboard/category/store') }}"
              id="save-category-form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Category Name :</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="category name">
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Category Icon :</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="icon" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col-md-6 -->

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection


<!-- jQuery -->
<script src="{{ asset('dashboard_assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('dashboard_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('dashboard_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dashboard_assets/dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
  bsCustomFileInput.init();
});
</script>