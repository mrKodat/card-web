<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ trans('labels.admin') }}</title>
    <link rel="icon" href="{{helper::image_path(helper::admin_info()->favicon)}}" type="image" sizes="16x16"><!-- Favicon Icon -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/bootstrap/bootstrap.min.css') }}"><!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/fontawesome/all.min.css') }}"><!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/toastr/toastr.min.css') }}"><!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/sweetalert/sweetalert2.min.css') }}"><!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/responsive.css') }}"><!-- Responsive CSS -->
</head>
<body>
    
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
            <section>
                <div class="row justify-content-center align-items-center g-0 w-100 h-100vh">
                    <div class="col-xl-4 col-lg-6 col-sm-8 col-auto px-5">
                        <div class="card box-shadow overflow-hidden border-0">
                            <div class="bg-secondary-light">
                                <div class="row">
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="text-primary p-4">
                                            <h4>{{ trans('labels.verify_email') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ helper::image_path('authformbgimage.png') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form class="my-3" method="POST" action="{{ URL::to('admin/otpverify') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="otp" class="form-label">{{ trans('labels.verify_email_label') }}<strong>{{ session()->get('verification_email') }}</strong></label>
                                        <input type="number" class="form-control" name="otp"
                                            value="{{ old('otp') }}" id="otp"
                                            placeholder="{{ trans('labels.otp') }}">
                                        @error('otp')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary w-100 my-3"
                                        type="submit">{{ trans('labels.verify') }}</button>
                                    <p class="fs-7 text-center mb-3">{{ trans('labels.dont_receive_otp') }}
                                        <a href="{{ URL::to('admin/resendotp') }}"
                                            class="text-primary fw-semibold">{{ trans('labels.resend') }}</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="{{ url('storage/app/public/admin-assets/js/jquery/jquery.min.js') }}"></script><!-- jQuery JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script><!-- Bootstrap JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/toastr/toastr.min.js') }}"></script><!-- Toastr JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/sweetalert/sweetalert2.min.js') }}"></script><!-- Sweetalert JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/common.js') }}"></script><!-- Common JS -->
    @yield('scripts')
    <script>
        // to-display-message
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
            }
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
            }
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
            }
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>
</html>
