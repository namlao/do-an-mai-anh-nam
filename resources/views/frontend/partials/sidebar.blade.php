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
                        </li>
                    @endforeach
                </ul>
                <!-- END DROPDOWN MENU -->
            </li>
        @endforeach


    </ul>

    @if(!request()->routeIs('item'))
    <div class="sidebar-filter margin-bottom-25">
        <h2>Lọc</h2>
        <h3>Tình trạng</h3>
        <div class="checkbox-list">
            <label><input type="checkbox"> Hết hàng (3)</label>
            <label><input type="checkbox"> Còn hàng (26)</label>
        </div>

        <h3>Giá</h3>
        <p>
            <label for="amount">Khoảng:</label>
            <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
        </p>
        <div id="slider-range"></div>
    </div>
    @endif
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
</div>
<!-- END SIDEBAR -->
