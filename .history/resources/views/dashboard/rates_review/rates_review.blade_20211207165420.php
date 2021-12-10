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
                                <div class="col-12">
                                    <h3 class="card-title">All Stores</h3>
                                </div>

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
                                        <th>Store Category</th>
                                        <th>Average Rate</th>
                                        <th>Number of Rates</th>
                                        <th>Trending</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($stores as $key => $store)
                                    <tr>
                                        <td>{{ ++$key }}</td>

                                        <td><img src=" {{ asset('app_uploads/'.$store->icon) }} " width="100"
                                                height="100" alt="{{ $store->name }}_icon" /> </td>

                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->category->name }}</td>

                                        <td>{{ $store->rate->average('rate') ??0 }} ⭐</td>
                                        <td>{{ $store->rate->count('rate') }} 👤</td>
                                        <td>@if($store->is_trend ) ↖️ ↗️ increasing 
                                            @else ↘️ decreasing @endif</td>
                                        <td>
                                            <div class="row col-md-6">
                                                @if ($store->deleted_at == null)
                                                <div class="clo-6" style="background-color: green">
                                                    ACTIVE
                                                 </div>
                                                @else
                                                <div class="clo-6" style="background-color: red">
                                                    INACTIVE
                                                </div>
                                                @endif

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

                </div>
            </div>
        </div>
    </div>
</div>


@endsection