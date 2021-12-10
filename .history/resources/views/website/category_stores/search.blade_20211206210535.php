@extends('website.layouts.main')


@section('content')

<div class="featureds__item__text">
  <h5>All Stores</h5>
</div>

<div class="row">

  @if (session()->has('status'))

  <div class="col-12">
    <div class="alert alert-warning">{{ session('status') }}</div>
  </div>

  @endif

</div>

<div class="row featureds__filter" id="MixItUpD9A4B2">

  @if (sizeof($stores)>0)

  @foreach ($stores as $store)
  {{-- $current_store= $store; --}}

  <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
    <div class="featureds__item">
      <div class="featureds__item__pic set-bg" data-setbg="{{asset('app_uploads/'.$store->icon)}}"
        style="background-image: url('{{asset('app_uploads/'.$store->icon)}}');">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$store->id}}">
          Rate it ⭐ </button>

      </div>
      <div class="featureds__item__text">
        <h5>Name : {{$store->name}}</h5>

        <h6>Email : {{$store->email}}</h6>
        <h6>Mobile : {{$store->mobile}}</h6>
        <h6>Address : {{$store->address}}</h6>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal{{$store->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="{{ URL('rate/add_Rate/'.$store->id) }}">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rate {{$store->name}} Store</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="rating-css">
              <div class="star-icon">
                <input type="radio" value="1" name="store_rating" checked id="{{$store->id}}1">
                <label for="{{$store->id}}1" class="fa fa-star"></label>
                <input type="radio" value="2" name="store_rating" id="{{$store->id}}2">
                <label for="{{$store->id}}2" class="fa fa-star"></label>
                <input type="radio" value="3" name="store_rating" id="{{$store->id}}3">
                <label for="{{$store->id}}3" class="fa fa-star"></label>
                <input type="radio" value="4" name="store_rating" id="{{$store->id}}4">
                <label for="{{$store->id}}4" class="fa fa-star"></label>
                <input type="radio" value="5" name="store_rating" id="{{$store->id}}5">
                <label for="{{$store->id}}5" class="fa fa-star"></label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Rate</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
  

  @else
  <div class="featureds__item__text">
    <h6>There is not any stores in this category ..</h6>
  </div>
  @endif
</div>
{{-- Pagination --}}
<div class="d-flex justify-content-center">
  {{
  $stores->appends(['search'=>request()->query('search')])->links("pagination::bootstrap-4")
  }}
</div>


@endsection