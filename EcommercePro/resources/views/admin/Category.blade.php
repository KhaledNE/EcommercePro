<!DOCTYPE html>
<html lang="en">
  <head>
    <style>
        .div-center{
            text-align:center;
            padding-top: 40px;

        }
        .h2_font{
            font-size:40px;
            padding-bottom:40px;
        }
        .input_color{
            color: black;
        }
        .table-center{
            width:50%;
            margin:auto;
            margin-top:30px;
            text-align: center;
            border:3px solid;
        }
    </style>
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
    {{-- Create --}}
    <div class="content-wrapper">
        @if(session()->has('message'))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
          </div>
        @endif
        <div class="div-center">
        <h2 class="h2_font">Add Category</h2>
        <form action="{{url('add_category')}}" method="Post">
            @csrf
            <input type="text" class="input_color" name="category" placeholder="Write Category name">
            <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
        </form>
    {{-- Create --}}
    {{-- Table --}}
        <div class="table-center">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $cate)
                  <tr>
                    <td>{{$cate->category_name}}</td>
                    <td><a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-outline-danger" href="{{url('delete_category',$cate->id)}}">Delete</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
    {{-- Table --}}
</div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

@include('admin.script')
  </body>
</html>
