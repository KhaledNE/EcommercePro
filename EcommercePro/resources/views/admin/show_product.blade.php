<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session()->has('message'))
                        <div class="alert alert-success" id="success-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Prodcuts</h1>
                            <div style="margin: auto; padding-bottom:30px;">
                                <form action="{{ url('search_product_admin') }}" method="get">
                                    @csrf
                                    <input type="text" class="form-control" name="search" id="exampleInputUsername1"
                                        placeholder="Search For Something" style="">
                                    <input type="submit" value="Search" class="btn btn-outline-secondary"
                                        style="margin-top: 14px;">
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Title </th>
                                            <th> Description </th>
                                            <th> Price </th>
                                            <th> Image </th>
                                            <th> Quantity </th>
                                            <th> Category </th>
                                            <th> Discount </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product as $data)
                                            <tr>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>{{ $data->price }}</td>
                                                <td class="">
                                                    <img src="/uplouds/products/{{ $data->image }}" alt="image">
                                                </td>
                                                <td>{{ $data->quantity }}</td>
                                                <td>{{ $data->category }}</td>
                                                <td>{{ $data->discount_price }}</td>
                                                <td>
                                                    <a class="btn btn-outline-success"
                                                        href="{{ url('update_product', $data->id) }}">Edit</a>
                                                    <br>
                                                    <br>
                                                    <a href="{{ url('delete_product', $data->id) }}"
                                                        onclick="return confirm('Are You Sure to Delete This')"
                                                        class="btn btn-outline-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    @include('admin.script')
</body>

</html>
