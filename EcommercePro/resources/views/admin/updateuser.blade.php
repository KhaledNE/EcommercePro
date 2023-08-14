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
                    <h1 class="card-title">Edit User</h1>
                    <form class="forms-sample" method="POST" action="{{url('/edit_user',$userid->id)}}">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputUsername1">User Name</label>
                        <input type="text" value="{{$userid->name}}" class="form-control" id="exampleInputUsername1" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" value="{{$userid->email}}" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password"class="form-control" id="exampleInputPassword1" placeholder="You can't see the password for security reasons, but you can edit it" minlength="9"name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" value="{{$userid->phone}}" class="form-control" id="exampleInputEmail1" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" value="{{$userid->address}}" class="form-control" id="exampleInputEmail1" placeholder="Address" name="address">
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="text" class="form-check-input"value="0"name="susertype" hidden>
                        <input type="checkbox" class="form-check-input" value="1" <?php if($userid->usertype == 1)echo"checked"?> name="susertype">DashBoard<i class="input-helper"></i></label>
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sproducts" hidden>
                          <input type="checkbox" class="form-check-input" value="1" <?php if($userid->products == 1)echo"checked"?> name="sproducts">Show Products<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="saddproduct" hidden>
                          <input type="checkbox" class="form-check-input" value="1" <?php if($userid->add_products == 1)echo"checked"?> name="saddproduct">Add Product<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="scategories" hidden>
                          <input type="checkbox" class="form-check-input" value="1" <?php if($userid->categories == 1)echo"checked"?> name="scategories">Categories<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sorders" hidden>
                          <input type="checkbox" class="form-check-input" value="1" <?php if($userid->orders == 1)echo"checked"?> name="sorders">Order<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary" style="margin-bottom: 15px;">
                        <label class="form-check-label">
                        <input type="text" class="form-check-input"value="0"name="susers" hidden>
                        <input type="checkbox" class="form-check-input" value="1" <?php if($userid->show_users == 1)echo"checked"?> name="susers">Show Users<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary" style="margin-bottom: 15px;">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sadduser" hidden>
                          <input type="checkbox" class="form-check-input"value="1" <?php if($userid->add_user == 1)echo"checked"?> name="sadduser">Add User<i class="input-helper"></i></label>
                      </div>
                      <div class="form-check form-check-flat form-check-primary" style="margin-bottom: 15px;">
                        <label class="form-check-label">
                          <input type="text" class="form-check-input"value="0"name="sliders" hidden>
                          <input type="checkbox" class="form-check-input"value="1" <?php if($userid->sliders == 1)echo"checked"?> name="sliders">Sliders<i class="input-helper"></i></label>
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