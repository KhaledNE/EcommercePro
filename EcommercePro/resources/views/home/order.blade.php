<!DOCTYPE html>
<html>

<head>
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
    <link href="home/css/responsive.css" rel="stylesheet" />
    <style>
        .center {
            margin: auto;
            width: 100%;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>

<body>
    @include('home.header')
    <div class="center">   
       <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Title </th>
                    <th> Quantity </th>
                    <th> Price </th>
                    <th> Payment Status </th>
                    <th> Delivery Status </th>
                    <th> Image </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $data)
                <tr>
                    <td>{{ $data->product_title }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{ $data->price }}</td>
                    <td>{{ $data->payment_status }}</td>
                    <td>{{ $data->delivery_status }}</td>
                    <td style="width:200px">
                        <img src="/uplouds/products/{{ $data->image }}" alt="image">
                    </td>
                    <td>
                        @if ($data->delivery_status == 'processing')
                        <a href="{{ url('cancel_cart', $data->id) }}"
                            onclick="return confirm('Are You Sure to Cancel This')"
                            class="btn btn-outline-danger">Cancel</a>
                            @else
                            <p style="color: blue">Not Allowed</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </div>
        </table>
        <div>
        </div>
    </div> <!-- header section strats -->
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
