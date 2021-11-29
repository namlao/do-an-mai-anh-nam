<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('admin.home') }}"><img src="{{asset('backend/assets/images/logo/logo.png')}}" alt="Logo"
                                              srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">


                <li class="sidebar-item {{ request()->routeIs('admin.home')?'active':'' }}">
                    <a href="{{ route('admin.home') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-title">Quản lý sản phẩm</li>
                <li class="sidebar-item has-sub {{ request()->routeIs('category.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Chuyên mục</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('category.*')?'active':'' }}">

                        <li class="submenu-item {{ request()->routeIs('category.index')?'active':'' }}">
                            <a href="{{ route('category.index') }}">Danh sách chuyên mục</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('category.create')?'active':'' }}">
                            <a href="{{ route('category.create') }}">Thêm chuyên mục</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item has-sub {{ request()->routeIs('product.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('product.*')?'active':'' }}">

                        <li class="submenu-item {{ request()->routeIs('product.index')?'active':'' }}">
                            <a href="{{ route('product.index') }}">Danh sách sản phẩm</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('product.create')?'active':'' }}">
                            <a href="{{ route('product.create') }}">Thêm sản phẩm</a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-title">Quản lý nội dụng</li>
                <li class="sidebar-item has-sub {{ request()->routeIs('slider.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Slide</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('slider.*')?'active':'' }}">

                        <li class="submenu-item {{ request()->routeIs('slider.index')?'active':'' }}">
                            <a href="{{ route('slider.index') }}">Danh sách slide</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('slider.create')?'active':'' }}">
                            <a href="{{ route('slider.create') }}">Thêm sản slide</a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('setting.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('setting.*')?'active':'' }}">

                        <li class="submenu-item {{ request()->routeIs('setting.index')?'active':'' }}">
                            <a href="{{ route('setting.index') }}">Danh sách setting</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('setting.create')?'active':'' }}">
                            <a href="{{ route('setting.create') }}">Thêm setting</a>
                            <ul class="submenu-custom">
                                <li class="submenu-item">
                                    <a href="{{ route('setting.create') .'?type=text' }}">Text</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ route('setting.create').'?type=textarea' }}">Textarea</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="{{ route('setting.create').'?type=image' }}">Image</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-title">Quản lý người dùng</li>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-grid-fill"></i>
                        <span>Đăng xuất</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
