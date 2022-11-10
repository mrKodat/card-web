<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ trans('labels.admin') }}</title>
    <link rel="icon" href="{{ helper::image_path(helper::admin_info()->favicon) }}" type="image" sizes="16x16">
    <!-- Favicon Icon -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/bootstrap/bootstrap.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/fontawesome/all.min.css') }}">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/toastr/toastr.min.css') }}">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/sweetalert/sweetalert2.min.css') }}">
    <!-- Sweetalert CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/style.css') }}"><!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/responsive.css') }}">
    <!-- Responsive CSS -->
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
                    <div class="col-xl-4 col-lg-6 col-sm-8 px-5">
                        <div class="card box-shadow overflow-hidden border-0">
                            <div class="bg-secondary-light">
                                <div class="row">
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="text-primary p-4">
                                            <h4>{{ trans('labels.welcome_back') }}</h4>
                                            <p>{{ trans('labels.signin_continue') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ helper::image_path('authformbgimage.png') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form class="my-3" method="POST" action="{{ URL::to('admin/checklogin') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="form-label">{{ trans('labels.email') }}</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" id="email"
                                            placeholder="{{ trans('labels.email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">{{ trans('labels.password') }}</label>
                                        <input type="password" class="form-control" name="password"
                                            value="{{ old('password') }}" id="password"
                                            placeholder="{{ trans('labels.password') }}">
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary w-100 my-3"
                                        type="submit">{{ trans('labels.login') }}</button>
                                </form>
                                @if (env('Environment') == 'sendbox')
                                    <div class="form-group mt-3 table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Admin<br>admin@gmail.com</td>
                                                    <td>123456</td>
                                                    <td><button class="btn btn-info btn-sm"
                                                            onclick="AdminFill('admin@gmail.com' , '123456')">{{ trans('labels.copy') }}</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Vendor<br>paponapp2244@gmail.com</td>
                                                    <td>123456</td>
                                                    <td><button class="btn btn-info btn-sm"
                                                            onclick="AdminFill('paponapp2244@gmail.com' , '123456')">{{ trans('labels.copy') }}</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <div class="mb-3 text-center">
                                    <a href="{{ URL::to('admin/forgotpassword') }}" class="text-muted fs-8 fw-500">
                                        <i
                                            class="fa-solid fa-lock-keyhole mx-2 fs-7"></i>{{ trans('labels.forgot_password') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="fs-7 text-center mt-3">{{ trans('labels.dont_have_account') }}
                            <a href="{{ URL::to('admin/register') }}"
                                class="text-primary fw-semibold">{{ trans('labels.register') }}</a>
                        </p>
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

    <script>
        function AdminFill(email,password) {
            $('#email').val(email);
            $('#password').val(password);
        }
    </script>
</body>

</html>
