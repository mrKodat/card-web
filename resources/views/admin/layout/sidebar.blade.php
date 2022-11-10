{{-- For Large Devices --}}
<nav class="sidebar sidebar-lg">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <div class="navbar-header-logo">
            <a href="{{ URL::to('admin/dashboard') }}" class="text-white fs-4">{{ trans('labels.visiting_card') }}</a>
        </div>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('/') ? 'active' : '' }}"
                aria-current="page" href="{{ URL::to('admin/dashboard') }}">
                <i class="fs-5 fa-light fa-house-user"></i>
                <span class="mx-2">{{ trans('labels.dashboard') }}</span>
            </a>
        </li>
        @if (Auth::user()->type == '2')
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/business*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/business') }}">
                    <i class="fa-light fa-briefcase"></i>
                    <span class="mx-2">{{ trans('labels.business') }}</span>
                </a>
            </li>
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/appointments*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/appointments') }}">
                    <i class="fa-light fa-calendar-check"></i>
                    <span class="mx-2">{{ trans('labels.appointments') }}</span>
                </a>
            </li>
        @endif
        @if (Auth::user()->type == '1')
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/users') }}">
                    <i class="fs-5 fa-light fa-users"></i>
                    <span class="mx-2">{{ trans('labels.users') }}</span>
                </a>
            </li>
        @endif
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/plans*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/plans') }}">
                <i class="fs-5 fa-light fa-medal"></i>
                <span class="mx-2">{{ trans('labels.pricing_plan') }}</span>
            </a>
        </li>
        @if (Auth::user()->type == '1')
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/payments*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/payments') }}">
                    <i class="fa-light fa-credit-card-front"></i>
                    <span class="mx-2">{{ trans('labels.payments') }}</span>
                </a>
            </li>
        @endif
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/transaction*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/transaction') }}">
                <i class="fa-light fa-file-invoice-dollar"></i>
                <span class="mx-2">{{ trans('labels.transaction') }}</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/settings') }}">
                <i class="fs-5 fa-light fa-gear"></i>
                <span class="mx-2">{{ trans('labels.settings') }}</span>
            </a>
        </li>
        @if (Auth::user()->type == '1')
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/apps*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/apps') }}">
                <i class="fs-5 fa-light fa-rocket"></i>
                <span class="mx-2">Apps</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
{{-- For Small Devices --}}
<nav class="collapse collapse-horizontal sidebar sidebar-md" id="sidebarcollapse">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ URL::to('admin/dashboard') }}" class="text-white fs-4">{{ trans('labels.visiting_card') }}</a>
        <button class="btn text-white" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarcollapse"
            aria-expanded="false" aria-controls="sidebarcollapse"><i class="fa-light fa-xmark"></i></button>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/dashboard') || request()->is('/') ? 'active' : '' }}"
                aria-current="page" href="{{ URL::to('admin/dashboard') }}">
                <i class="fs-5 fa-light fa-house-user"></i>
                <span class="mx-2">{{ trans('labels.dashboard') }}</span>
            </a>
        </li>
        @if (Auth::user()->type == '2')
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/business*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/business') }}">
                    <i class="fa-light fa-briefcase"></i>
                    <span class="mx-2">{{ trans('labels.business') }}</span>
                </a>
            </li>
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/appointments*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/appointments') }}">
                    <i class="fa-light fa-calendar-check"></i>
                    <span class="mx-2">{{ trans('labels.appointments') }}</span>
                </a>
            </li>
        @endif
        @if (Auth::user()->type == '1')
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/users') }}">
                    <i class="fs-5 fa-light fa-users"></i>
                    <span class="mx-2">{{ trans('labels.users') }}</span>
                </a>
            </li>
        @endif
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/plans*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/plans') }}">
                <i class="fs-5 fa-light fa-medal"></i>
                <span class="mx-2">{{ trans('labels.pricing_plan') }}</span>
            </a>
        </li>
        @if (Auth::user()->type == '1')
            <li class="nav-item mb-3">
                <a class="nav-link {{ request()->is('admin/payments*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/payments') }}">
                    <i class="fa-light fa-credit-card-front"></i>
                    <span class="mx-2">{{ trans('labels.payments') }}</span>
                </a>
            </li>
        @endif
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/transaction*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/transaction') }}">
                <i class="fa-light fa-file-invoice-dollar"></i>
                <span class="mx-2">{{ trans('labels.transaction') }}</span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/settings') }}">
                <i class="fs-5 fa-light fa-gear"></i>
                <span class="mx-2">{{ trans('labels.settings') }}</span>
            </a>
        </li>
        @if (Auth::user()->type == '1')
        <li class="nav-item mb-3">
            <a class="nav-link {{ request()->is('admin/apps*') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('admin/apps') }}">
                <i class="fs-5 fa-light fa-rocket"></i>
                <span class="mx-2">Apps</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
