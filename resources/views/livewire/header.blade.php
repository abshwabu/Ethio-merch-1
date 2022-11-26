<div class="nav-section header-sticky">

    <div class="primary-nav-section">
        <div class="container">
            <ul class="nav primary clone-main-menu" id="mercado_main" data-menuname="Main menu">
{{-- 
                <li class="menu-item mr-4">
                    <a href="#" class="link-term mercado-item-title"><i class="fa fa-bars">&nbsp;</i>Categories</a>
                </li> --}}
                <li class="menu-item home-icon">
                    <a href="/" class="link-term mercado-item-title"><i class="fa fa-home" aria-hidden="true"></i></a>
                </li>

                <li class="menu-item">
                    <a href="/shop" class="link-term mercado-item-title">Shop</a>
                </li>
                @foreach ($sections as $item)
                <li class="menu-item dropdown1">
                    <a href="javascript:void(0)" class="link-term mercado-item-title">{{$item->name}} <i class="fa fa-angle-up"></i><i class="fa fa-angle-down"></i></a>
                    <div class="dropdown1-content">
                        @if ($item->name == 'Men')

                        @if ($menSection->count())
                        <a href="{{url('category/'.$item->name.'/all')}}" class="nav-2 nav-link text-dark ">All</a>
                        
                        @foreach($menSection as $men)
                        <a href="{{url('category/'.$item->name.'/'.$men->slug)}}"
                            class="nav-2 nav-link text-dark ">{{$men->cate_name}}</a>

                        @endforeach
                        @endif
                        @elseif($item->name == 'Women')
                        @if ($womenSection->count())
                        <a href="{{url('category/'.$item->name.'/all')}}" class="nav-2 nav-link text-dark ">All</a>

                        @foreach($womenSection as $women)
                        <a href="{{url('category/'.$item->name.'/'.$women->slug)}}"
                            class="nav-2 nav-link text-dark ">{{$women->cate_name}}</a>
                        @endforeach
                        @endif
                        @elseif($item->name == 'Kids')
                        @if ($kidsSection->count())
                        <a href="{{url('category/'.$item->name.'/all')}}" class="nav-2 nav-link text-dark ">All</a>
                            
                        @foreach ($kidsSection as $kids)
                        <a href="{{url('category/'.$item->name.'/'.$kids->slug)}}"
                            class="nav-2 nav-link text-dark ">{{$kids->cate_name}}</a>
                        @endforeach
                        @endif
                        @endif

                    </div>
                </li>

                @endforeach

            </ul>
        </div>
    </div>
</div>