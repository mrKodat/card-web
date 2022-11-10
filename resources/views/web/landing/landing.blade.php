<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ helper::image_path(helper::admin_info()->favicon) }}" type="image" sizes="16x16">
    <link rel="stylesheet" href=" {{ url('storage/app/public/web-assets/css/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href=" {{ url('storage/app/public/web-assets/css/fontawesome/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/owl/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/owl/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/landing/aos.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/landing/app.css') }}" />
    <title> {{ trans('labels.visiting_card') }} </title>
</head>
<body>
    <div class="header sticky-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <nav class="navbar logo_images">
                    <img src="{{ url('storage/app/public/web-assets/images/logo.png') }}" alt="">
                </nav>
                <div class="navbarnav">
                    <ul class="d-flex">
                        <li class="nav-item p-4">
                            <a class="nav-link active" href="#home"> {{ trans('labels.home') }} </a>
                        </li>
                        <li class="nav-item p-4">
                            <a class="nav-link" href="#aboutus">{{ trans('labels.about_us') }}</a>
                        </li>
                        <li class="nav-item p-4">
                            <a class="nav-link" href="#features">{{ trans('labels.features') }}</a>
                        </li>
                        <li class="nav-item p-4">
                            <a class="nav-link" href="#pricing">{{ trans('labels.pricing_plan') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="login-btn">
                    <a href="{{ URL::to('admin') }}" class="btn btn-outline-primary btn-hover-1">{{ trans('labels.login') }}</a>
                    <a href="{{ URL::to('admin/register') }}" class="btn btn-primary btn-hover-1">{{ trans('labels.register') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="toggle-btn">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <nav class="navbar logo_images">
                    <img src="{{ url('storage/app/public/web-assets/images/logo.png') }}" alt="">
                </nav>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-bars"></i></button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <nav class="navbar canvase_images">
                            <img src="{{ url('storage/app/public/web-assets/images/logo.png') }}" alt="">
                        </nav>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="navbarnav">
                            <ul class="list-group">
                                <li class="nav-item p-3">
                                    <a class="nav-link active" href="#home">{{ trans('labels.home') }}</a>
                                </li>
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="#aboutus">{{ trans('labels.about_us') }}</a>
                                </li>
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="#features">{{ trans('labels.features') }}</a>
                                </li>
                                <li class="nav-item p-3">
                                    <a class="nav-link" href="#pricing">{{ trans('labels.pricing_plan') }}</a>
                                </li>
                                <a href="{{ URL::to('admin') }}" class="btn btn-outline-primary btn-hover-1 col-6 mb-4">{{ trans('labels.login') }}</a>
                                <a href="{{ URL::to('admin/register') }}" class="btn btn-primary btn-hover-1 col-6">{{ trans('labels.register') }}</a>
                            </ul>
                        </div>
                        <div class="login-btn">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-main-sec" id="home">
        <div class="container">
            <img src="{{ url('storage/app/public/web-assets/images/shape-2.png') }}" class="banner-img-2" alt="">
            <div class="banner-content row" >
                <div class="col-lg-6 banner-text" data-aos="zoom-in" data-aos-duration="1500">
                    <h1 class="text-heding-1">Interactive Digital Business Card</h1>
                    <p class="text-heding-2">contact tech cards</p>
                    <p class="banner-dec text-color">Make a great first impression with the most advanced, intelligent and stunning Digital Business Card that you can create using our digital business card tool.</p>
                    <a href="{{ URL::to('admin/register') }}" class="btn btn-primary btn-hover-1">{{ trans('labels.register') }}</a>
                </div>
                <div class="col-lg-6 banner-image" data-aos="flip-right" data-aos-duration="1500">
                    <img src="{{ url('storage/app/public/web-assets/images/bannar-bg.png') }}" alt="" >
                </div>
            </div>
        </div>
    </div>
    <div class="about-main-sec" id="aboutus">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 about-image">
                    <img src="{{ url('storage/app/public/web-assets/images/about.png') }}" alt="" data-aos="fade-down" data-aos-duration="1000">
                </div>
                <div class="col-lg-6 about-content">
                    <div data-aos="fade-up" data-aos-duration="1200">
                        <h3 class="about-title">About Us</h3>
                        <h3 class="about-text">SaaS Solutions for
                            your Business<br> Grow
                            on time</h3>
                        <p class="text-color">Business solution company sit our any how site used the our company any site us it-solve theme is very professional theme business & corporate, finance, advisor, solution, company and all project used, there are all kinds of websites here.
                        </p>
                        <p class="text-color">
                            Business solution company sit our any how site used the our company any site us it-solve theme is very professional theme business & corporate, finance, advisor, solution, company and all project used, there are all kinds of websites here.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="service-sec" id="features">
        <div class="container">
            <div class="service-heading mb-3">
                <h3 class="text-center mb-2">Features</h3>
                <h5 class="text-center service-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestias, iure!</h5>
            </div>
            <div class="row">
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1000" >
                    <div class="iner-box h-100">
                        <i class="fa-regular fa-object-ungroup"></i>
                        <h4 class="inner-box-heading">Unlimited Business Cards</h4>
                        <p>Create unlimited Business Card for your all business.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1200" >
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-masks-theater"></i>
                        <h4 class="inner-box-heading">Multiple Themes</h4>
                        <p>Four inbuilt templates for your Business Card.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600" >
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-place-of-worship"></i>
                        <h4 class="inner-box-heading">Product and Service Listing</h4>
                        <p>List unlimited products and services on your Business Card.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-list-check"></i>
                        <h4 class="inner-box-heading">Portfolio Listing</h4>
                        <p>Show your work experience by your portfolio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1200">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-users"></i>
                        <h4 class="inner-box-heading">Testimonials</h4>
                        <p>Add your happy client's testimonials.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-bars-staggered"></i>
                        <h4 class="inner-box-heading">Fully Responsive</h4>
                        <p>Clean UI and Compatible with all devices.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1200">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-share-nodes"></i>
                        <h4 class="inner-box-heading">Save & Share Business Card</h4>
                        <p>Easy save and share your Business Card options.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1400">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-link"></i>
                        <h4 class="inner-box-heading">Unique Link</h4>
                        <p>Get your personal Unique Link for all your Business Card.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-qrcode"></i>
                        <h4 class="inner-box-heading">QR Code</h4>
                        <p>Get your unique personal QR code for all your Business Card.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-phone"></i>
                        <h4 class="inner-box-heading">Click to call</h4>
                        <p>Your customers will reach you by just tapping on mobile number on Business Card.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">
                    <div class="iner-box h-100">
                        <i class="fa-solid fa-location"></i>
                        <h4 class="inner-box-heading">Click to Navigate</h4>
                        <p>Using Business Card, people can navigate to your store with Google Maps.</p>
                    </div>
                </div>
                <div class="services-box col-xl-3 col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1600">
                    <div class="iner-box h-100">
                        <i class="fa-brands fa-whatsapp"></i>
                        <h4 class="inner-box-heading">Click To WhatsApp</h4>
                        <p>Your prospects can whatsapp you without even saving your number!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="work-flow-main">
        <div class="container">
            <div class="service-heading">
                <h3 class="text-center pb-4">Work flow</h3>
            </div>
            <div class="row">
                <div class="work-flow col-xl-4 col-md-6 text-center" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                    <div class="work-iner-box">
                        <div class="work-check">
                            <div class="icon-circle">
                                <i class="fa-solid fa-qrcode"></i>
                                <div class="work-iner-check">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="work-inner-heading">Create your card</h4>
                    <p class="flow-text">Easily create QR code for your visiting card and make a great first impression. Fill your profile, it is simple!</p>
                </div>
                <div class="work-flow col-xl-4 col-md-6 text-center" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1200">
                    <div class="work-iner-box">
                        <div class="work-check">
                            <div class="icon-circle">
                                <i class="fa-regular fa-share-nodes"></i>
                                <div class="work-iner-check">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="work-inner-heading">Share your card with anyone</h4>
                    <p class="flow-text">Easily share your digital business card with anyone using a QR code or send it through email, a link, and more. you can download QR code and print on anything like flyers, newsletters, or a billboard.</p>
                </div>
                <div class="work-flow col-xl-4 col-md-6 text-center" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1400">
                    <div class="work-iner-box">
                        <div class="work-check">
                            <div class="icon-circle">
                                <i class="fa-regular fa-trophy"></i>
                                <div class="work-iner-check">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="work-inner-heading">Get More Customers</h4>
                    <p class="flow-text">Your customers will find a way to reach you. All they need to do is scan QR code and choose a better channel to reach you.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="pricing-main-sec" id="pricing">
        <div class="container">
            <div class="pricing-heading text-center pb-4">
                <span class="pricing-heading-2"> Choose Package</span>
                <h3 class="pricing-heading-1">Pricing</h3>
            </div>
            <div class="pricing-card">
                <div class="row">
                    @foreach($planlist as $plan)
                    <div class="col-xl-4 col-md-6 mb-5" data-aos="zoom-in-down" data-aos-duration="1000">
                        <div class="card pricing-card-main">
                            <div class="card-body pricing-card-body">
                                <h5 class=" card-subtitle mb-4">{{$plan->name}}</h5>
                                <h6 class="card-title mb-2">{{helper::currency_format($plan->price,1)}} / 
								@if ($plan->duration == 1)
                                    {{ trans('labels.one_month') }}
                                @elseif ($plan->duration == 2)
                                    {{ trans('labels.three_months') }}
                                @elseif ($plan->duration == 3)
                                    {{ trans('labels.six_months') }}
                                @else
                                    {{ trans('labels.one_year') }}
                                @endif</h6>
                                <h3 class="pricing-card-heading text-center">For growing business that needs more</h3>
                                <div class="pricing-group">
                                    <ul class="list-group">
                                        @php $features = explode('|', $plan->features); @endphp
                                        @foreach ($features as $features)
                                        <li class="list-item d-flex">
                                            <i class="fa-regular fa-circle-check"></i>
                                            <p class="ms-2">{{ $features }}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <a href="{{ URL::to('admin/register') }}" type="button" class="btn btn-primary col-12 card-btn">Start Free Trial</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-end">
                <div class="footer-logo">
                    <img src="{{ url('storage/app/public/web-assets/images/logo.png') }}" alt="">
                </div>
                <div class="copy-right">
                    <p>Copyright © 2021. All rights reserved by Business Card.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="back-to-top" class="show">
        <a class="btn text-primary">
            <i class="fa-solid fa-angle-up"></i>
        </a>
    </div>
    <script src=" {{url('storage/app/public/web-assets/js/jquery.js')}}"></script>
    <script src="{{url('storage/app/public/web-assets/js/bootstrap/bootstrap.bundle.min.js')}} "></script>
    <script src="{{url('storage/app/public/web-assets/js/owl/owl.carousel.min.js')}} "></script>
    <script src="{{url('storage/app/public/web-assets/js/landing/aos.js')}}"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $(window).on('scroll',function() {
            "use strict";
            if ($(window).scrollTop() > 300) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        });
        $('#back-to-top').on('click', function(e) {
            "use strict";
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>
</body>
</html>