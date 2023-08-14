<style>/* تغيير لون الخلفية والحدود للترقيم */
.pagination {
  background-color: #f0f0f0;
  border: 1px solid #ddd;
}

/* تغيير لون الخط والخلفية والحدود للأرقام */
.page-link {
  color: #333;
  background-color: #fff;
  border: 1px solid #ddd;
}

/* تغيير لون الخط والخلفية والحدود للرقم الحالي */
.page-item.active .page-link {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

/* تغيير لون الخط والخلفية والحدود للأرقام عند التحويم */
.page-link:hover {
  color: #007bff;
  background-color: #e9ecef;
  border-color: #ddd;
}

/* تغيير حجم الخط والهوامش للترقيم */
.page-link {
  font-size: 18px;
  margin: 5px;
}

/* إزالة الزوايا المستديرة من الترقيم */
.page-item:first-child .page-link,
.page-item:last-child .page-link {
  border-radius: 0;
}
.background{
    background: #CAC9C7;
}
</style>
<div class="background">
    <div class="container">


        <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>
                        Our <span>products</span>
                    </h2>
                    <br>
                    <div style="width: 90%">
                        <form action="{{url('product_search')}}" method="GET">
                            <input type="text" name="search" placeholder="Search for Something" style="width:100%;">
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
            </div>
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
                {!! $product->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </section>
    </div>
</div>

