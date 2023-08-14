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
                    <h1 class="card-title">Sliders</h1>
                    <div class="table-responsive">   
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Red Title </th>
                                    <th> Blue Title </th>
                                    <th> Description </th>
                                    <th> Creted_at </th>
                                    <th> Updated_at </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_sliders as $data)
                                    <tr>
                                        <td>{{ $data->redtitle }}</td>
                                        <td>{{ $data->bluetitle }}</td>
                                        <td style="word-wrap: break-word; white-space: normal"><p>{{ $data->desc }}</p></td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->updated_at }}</td>
                                        <td>
                                            <a class="btn btn-outline-success"
                                                href="{{ url('update_slider', $data->id) }}">Edit</a>
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