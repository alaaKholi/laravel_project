@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">

                        @if (session()->has('status'))
                        @if (session('status'))
                        <div class="col-12">
                            <div class="alert  
                            @if(session('type')== 'Restore') alert-info
                            @else alert-warning  @endif">{{ session('type') }} Category
                                Operation Status : SUCCESS
                            </div>
                        </div>
                        @else
                        <div class="col-12">
                            <div class="alert alert-danger">{{ session('type') }} Category Operation Status : FAILED
                            </div>
                        </div>
                        @endif
                        @endif

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Icon</th>
                                        <th>Category Name</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ ++$key }}</td>

                                        <td>@if ($category->icon != null)
                                            <img src=" {{ asset('app_uploads/'.$category->icon) }} " width="100"
                                                height="100" alt="{{ $category->name }}_icon" /> @endif
                                        </td>

                                        <td>{{ $category->name }}</td>

                                        <td>
                                            <div class="row">
                                                @if ($category->deleted_at == null)
                                                <div class="clo-6">
                                                    <a href="{{ URL('dashboard/category/edit/' . $category->id ) }}"
                                                        class="btn btn-success">EDIT</a>
                                                </div>
                                                @endif

                                                <div class="col-6">@if ($category->deleted_at == null)
                                                    <form
                                                        action="{{ URL('dashboard/category/delete/' . $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">delete</button>
                                                    </form>
                                                    @else
                                                    <form
                                                        action="{{ URL('dashboard/category/restore/' . $category->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info">restore</button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>


@endsection