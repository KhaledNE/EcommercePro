<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/public">
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
              @if(session()->has('message'))
              <div class="alert alert-success" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                  {{ session()->get('message') }}
                </div>
              @endif
                <div class="card-body">
                    <h1 class="card-title">Edit Slider</h1>
                    <form class="forms-sample" method="POST" action="{{url('/edit_slider',$slider->id)}}">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">Red Title</label>
                        <input type="text" value="{{$slider->redtitle}}" class="form-control" id="exampleInputUsername1" placeholder="Username" name="red">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Blue Title</label>
                        <input type="text" value="{{$slider->bluetitle}}" class="form-control" id="exampleInputUsername1" placeholder="Username" name="blue">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Description</label>
                        <textarea type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" name="desc">{{$slider->desc}}</textarea>
                    </div>                    
                      <input type="submit" class="btn btn-primary mr-2" value="Edit">
                      <input class="btn btn-dark" onclick="history.back()" value="Cancel">
                  </form>
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