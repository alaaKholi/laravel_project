<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('website_assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('website_assets/css/style.css')}}" type="text/css">
</head>

<body>


    @include('website.includes.header')

    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            @foreach (App\Models\Category::all() as $category)
                            <li><a href="{{ URL('category/'.$category->id)}}"><span><img
                                            src="{{asset('app_uploads/'.$category->icon)}}" alt="" width="20"
                                            height="20"></span>{{' '.$category->name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ URL('search') }}" method="GET">

                                <input type="text" name="search"placeholder="search for a store" value="{{ request()->query('search')}}" >
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    @yield('content')

                </div>
            </div>
        </div>
    </section>



    @include('website.includes.footer')

    <!-- Js Plugins -->
    <script src="{{asset('website_assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('website_assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('website_assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('website_assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('website_assets/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('website_assets/js/mixitup.min.js')}}"></script>
    <script src="{{asset('website_assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('website_assets/js/main.js')}}"></script>



</body>

</html>