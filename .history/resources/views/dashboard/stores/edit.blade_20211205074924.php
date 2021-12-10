@extends('dashboard.layouts.main')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Store</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Store</li>
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
                            <div class="alert alert-success">Store Operation : SUCCESS </div>
                        </div>
                        @else
                        <div class="col-12">
                            <div class="alert alert-danger">Store Operation : FAILED </div>
                        </div>
                        @endif
                        @endif

                    </div>

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Editing {{ $store->name }} Store :</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" enctype="multipart/form-data" action="{{ URL('dashboard/store/update/'. $store->id ) }}"
                            id="save-category-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Store Name :</label>
                                    <input type="text" class="form-control" name="name" value="{{ $store->name }}"
                                        id="name" placeholder="name">
                                </div>

                                <div class="form-group">
                                    <label for="address">Store Address :</label>
                                    <input type="text" class="form-control" name="address" value="{{ $store->address }}"
                                        id="address" placeholder="address">
                                </div>

                                <div class="form-group">
                                    <label for="mobile">Store Mobile :</label>
                                    <input type="number" class="form-control" name="mobile" value="{{ $store->mobile }}"
                                        id="mobile" placeholder="mobile">
                                </div>
                                <div class="form-group">
                                    <label for="email">Store Email :</label>
                                    <input type="email" class="form-control" name="email" value="{{ $store->email }}"
                                        id="email" placeholder="email">
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Gategory Name :</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                        @if ($category->id == $store->category_id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Store Icon :</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="icon" class="custom-file-input"
                                                id="exampleInputFile" >
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