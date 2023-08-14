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
                        <h1 class="card-title">Edit Product</h1>
                        <form class="forms-sample" action="{{url('/add_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="form-group">
                            <label for="exampleInputName1">Product Title</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="title" placeholder="Write Product Title" required="" value="{{$product->title}}">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail3">Product Description</label>
                            <input type="text" class="form-control" id="exampleInputEmail3" name="description" placeholder="Write Product Description" required=""value="{{$product->description}}">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword4">Product Price</label>
                            <input type="number" class="form-control" id="exampleInputPassword4" name="price" placeholder="Write Product Price" required="" value="{{$product->price}}">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword4">Product Quantity</label>
                            <input type="number" class="form-control" id="exampleInputPassword4" name="quantity" min="0" placeholder="Write Product Quantity" required="" value="{{$product->quantity}}">
                          </div>
                          <div class="form-group">
                            <label>File upload</label>
                            <br>
                            <input type="file" name="image" class="file-upload-default">
                            <img height="100" width="100" src="/uplouds/products/{{$product->image}}">
                            <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                            </div>
                          </div>
                                                    <div class="form-group">
                            <label for="exampleSelectGender">Product Category</label>
                            <select class="form-control" id="exampleSelectGender" name="category" required="">
                              <option value="{{$product->category}}" selected="">{{$product->category}}</option>
                              @foreach ($cate as $data)
                              <option value="{{$data->category_name}}">{{$data->category_name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword4">Discount Price</label>
                            <input type="number" class="form-control" id="exampleInputPassword4" name="dis_price" min="0" placeholder="Wirte Product Discount Price" value="{{$product->discount_price}}">
                          </div>
                          </div>
                          <button type="submit" class="mr-2 btn btn-primary">Edit Product</button>
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
