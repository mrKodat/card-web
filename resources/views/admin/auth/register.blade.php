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
                    <div class="col-lg-4 col-sm-8 col-auto px-5">
                        <div class="card box-shadow overflow-hidden border-0">
                            <div class="bg-secondary-light">
                                <div class="row">
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="text-primary p-4">
                                            <h4 class="mb-1">{{ trans('labels.register') }}</h4>
                                            <p class="fs-7">{{ trans('labels.get_free_account') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{helper::image_path('authformbgimage.png')}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <form class="my-3" method="POST" action="{{URL::to('admin/store')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="form-label">{{ trans('labels.name') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="{{ trans('labels.name') }}">
                                        @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">{{ trans('labels.email') }}</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" placeholder="{{ trans('labels.email') }}">
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile" class="form-label">{{ trans('labels.mobile') }}</label>
                                        <input type="number" class="form-control" name="mobile" value="{{ old('mobile') }}" id="mobile" placeholder="{{ trans('labels.mobile') }}">
                                        @error('mobile')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label">{{ trans('labels.password') }}</label>
                                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="password" placeholder="{{ trans('labels.password') }}">
                                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                        <label class="form-check-label" for="flexCheckChecked">{{ trans('labels.i_accept_the') }}
                                            <a href="javascript:void(0)" class="text-primary fw-semibold">{{ trans('labels.terms_conditions') }}</a>
                                        </label>
                                    </div>
                                    <button class="btn btn-primary w-100 mb-3" type="submit">{{ trans('labels.register') }}</button>
                                    <p class="fs-7 text-center mb-3">{{ trans('labels.already_have_account') }}
                                        <a href="{{URL::to('admin')}}" class="text-primary fw-semibold">{{ trans('labels.login') }}</a>
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
