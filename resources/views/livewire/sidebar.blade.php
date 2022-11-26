<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
    <div class="widget mercado-widget categories-widget">
      
      <h2 class="widget-title">categories</h2>
      <div class="widget-content">
        <ul class="list-category">
       
          
          @foreach ($categories as $section)
          <li class="category-item">
            <h5 style="font-weight: bold">{{ $section['name'] }}</h5>
          </li>
          @foreach ($section['categories'] as $category)
          <li class="category-item">
            <a href="{{url('category/'.$section['name'].'/'.$category['slug'])}}"><span class="pl-2">{{ $category['cate_name']}}</span></a>
          </li>
          {{-- @foreach ($category['subcategories'] as $subcategory)
          <li class="category-item">
            <a href="{{url('category/'.$section['name'].'/'.$subcategory['slug'])}}"><span class="pl-4">{{ $subcategory['cate_name']}}</span></a>
          </li>
          @endforeach --}}
          @endforeach
          @endforeach
         
        </ul>
      </div>
    </div>
    <div class="widget mercado-widget filter-widget brand-widget">
      <h2 class="widget-title">Brand</h2>
      <div class="widget-content">
        <ul class="list-style vertical-list list-limited" data-show="6">
          <li class="list-item"><a class="filter-link active" href="#">Fashion Clothings</a></li>
          <li class="list-item"><a class="filter-link " href="#">Laptop Batteries</a></li>
          <li class="list-item"><a class="filter-link " href="#">Printer & Ink</a></li>
          <li class="list-item"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
          <li class="list-item"><a class="filter-link " href="#">Sound & Speaker</a></li>
          <li class="list-item"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
          <li class="list-item default-hiden"><a class="filter-link " href="#">Printer & Ink</a></li>
          <li class="list-item default-hiden"><a class="filter-link " href="#">CPUs & Prosecsors</a></li>
          <li class="list-item default-hiden"><a class="filter-link " href="#">Sound & Speaker</a></li>
          <li class="list-item default-hiden"><a class="filter-link " href="#">Shop Smartphone & Tablets</a></li>
          <li class="list-item"><a data-label='Show less<i class="fa fa-angle-up" aria-hidden="true"></i>'
              class="btn-control control-show-more" href="#">Show more<i class="fa fa-angle-down"
                aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div><!-- brand widget-->

    <div class="widget mercado-widget filter-widget price-filter">
      <h2 class="widget-title">Price</h2>
      <div class="widget-content">
        <div id="slider" wire:ignore style="height: 30px "></div>


      </div>
    </div><!-- Price-->

    <div class="widget mercado-widget filter-widget">
      <h2 class="widget-title">Color</h2>
      <div class="widget-content">
        <ul class="list-style vertical-list has-count-index">
          <li class="list-item"><a class="filter-link " href="#">Red <span>(217)</span></a></li>
          <li class="list-item"><a class="filter-link " href="#">Yellow <span>(179)</span></a></li>
          <li class="list-item"><a class="filter-link " href="#">Black <span>(79)</span></a></li>
          <li class="list-item"><a class="filter-link " href="#">Blue <span>(283)</span></a></li>
          <li class="list-item"><a class="filter-link " href="#">Grey <span>(116)</span></a></li>
          <li class="list-item"><a class="filter-link " href="#">Pink <span>(29)</span></a></li>
        </ul>
      </div>
    </div><!-- Color -->

    <div class="widget mercado-widget filter-widget">
      <h2 class="widget-title">Size</h2>
      <div class="widget-content">
        <ul class="list-style inline-round ">
          <li class="list-item"><a class="filter-link active" href="#">s</a></li>
          <li class="list-item"><a class="filter-link " href="#">M</a></li>
          <li class="list-item"><a class="filter-link " href="#">l</a></li>
          <li class="list-item"><a class="filter-link " href="#">xl</a></li>
        </ul>
        <div class="widget-banner">
          <figure>
            {{-- <img src="{{asset('assets/images/size-banner-widget.jpg')}}" width="270" height="331" alt=""> --}}
          </figure>
        </div>
      </div>
    </div><!-- Size -->

    @if (isset($popular))
    <div class="widget mercado-widget widget-product">
      <h2 class="widget-title">Popular Products</h2>
      <div class="widget-content">
        <ul class="products">
                
            @foreach($popular as $popular)
            <li class="product-item">
                <div class="product product-widget-style">
                    <div class="thumbnnail">
                        
                <a href="{{route('product.details',['slug'=>$popular->slug])}}" title="{{$popular->product_name}}">
                  <figure><img src="{{ asset('storage/'. $popular->product_image ) }}"
                      alt="{{$popular->product_name}}"></figure>
                </a>
              </div>
              <div class="product-info">
                  <a href="{{route('product.details',['slug'=>$popular->slug])}}"
                  class="product-name"><span>{{$popular->product_name}}</span></a>
                <div class="wrap-price"><span class="product-price">{{$popular->sale_price}}</span></div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
    </div>
</div><!-- brand widget-->
@endif
    
</div>