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
                    <div class="card">
                        <div class="card-body">
                            <h1 class="card-title">Orders</h1>
                            <div style="margin: auto; padding-bottom:30px;">
                                <form action="{{ url('search') }}" method="get">
                                    @csrf
                                    <input type="text" class="form-control" name="search" id="exampleInputUsername1"
                                        placeholder="Search For Something">
                                    <input type="submit" value="Search" class="btn btn-outline-secondary"
                                        style="margin-top: 14px;">
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th> Delivered </th>
                                            <th> Delivery Status </th>
                                            <th> Send Email </th>
                                            <th> Name </th>
                                            <th> Email </th>
                                            <th> Address </th>
                                            <th> Phone </th>
                                            <th> Product_title </th>
                                            <th> Quantity </th>
                                            <th> Price </th>
                                            <th> Payment Status </th>
                                            <th> image </th>
                                            <th> Print PDF </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($order as $data)
                                            <tr>
                                                <td>
                                                    @if ($data->delivery_status == 'processing')
                                                        <a class="btn btn-outline-primary"
                                                            onclick="return confirm('Are You Sure this product is Delivered')"
                                                            href="{{ url('delivered', $data->id) }}">Delivered</a>
                                                    @else
                                                        Delivered
                                                    @endif
                                                </td>
                                                <td>{{ $data->delivery_status }}</td>
                                                <td><a href="{{ url('send_email', $data->id) }}"
                                                        class="btn btn-outline-info">Send Email</a></td>
                                                <td>{{ $data->name }}</td>
                                                <td>{{ $data->email }}</td>
                                                <td>{{ $data->address }}</td>
                                                <td>{{ $data->phone }}</td>
                                                <td>{{ $data->product_title }}</td>
                                                <td>{{ $data->quantity }}</td>
                                                <td>{{ $data->price }}</td>
                                                <td>{{ $data->payment_status }}</td>
                                                <td class="">
                                                    <img src="/uplouds/products/{{ $data->image }}" alt="image">
                                                </td>
                                                <td>
                                                    <a class="btn btn-outline-secondary"
                                                        href="{{ url('print_pdf', $data->id) }}">Print PDF</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="16">
                                                    No Data Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.script')
</body>

</html>
