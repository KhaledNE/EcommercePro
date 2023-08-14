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
                    <h1 class="card-title">Users</h1>
                    <div class="table-responsive">
                        <div style="margin: auto; padding-bottom:30px;">
                            <form action="{{ url('search_user') }}" method="get">
                                @csrf
                                <input type="text" class="form-control" name="search" id="exampleInputUsername1"
                                    placeholder="Search For Something" style="">
                                <input type="submit" value="Search" class="btn btn-outline-secondary"
                                    style="margin-top: 14px;">
                            </form>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Password </th>
                                    <th> Phone </th>
                                    <th> address </th>
                                    <th> Creted_at </th>
                                    <th> Updated_at </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_users as $data)
                                    <tr>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>You cannot see the password for security reasons</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->updated_at }}</td>
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ url('update_user', $data->id) }}">Edit</a>
                                            <br>
                                            <br>
                                            <a href="{{ url('delete_user', $data->id) }}"
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