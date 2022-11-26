@section('title',"$category_name | $section_name".' | creator-shop')
<main id="main" class="main-site left-sidebar">
  <style>
    .product-wish {
      position: absolute;
      top: 10%;
      left: 0;
      z-index: 99;
      right: 30px;
      text-align: right;
      padding-top: 0;
    }

    .product-wish .fa {
      color: #cbcbcb;
      font-size: 32px;

    }

    .product-wish .fa:hover {
      color: #ff7007;

    }

    .fill-heart {
      color: #ff7007 !important;
    }
  </style>
  <div class="container">
    <div class="wrap-breadcrumb">
      <ul>
        <li class="item-link"><a href="{{url('shop')}}" class="link">home</a></li>
        <li class="item-link"><a href="{{url('category/'.$section_name.'/all')}}">{{$section_name}}</a></li>
        <li class="item-link"><span>{{$category_name}}</span></li>
      </ul>
    </div>
    <div class="row">

      <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">



        <div class="wrap-shop-control">

          <h1 class="shop-title">{{$category_name}}</h1>

          <div class="wrap-right">

            <div class="sort-item orderby ">
              <select name="orderby" class="use-chosen" wire:model="sorting">
                <option value="menu_order" value="default" selected="selected">Default sorting</option>

                <option value="date">Sort by newness</option>
                <option value="price">Sort by price: low to high</option>
                <option value="price-desc">Sort by price: high to low</option>
              </select>
            </div>

            <div class="sort-item product-per-page" wire:model="pagesize">
              <select name="post-per-page" class="use-chosen">
                <option value="12" selected="selected">12 per page</option>
                <option value="16">16 per page</option>
                <option value="18">18 per page</option>
                <option value="21">21 per page</option>
                <option value="24">24 per page</option>
                <option value="30">30 per page</option>
                <option value="32">32 per page</option>
              </select>
            </div>

            <div class="change-display-mode">
              <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
              <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
            </div>

          </div>

        </div>
        <!--end wrap shop control-->

        <div class="row">

          <ul class="product-list grid-products equal-container">
            @php
            $witem = Cart::instance('wishlist')->content()->pluck('id');
            @endphp
            @foreach($products as $product)
            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
              <div class="product product-style-3 equal-elem ">
                <div class="product-thumnail">
                  <a href="{{route('product.details',['slug'=>$product->slug])}}" title="{{$product->product_name}}">
                    <figure><img src="{{ asset('storage/'. $product->product_image ) }}"
                        alt="{{$product->product_name}}" style="height: 200px"></figure>
                  </a>
                </div>
                <div class="product-info">
                  <a href="{{route('product.details',['slug'=>$product->slug])}}"
                    class="product-name"><span>{{$product->product_name}}</span></a>
                  <div class="wrap-price"><span class="product-price">${{$product->sale_price}}</span></div>
                  <a href="#" class="btn add-to-cart"
                    wire:click.prevent="store({{$product->id}},'{{$product->product_name}}',{{$product->sale_price}})">Add
                    To Cart</a>
                  <div class="product-wish">
                    @if($witem->contains($product->id))
                    <a href="#" wire:click.prevent="removeFromWishlist({{$product->id}})"><i
                        class="fa fa-heart fill-heart"></i></a>
                    @else
                    <a href="#"><i class="fa fa-heart"
                        wire:click.prevent="addToWishlist({{$product->id}},'{{$product->product_name}}',{{$product->sale_price}})"></i></a>
                    @endif
                  </div>
                </div>
              </div>
            </li>
            @endforeach



          </ul>

        </div>

        <div class="wrap-pagination-info rounded-l-md ">
          {{$products->links()}}
          <!-- <ul class="page-numbers">
          <li><span class="page-number-item current" >1</span></li>
          <li><a class="page-number-item" href="#" >2</a></li>
          <li><a class="page-number-item" href="#" >3</a></li>
          <li><a class="page-number-item next-link" href="#" >Next</a></li>
        </ul>
        <p class="result-count">Showing 1-8 of 12 result</p> -->
        </div>
      </div>
      <!--end main products area-->
      @include('livewire.sidebar')

    
      <!--end sitebar-->

    </div>
    <!--end row-->

  </div>
  <!--end container-->
  @livewireScripts
</main>

<script>
  var slider = document.getElementById('slider')
  noUiSlider.create(slider,{
    start: [1,1000],
    connect: true,
    range:{
      min: 1,
      max: 1000
    },
    pips:{
      mode:'steps',
      stepped: true,
      density: 4
    }
  })
</script>