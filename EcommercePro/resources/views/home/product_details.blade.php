<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />   
    <link href="{{asset('build/assets/app-972d3a07.css')}}" rel="stylesheet" />     
</head>

<body>
    @include('home.header')
    <!-- header section strats -->
    <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:100%; padding:30px">
        <div class="img-box" >
            <img src="/uplouds/products/{{ $product->image }}" alt="">
        </div>
        <br>
        <div class="detail-box">
            <h5 style="margin-bottom:10px ">
                {{ $product->title }}
            </h5>
            @if ($product->discount_price)
                <h6 style="color:red;margin-bottom:10px;font-family: Arial;">
                    The Offer : ${{ $product->discount_price }}
                </h6>

                <h6 style="margin-bottom:10px;text-decoration: line-through; color:blue;font-family: Arial;">
                    Price : ${{ $product->price }}
                </h6>
            @else
                <h6 style="margin-bottom:10px;font-family: Arial; color: blue;">
                     Price : ${{ $product->price }}
                </h6>
            @endif
            <h6 style="margin-bottom:10px; font-family: Arial;">Product Category : {{ $product->category }}</h6>

           Product Description :  <h6 style="font-family: Arial;">{{ $product->description }}</h6>
            <br>
            <form action="{{ url('add_cart', $product->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <input type="number" name="quantity" value="1" min="1"
                            style="width:100px; height: 48px">

                    </div>
                    <div class="col-4">
                        <input type="submit" name="" value="Add To Cart">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© N.E  <a href="">Developed by developer Khaled Ibrahim</a><br>

            N.E <a href="https://themewagon.com/" target="_blank"></a>

        </p>
    </div>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script> 
    <script src="{{asset('build/assets/app-ab9fb1ca.js')}}"></script>
</body>

</html>
