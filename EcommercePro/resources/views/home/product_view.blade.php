<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <div style="width: 90%">
                <form action="{{url('search_product')}}" method="GET">
                    @csrf
                    <input type="text" style="width: 100%" name="search" placeholder="Search for Something" style="width: 500px;">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>
        @if (session()->has('message'))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="row">
            @foreach ($product as $data)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">
                            <a href="{{ url('product_details', $data->id) }}" class="option1">
                                Prodcut Details
                            </a>
                            <form action="{{ url('add_cart', $data->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <input type="number" name="quantity" value="1" min="1"
                                        style="width:100px; height: 48px">

                                    </div>
                                    <div class="col-4">
                                        <input type="submit" name="" value="Add To Cart">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="img-box">
                        <img src="/uplouds/products/{{ $data->image }}" alt="">
                    </div>
                    <div class="">
                        <h5 style="max-height: 40px;overflow: hidden;text-overflow: ellipsis;margin-bottom: 5px;text-align: center;">
                            {{ $data->title }}
                        </h5>
                        @if ($data->discount_price)
                        <h1 style="color:red;display: inline-block; font-size: 35px;">
                            
                            ${{ $data->discount_price }}
                        </h1>
                        <h6 style="text-decoration: line-through; color:blue;display: inline-block;">

                            ${{ $data->price }}
                        </h6>
                        @else
                        <h6 style="color:blue;font-size: 35px; text-align: center;">
                            ${{ $data->price }}
                        </h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            {!! $product->appends(Request::all())->links() !!}
        </div>
    </section>
