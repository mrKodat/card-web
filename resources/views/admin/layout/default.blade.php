<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ helper::vendor_info()->web_title }}</title>
    <link rel="icon" href="{{ helper::image_path(helper::admin_info()->favicon) }}" type="image" sizes="16x16">
    <!-- Favicon icon -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/bootstrap/bootstrap.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/fontawesome/all.min.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/toastr/toastr.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Sweetalert CSS -->
    @yield('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/responsive.css') }}">
    <!-- Responsive CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <!-- PreLoader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <main>
        <div class="wrapper">
            @include('admin.layout.header')
            <div class="content-wrapper">
                @include('admin.layout.sidebar')
                <div class="main-content">
                    @if (Auth::user()->type == 2)
                        <?php
                        $check_business = helper::checkplan(Auth::user()->id);
                        $v = json_decode(json_encode($check_business));
                        if ($v->original->status == '2') {
                            $infomsg = $v->original->message;
                        }
                        ?>
                        @if (isset($infomsg))
                            <div class="alert alert-warning page-content py-3 m-2" role="alert">
                                {{ $infomsg }} <u><a href="{{ URL::to('admin/plans') }}">Click here</a></u> to
                                upgrade.
                            </div>
                        @endif
                    @endif
                    @yield('content')
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </main>
    <script src="{{ url('storage/app/public/admin-assets/js/jquery/jquery.min.js') }}"></script><!-- jQuery JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/sweetalert/sweetalert2.min.js') }}"></script><!-- Sweetalert JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/common.js') }}"></script><!-- Common JS -->
    <script>
        // For Sweetalert
        let are_you_sure = "{{ trans('messages.are_you_sure') }}";
        let record_safe = "{{ trans('messages.record_safe') }}";
        let yes = "{{ trans('messages.yes') }}";
        let no = "{{ trans('messages.no') }}";
        let wrong = "{{ trans('messages.wrong') }}";
        let cancel = "{{ trans('labels.cancel') }}";
        // to-display-message
        toastr.options = {
            "closeButton": true,
        }
        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

       
    </script>
    @yield('scripts')
</body>

</html>
