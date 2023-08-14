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
            padding: 30px;
        }
        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    @include('sweetalert::alert')
    <!-- header section strats -->
    @include('home.header')
    <div class="" style="width: 100%">
        @if (session()->has('message'))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif
        <div class='center'>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Title </th>
                            <th> Quantity </th>
                            <th> Price </th>
                            <th> Image </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $totalprice = 0; ?>
                        @foreach ($cart as $data)
                        <tr>
                            <td>{{ $data->product_title }}</td>
                            <td>{{ $data->quantity }}</td>s
                            <td>{{ $data->price }}</td>
                            <td style="width:200px">
                                <img src="/uplouds/products/{{ $data->image }}" alt="image">
                            </td>
                            <td>
                                <a href="{{ url('remove_cart', $data->id) }}"onclick="confirmation(event)" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $totalprice = $totalprice + $data->price; ?>
                        @endforeach
                    </tbody>
                </div>
            </table>
            <div>
                <h1 style="font-size:20px; padding:40px;"> Total Price : ${{ $totalprice }} </h1>
            </div>
            <div>
                <h1 style="font-size: 25px; padding-bottom:15px">Proceed to Order</h1>
                <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
                <a href="{{ url('stripe', $totalprice) }}" class="btn btn-danger">Pay Using Card</a>
            </div>
        </div>
    </div>



    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© N.E  <a href="">Developed by developer Khaled Ibrahim</a><br>

            N.E <a href="https://themewagon.com/" target="_blank"></a>

        </p>
    </div>
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title: "Are you sure to Delete this product",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
    <script type="text/javascript">
        var maxLength = 10;
        var tdElements = document.querySelectorAll("td");
        for (var i = 0; i < tdElements.length; i++) {
            var td = tdElements[i];
            if (td.textContent.length > maxLength) {
                td.style.maxWidth = maxLength + "ch";
            }
        }

    </script>
</body>

</html>
