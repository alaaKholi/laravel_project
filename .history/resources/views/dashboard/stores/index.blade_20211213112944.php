@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 ">
                    <div class="card ">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-8 ">
                                    <h3 class="card-title">All Stores</h3>
                                </div>
                                <div>
                                    <form action="{{ URL('dashboard/store/search')}}" method="GET">
                                        <div class="input-group">

                                            <div class="form-outline">
                                                <input type="text" name="search" id="form1" class="form-control"
                                                    value="{{ request()->query('search')}}" />
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                    </form>
                                </div>
                                {{-- <input class="form-control" id="myInput" type="text" placeholder="Search..">
                                --}}



                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Store Icon</th>
                                        <th>Store Name</th>
                                        <th>Store Address</th>
                                        <th>Store Mobile</th>
                                        <th>Store Email</th>
                                        <th>Store Category</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($stores->items() as $key => $store)
                                    <tr>
                                        <td>{{ ++$key }}</td>

                                        <td><img src=" {{ asset('app_uploads/'.$store->icon) }} " width="100"
                                                height="100" alt="{{ $store->name }}_icon" /> </td>

                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->address }}</td>
                                        <td>{{ $store->mobile }}</td>
                                        <td>{{ $store->email }}</td>
                                        <td>{{ $store->category->name ?? '' }}</td>

                                        <td>
                                            <div class="row">
                                                @if ($store->deleted_at == null)
                                                <div class="clo-6">
                                                    <a href="{{ URL('dashboard/store/edit/' . $store->id ) }}"
                                                        class="btn btn-success">EDIT</a>
                                                </div>
                                                @endif

                                                <div class="col-6">@if ($store->deleted_at == null)
                                                    <form action="{{ URL('dashboard/store/delete/' . $store->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">delete</button>
                                                    </form>
                                                    @else
                                                    <form action="{{ URL('dashboard/store/restore/' . $store->id) }}"
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

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-center">
                                {{ $stores->links("pagination::bootstrap-4") }}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
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
                </div>
            </div>
        </div>
    </div>
</div>


@endsection