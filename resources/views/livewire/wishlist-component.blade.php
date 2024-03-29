<main>
<style>
  .product-wish{
    position: absolute;
    top: 10%;
    left: 0;
    z-index: 99;
    right: 30px;
    text-align: right;
    padding-top: 0;
  }
  .product-wish .fa{
    color: #cbcbcb;
    font-size: 32px;

  }
  .product-wish .fa:hover{
    color: #ff7007;
    
  }
  .fill-heart{
    color: #ff7007 !important;
  }
</style>
    <div class="container" style="padding: 30px 0;">
        <div class="wrap-breadcrumb">
            <ul>
              <li class="item-link"><a href="/" class="link">home</a></li>
              <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>

        <div class="row">
            @if(Cart::instance('wishlist')->content()->count() > 0)
        <ul class="product-list grid-products equal-container">
          
          @foreach(Cart::instance('wishlist')->content() as $item)
          <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
            <div class="product product-style-3 equal-elem ">
              <div class="product-thumnail">
                <a href="{{route('product.details',['slug'=>$item->model->slug])}}" title="{{$item->model->product_name}}">
                  <figure><img src="{{ asset('storage/'. $item->model->product_image ) }}" alt="{{$item->model->product_name}}"></figure>
                </a>
              </div>
              <div class="product-info">
                <a href="{{route('product.details',['slug'=>$item->model->slug])}}" class="product-name"><span>{{$item->model->product_name}}</span></a>
                <div class="wrap-price"><span class="product-price">${{$item->model->sale_price}}</span></div>
                <a href="#" class="btn add-to-cart" wire:click.prevent="moveToCart('{{$item->rowId}}')">Move To Cart</a>
                <div class="product-wish">
                    <a href="#" wire:click.prevent="removeFromWishlist({{$item->model->id}})" ><i class="fa fa-heart fill-heart"></i></a>
                 
                </div>
              </div>
            </div>
          </li>
          @endforeach
         
  

        </ul>
        @else
            <h1>No Item In The Wishlist</h1>
        @endif
      </div>
    </div>
</main>
