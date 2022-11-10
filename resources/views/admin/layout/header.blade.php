<header class="page-topbar">
    <div class="navbar-header">
        <button class="navbar-toggler d-lg-none d-md-block px-4" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarcollapse" aria-expanded="false" aria-controls="sidebarcollapse">
            <i class="fa-regular fa-bars fs-4"></i>
        </button>
        <div class="px-3">
            @if (Session('vendor_login'))
                <a href="{{URL::to('admin/admin_login')}}" class="btn btn-primary btn-sm">{{ trans('labels.back_to_admin') }}</a>
            @endif
            <div class="dropwdown d-inline-block">
                <button class="btn header-item" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ helper::image_path(Auth::user()->image) }}">
                    <span class="d-none d-xxl-inline-block d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="fa-regular fa-angle-down d-none d-xxl-inline-block d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu box-shadow">
                    <a href="{{ URL::to('admin/settings') }}#editprofile" class="dropdown-item d-flex align-items-center">
                        <i class="fa-light fa-address-card fs-5 mx-2"></i>{{ trans('labels.profile') }}
                    </a>
                    <a href="{{ URL::to('admin/settings') }}" class="dropdown-item d-flex align-items-center">
                        <i class="fa-light fa-gear fs-5 mx-2"></i>{{ trans('labels.setting') }}
                    </a>
                    <a onclick="logout('{{ URL::to('admin/logout') }}')" class="dropdown-item d-flex align-items-center">
                        <i class="fa-light fa-right-from-bracket fs-5 mx-2"></i>{{ trans('labels.logout') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
