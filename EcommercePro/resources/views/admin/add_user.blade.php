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
                <div class="card-body">
                    <h1 class="card-title">Add User</h1>
                    <form class="forms-sample" method="POST" action="{{url('/adduser')}}">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">User Name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" minlength="9" required name="password">
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="text" class="form-check-input"value="0"name="susertype" hidden>
                        <input type="checkbox" class="form-check-input" value="1" name="susertype">DashBoard<i class="input-helper"></i></label>
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sproducts" hidden>
                          <input type="checkbox" class="form-check-input" value="1" name="sproducts">Show Products<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="saddproduct" hidden>
                          <input type="checkbox" class="form-check-input" value="1" name="saddproduct">Add Product<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="scategories" hidden>
                          <input type="checkbox" class="form-check-input" value="1" name="scategories">Categories<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sorders" hidden>
                          <input type="checkbox" class="form-check-input" value="1" name="sorders">Order<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary" style="margin-bottom: 15px;">
                        <label class="form-check-label">
                        <input type="text" class="form-check-input"value="0"name="susers" hidden>
                        <input type="checkbox" class="form-check-input" value="1" name="susers">Show Users<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary" style="margin-bottom: 15px;">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sadduser" hidden>
                          <input type="checkbox" class="form-check-input"value="1"name="sadduser">Add User<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary" style="margin-bottom: 15px;">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sliders" hidden>
                          <input type="checkbox" class="form-check-input"value="1"name="sliders">sliders<i class="input-helper"></i></label>
                      </div>
                      <input type="submit" class="btn btn-primary mr-2" value="Add">
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