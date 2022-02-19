<!-- BEGIN SIDEBAR -->
<div class="sidebar col-md-3 col-sm-5">

    <ul class="list-group margin-bottom-25 sidebar-menu">
        @foreach($categories as $category)
            <li class="list-group-item clearfix @if($category->children->count() > 0) dropdown @endif ">
                <a href="#"><i class="fa fa-angle-right"></i>
                    {{ $category->name }}

                </a>
                <!-- BEGIN DROPDOWN MENU -->
                <ul class="dropdown-menu">
                    @foreach($category->children as$categorieChild )
                        <li class="dropdown-submenu">
                            <a href="{{ route('category',['id'=>$categorieChild->id]) }}">{{ $categorieChild->name }} </a>
                            <ul>
                                @foreach($categorieChild->children as $child)
                                    <li class="dropdown-submenu">
                                        <a href="{{ route('category',['id'=>$child->id]) }}">{{ $child->name }} </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                    @endforeach
                </ul>
                <!-- END DROPDOWN MENU -->
            </li>
        @endforeach


    </ul>

    @if(!request()->routeIs('item') && !request()->routeIs('privacy-policy') && !request()->routeIs('faq') && !request()->routeIs('about')&& !request()->routeIs('contact') && !request()->routeIs('terms-conditions'))
    <div class="sidebar-filter margin-bottom-25">
        <h2>Lọc</h2>
        <h3>Tình trạng</h3>
        <div class="checkbox-list">
            <label><input type="radio" name="status" class="filter-stock" value="="> Hết hàng ({{ $productOutOfStock }})</label>
            <label><input type="radio" name="status" class="filter-stock" value=">"> Còn hàng ({{ $productInStock}})</label>
        </div>

        <h3>Giá</h3>
        <div class="checkbox-list">
            <label><input type="radio" name="price" class="filter-price" value="<_5000000"> Dưới 5.000.000 VND</label>
            <label><input type="radio" name="price" class="filter-price" value="5000000_<=_10000000"> 5.000.000 đến 10.000.000</label>
            <label><input type="radio" name="price" class="filter-price" value="10000000_<=_50000000"> 10.000.000 đến 50.000.000</label>
            <label><input type="radio" name="price" class="filter-price" value="50000000_<=_100000000"> 50.000.000 đến 100.000.000</label>
            <label><input type="radio" name="price" class="filter-price" value=">_100000000"> Trên 100.000.000</label>
        </div>
    </div>
    @endif
    @if(!request()->routeIs('privacy-policy') && !request()->routeIs('faq') && !request()->routeIs('about') && !request()->routeIs('contact') && !request()->routeIs('terms-conditions') )
    <div class="sidebar-products clearfix">
        <h2>Mua nhiều nhất</h2>
        @foreach($productBestSeller as $item)
        <div class="item">
            <a href="{{ route('item',['id' => $item->id]) }}"><img src="{{ asset($item->image_feature_path) }}" alt="{{ $item->name }}"></a>
            <h3><a href="{{ route('item',['id' => $item->id]) }}">{{ $item->name }}</a></h3>
            <div class="price">{{ $item->price }} VND</div>
        </div>
        @endforeach
    </div>
    @endif
</div>
<!-- END SIDEBAR -->
