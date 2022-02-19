<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('admin.home') }}"><img src="{{asset('backend/assets/images/logo/logo.png')}}"
                                                             alt="Logo"
                                                             srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>

        </div>
        <div class="d-flex align-items-center info-user">
            <div class="avatar avatar-xl">
                @if(!is_null(\Illuminate\Support\Facades\Auth::user()->avatar))
                    <img src="{{ url('').'/'.\Illuminate\Support\Facades\Auth::user()->avatar }}" alt="Face 1">
                @else
                    <img src="{{ url('backend/assets/images/faces/2.jpg') }}" alt="Face 1">
                @endif
            </div>
            <div class="ms-3 name">
                <h5 class="font-bold">{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                <h6 class="text-muted mb-0">{{\Illuminate\Support\Facades\Auth::user()->email}}</h6>
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
                @role('admin')
                <li class="sidebar-title">Quản lý sản phẩm</li>
                <li class="sidebar-item has-sub {{ request()->routeIs('category.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fa fa-folder"></i>
                        <span>Chuyên mục</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('category.*')?'active':'' }}">
                        @can('category list')
                            <li class="submenu-item {{ request()->routeIs('category.index')?'active':'' }}">
                                <a href="{{ route('category.index') }}">Danh sách chuyên mục</a>
                            </li>
                        @endcan
                        @can('category add')
                            <li class="submenu-item {{ request()->routeIs('category.create')?'active':'' }}">
                                <a href="{{ route('category.create') }}">Thêm chuyên mục</a>
                            </li>
                        @endcan

                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('product.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-basket"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('product.*')?'active':'' }}">
                        @can('product list')
                            <li class="submenu-item {{ request()->routeIs('product.index')?'active':'' }}">
                                <a href="{{ route('product.index') }}">Danh sách sản phẩm</a>
                            </li>
                        @endcan
                        @can('product add')
                            <li class="submenu-item {{ request()->routeIs('product.create')?'active':'' }}">
                                <a href="{{ route('product.create') }}">Thêm sản phẩm</a>
                            </li>
                        @endcan

                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('brand.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-copyright"></i>
                        <span>Thương hiệu</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('brand.*')?'active':'' }}">
                        <li class="submenu-item {{ request()->routeIs('brand.index')?'active':'' }}">
                            <a href="{{ route('brand.index') }}">Danh sách thương hiệu</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('brand.create')?'active':'' }}">
                            <a href="{{ route('brand.create') }}">Thêm thương hiệu</a>
                        </li>

                    </ul>
                </li>

                {{--                <li class="sidebar-item has-sub {{ request()->routeIs('storage.*')?'active':'' }}">--}}
                {{--                    <a href="#" class='sidebar-link'>--}}
                {{--                        <i class="bi bi-stack"></i>--}}
                {{--                        <span>Kho</span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="submenu {{ request()->routeIs('storage.*')?'active':'' }}">--}}
                {{--                        <li class="submenu-item {{ request()->routeIs('storage.index')?'active':'' }}">--}}
                {{--                            <a href="{{ route('storage.index') }}">Danh sách sản phẩm trong kho</a>--}}
                {{--                        </li>--}}
                {{--                        <li class="submenu-item {{ request()->routeIs('product.create')?'active':'' }}">--}}
                {{--                            <a href="{{ route('storage.create') }}">Thêm sản phẩm vào kho</a>--}}
                {{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}

                {{--                <li class="sidebar-item has-sub {{ request()->routeIs('etsy.*')?'active':'' }}">--}}
                {{--                    <a href="#" class='sidebar-link'>--}}
                {{--                        <i class="bi bi-stack"></i>--}}
                {{--                        <span>Sản phẩm etsy</span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="submenu ">--}}
                {{--                        --}}{{--                        <li class="submenu-item ">--}}
                {{--                        --}}{{--                            <a href="{{ route('etsy.connect') }}">Kết nối etsy</a>--}}
                {{--                        --}}{{--                        </li>--}}
                {{--                        <li class="submenu-item {{ request()->routeIs('etsy.index')?'active':'' }}">--}}
                {{--                            <a href="{{route('etsy.index')}}">Danh sách sản phẩm</a>--}}
                {{--                        </li>--}}
                {{--                        --}}{{--                        <li class="submenu-item {{ request()->routeIs('etsy.index')?'active':'' }}">--}}
                {{--                        --}}{{--                            <a href="">Thêm sản phẩm</a>--}}
                {{--                        --}}{{--                        </li>--}}

                {{--                    </ul>--}}
                {{--                </li>--}}
                @endrole

                @role('admin|content')
                <li class="sidebar-title">Quản lý nội dụng</li>
                <li class="sidebar-item has-sub {{ request()->routeIs('slider.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-sliders-h"></i>
                        <span>Slide</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('slider.*')?'active':'' }}">
                        @can('slide list')
                            <li class="submenu-item {{ request()->routeIs('slider.index')?'active':'' }}">
                                <a href="{{ route('slider.index') }}">Danh sách slide</a>
                            </li>
                        @endcan
                        @can('slide add')
                            <li class="submenu-item {{ request()->routeIs('slider.create')?'active':'' }}">
                                <a href="{{ route('slider.create') }}">Thêm sản slide</a>
                            </li>
                        @endcan
                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('setting.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-cogs"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('setting.*')?'active':'' }}">
                        @can('setting list')
                            <li class="submenu-item {{ request()->routeIs('setting.index')?'active':'' }}">
                                <a href="{{ route('setting.index') }}">Danh sách setting</a>
                            </li>
                        @endcan
                        @can('setting add')
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
                        @endcan

                    </ul>
                </li>
                @endrole

                @role('admin')
                <li class="sidebar-title">Quản lý hóa dơn</li>
                {{--                <li class="sidebar-item {{ request()->routeIs('bill.*')?'active':'' }}">--}}
                {{--                    <a href="{{route('bill.customer') }}" class='sidebar-link'>--}}
                {{--                        <i class="bi bi-stack"></i>--}}
                {{--                        <span>Quản lý khách hàng</span>--}}
                {{--                    </a>--}}

                {{--                </li>--}}
                <li class="sidebar-item has-sub {{ request()->routeIs('bill.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-money-bill"></i>
                        <span>Quản lý hóa đơn</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('bill.*')?'active':'' }}">
                        <li class="submenu-item {{ request()->routeIs('bill.index')?'active':'' }}">
                            <a href="{{ route('bill.index') }}">Danh sách hóa đơn</a>
                        </li>
                    </ul>

                </li>
                @endrole
                @role('member-manager|admin|content')
                <li class="sidebar-title">Quản lý người dùng</li>
                <li class="sidebar-item has-sub {{ request()->routeIs('user.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-users"></i>
                        <span>Thành viên</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('user.*')?'active':'' }}">
                        @can('user list')
                            <li class="submenu-item {{ request()->routeIs('user.index')?'active':'' }}">
                                <a href="{{ route('user.index') }}">Danh sách thành viên</a>
                            </li>
                        @endcan
                        @can('user add')
                            <li class="submenu-item {{ request()->routeIs('user.create')?'active':'' }}">
                                <a href="{{ route('user.create') }}">Thêm thành viên</a>
                            </li>
                        @endcan

                    </ul>
                </li>
                <li class="sidebar-item has-sub {{ request()->routeIs('comment.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-comments"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('comment.*')?'active':'' }}">
                        <li class="submenu-item {{ request()->routeIs('comment.index')?'active':'' }}">
                            <a href="{{ route('comment.index') }}">Danh sách bình luận</a>
                        </li>

                    </ul>
                </li>

                @role('admin')
                <li class="sidebar-item has-sub {{ request()->routeIs('role.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-user-tag"></i>
                        <span>Vai trò</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('role.*')?'active':'' }}">

                        <li class="submenu-item {{ request()->routeIs('role.index')?'active':'' }}">
                            <a href="{{ route('role.index') }}">Danh sách Vai trò</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('role.index')?'active':'' }}">
                            <a href="{{ route('permission.index') }}">Thêm phân quyền</a>
                        </li>
                        {{--                        <li class="submenu-item {{ request()->routeIs('permission.index')?'active':'' }}">--}}
                        {{--                            <a href="{{ route('permission.index') }}">Danh sách quyền</a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="submenu-item {{ request()->routeIs('role.create')?'active':'' }}">--}}
                        {{--                            <a href="{{ route('role.create') }}">Thêm vai trò</a>--}}
                        {{--                        </li>--}}

                    </ul>
                </li>
                @endrole


                @endrole
                <li class="sidebar-title">Quản lý API</li>
                <li class="sidebar-item has-sub {{ request()->routeIs('lazada.*')?'active':'' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-shopping-bag"></i>
                        <span>Lazada</span>
                    </a>
                    <ul class="submenu {{ request()->routeIs('lazada.*')?'active':'' }}">
                        <li class="submenu-item {{ request()->routeIs('lazada.authorize')?'active':'' }}">
                            <a href="{{ route('lazada.authorize') }}">Authorize</a>
                        </li>
                        <li class="submenu-item {{ request()->routeIs('lazada.index')?'active':'' }}">
                            <a href="{{ route('lazada.index') }}">Quản lý sản phẩm</a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i>
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
