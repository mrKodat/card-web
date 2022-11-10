<!DOCTYPE html>
<html lang="en" dir="{{ $basicinfo->web_layout == 1 ? 'ltr' : 'rtl' }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="{{ $basicinfo->meta_title }}" />
    <meta property="og:description" content="{{ $basicinfo->meta_description }}" />
    <meta property="og:image" content="{{ helper::image_path($basicinfo->og_image) }}" />
    <link rel="stylesheet" href=" {{ url('storage/app/public/web-assets/css/bootstrap/bootstrap.min.css') }}" />
    <link rel="stylesheet" href=" {{ url('storage/app/public/web-assets/css/fontawesome/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/owl/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/owl/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/responsive.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ helper::image_path($basicinfo->favicon) }}">
    <title>{{ $basicinfo->title }}</title>
</head>
<body>
    <style>
        :root {
            --theme-four: {{ $basicinfo->primary_color }};
        }
        .bg-primary {
            background-color: var(--theme-four) !important;
        }
    </style>
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
    <section class="visting-card">
        <div class="container">
            <div class="row justify-content-center">
                @if (Session::get('infomsg'))
                    <div class="alert alert-warning" role="alert">
                        {{ Session::get('infomsg') }}
                    </div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::get('error'))
                    <div class="alert alert-error" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <div class="col-lg-8 col-12">
                    <div class="card bg-light border-0 mb-5">
                        <div class="position-relative">
                            @if ($basicinfo->banner_image == '')
                            <img src="{{ helper::image_path('default-banner.jpg') }}" alt="" class="cover2-img">
                            @else
                            <img src="{{ helper::image_path($basicinfo->banner_image) }}" class="cover2-img">
                            @endif
                        </div>
                        <div class="profile2-sec">
                            @if ($basicinfo->profile_image == '')
                            <img src="{{ helper::image_path('default-profile.jpg') }}" alt="" class="profile2-img">
                            @else
                            <img src="{{ helper::image_path($basicinfo->profile_image) }}" class="profile2-img">
                            @endif
                            <div class="profile2-text">
                                <h5>{{ $basicinfo->title }} - {{ $basicinfo->designation }}</h5>
                                <p>{{ $basicinfo->sub_title }}</p>
                                @if (helper::section_aviable('contact_info', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($contactinfo) > 0)
                                <div class="contact-main-sec my-4">
                                    <div class="row justify-content-center contect2-box">
                                        @foreach ($contactinfo as $contact)
                                        @if ($contact->type == 1)
                                        @if($contact->title == 'Address')
                                        <div class="text-center align-items-center col-md-3 contact-theme4 mb-2">
                                            <a href="https://www.google.com/maps/place/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}" target="_blank">
                                                {!! ($contact->icon ) !!}
                                                <p class="text-muted my-1">{{ $contact->title }}</p>
                                            </a>
                                        </div>
                                        @elseif($contact->title == 'Phone')
                                        <div class="text-center align-items-center col-md-3 contact-theme4 mb-2">
                                            <a href="tel:{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}" target="_blank">
                                                {!! ($contact->icon ) !!}
                                                <p class="text-muted my-1">{{ $contact->title }}</p>
                                            </a>
                                        </div>
                                        @elseif($contact->title == 'Email')
                                        <div class="text-center align-items-center col-md-3 contact-theme4 mb-2">
                                            <a href="mailto:{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}" target="_blank">
                                                {!! ($contact->icon ) !!}
                                                <p class="text-muted my-1">{{ $contact->title }}</p>
                                            </a>
                                        </div>
                                        @else
                                        <div class="text-center align-items-center col-md-3 contact-theme4 mb-2">
                                            <a href="{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}" target="_blank">
                                                {!! ($contact->icon ) !!}
                                                <p class="text-muted my-1">{{ $contact->title }}</p>
                                            </a>
                                        </div>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                <div class="more-main-sec d-md-flex justify-content-around mb-4">
                                    <a href="{{ URL::to($basicinfo->slug . '/savecard') }}" class="btn more-btn">
                                        <i class="fa-light fa-download"></i>
                                        {{ trans('labels.save_card') }}
                                    </a>
                                    <a class="btn  more-btn" data-bs-toggle="modal" data-bs-target="#share_card_modal">
                                        <i class="fa-light fa-share-all"></i>
                                        {{ trans('labels.share_card') }}
                                    </a>
                                    @include('web.share_card_modal')
                                </div>
                            </div>
                        </div>
                        <div class="card-body main-card-body">
                            <div class="about-main-sec pb-4">
                                <h2>{{ trans('labels.about_us') }}</h2>
                                <p class="px-2 about-content">{!! clean(nl2br(e($basicinfo->description)) ) !!}</p>
                            </div>
                            @if (helper::section_aviable('services', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($services) > 0)
                            <div class="service3-sec pb-4">
                                <h2 class="service2-text pb-4">{{ trans('labels.services') }}</h2>
                                <div class="owl-carousel carousel_se_02 owl-theme">
                                    @foreach ($services as $service)
                                    <div class="carousel-item-icon text-center carousel-sec me-1">
                                        <div class="image-hw">
                                            <img src="{{ helper::image_path($service->image) }}">
                                        </div>
                                        <div class="item-cotent3">
                                            <h4 class="item-title">{{ $service->title }}</h4>
                                            <span class="itexm-text">{{ $service->description }}</span>
                                            <a href="{{ $service->purchase_link }}" class="btn coman-btn d-block  mx-auto col-lg-6 col-6 my-4 text-white theme-foure-btn" target="_blank">
                                                {{ $service->link_title }}
                                                <i class="fa-duotone fa-angles-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @if (helper::section_aviable('testimonials', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($testimonials) > 0)
                            <div class="testimonial2-sec pb-4">
                                <h2 class="testimonial2-text pb-4">{{ trans('labels.testimonials') }}</h2>
                                <div id="carouselExampleFade" class="carousel-fade" data-bs-ride="carousel" data-bs-intervel="2000">
                                    <div class="carousel-inner">
                                        @foreach ($testimonials as $key => $testimonial)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="carousel-main">
                                                <div class="carousel3-sec">
                                                    <img src="{{ helper::image_path($testimonial->image) }}" alt="review" class="mx-4">
                                                        <div class="d-flex justify-content-center ms-3">
                                                            @for($s = 1; $s <= 5; $s++) <p class=" {{ $s <= $testimonial->rating ? 'text-warning' : 'text-secondary' }} m-1">
                                                                <i class="fa-solid fa-star"></i>
                                                            </p>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                <span class="itexm2-text">{{ $testimonial->review }}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if (helper::section_aviable('appointments', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($appointments) > 0)
                            <div class="appointment2-sec pb-4" id="appointment_section">
                                <h2 class="appointment2-text pb-4">{{ trans('labels.appointments') }}</h2>
                                <div class="appoiment-form2">
                                    <form method="POST" action="{{ URL::to($basicinfo->slug . '/store_appointments-'.$basicinfo->vendor_id) }}">
                                        @csrf
                                        <input type="hidden" value="{{ $basicinfo->id }}" name="business_id">
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label class="form-label">{{ trans('labels.name') }}:</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ trans('labels.name') }}">
                                                @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="form-label">{{ trans('labels.email') }}:</label>
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('labels.email') }}">
                                                @error('email')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label name="mobile" class="form-label">{{ trans('labels.mobile') }}:</label>
                                                <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" placeholder="{{ trans('labels.mobile') }}">
                                                @error('mobile')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="form-label">{{ trans('labels.date') }}:</label>
                                                <input type="date" class="form-control" name="date" value="{{ old('date') }}" id="date_picker">
                                                @error('date')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="time-option4">
                                                <label class="appoiment">{{ trans('labels.time') }}:</label>
                                                <div class="row ">
                                                    @foreach ($appointments as $appountment)
                                                    <label class="form-check-label col-md-4 text-center m-0">
                                                        <input type="radio" class="form-check-input" name="time" value=" {{ $appountment->start_time . '-' . $appountment->end_time }}">
                                                        <div class="appo-time4">
                                                            {{ $appountment->start_time }} -{{ $appountment->end_time }}
                                                        </div>
                                                    </label>
                                                    @endforeach
                                                </div>
                                                @error('time')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="appoiment-button pt-3">
                                            <button type="submit" class="btn coman-btn text-white theme-foure-btn">
                                                <i class="fa-duotone fa-calendar-days"></i>
                                                {{ trans('labels.make_appointment') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @if (helper::section_aviable('business_hours', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($timeinfo) > 0)
                            <div class="business-sec pb-4">
                                <h2>{{ trans('labels.business_hours') }}</h2>
                                <div class="working-hours pt-3">
                                    <ul class="list-group border-0 bg-none">
                                        @foreach ($timeinfo as $time)
                                        <li class="list-group-item d-md-flex border-0 default-color">
                                            <div class="fw-bold col-md-6 text-center">{{ trans('labels.' . strtolower($time->day)) }}</div>
                                            @if ($time->is_closed == 1)
                                            <p class="col-md-6 text-center">{{ trans('labels.closed') }}
                                            </p>
                                            @elseif($time->is_closed == 2)
                                            <p class="col-md-6 text-center">{{ $time->start_time }} To
                                                {{ $time->end_time }}
                                            </p>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if (helper::section_aviable('social_links', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($socialinfo) > 0)
                            <div class="social-sec py-4 rounded ">
                                <h2 class="social4-text">{{ trans('labels.social') }}</h2>
                                <div class="social2-icon text-center">
                                    @foreach ($socialinfo as $social)
                                    @if ($social->type == 2)
                                    @if($social->title == 'Address')
                                    <a href="https://www.google.com/maps/place/{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}" target="_blank">
                                        {!! ($social->icon ) !!}
                                    </a>
                                    @elseif($social->title == 'Phone')
                                    <a href="tel:{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}" target="_blank">
                                        {!! ($social->icon ) !!}
                                    </a>
                                    @elseif($social->title == 'Email')
                                    <a href="mailto:{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}" target="_blank">
                                        {!! ($social->icon ) !!}
                                    </a>
                                    @else
                                    <a href="{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}" target="_blank">
                                        {!! ($social->icon ) !!}
                                    </a>
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="footer pb-4 text-center">
                                <h2>{{ trans('labels.thank_you') }}</h2>
                                <p>{{$basicinfo->copyright}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src=" {{url('storage/app/public/web-assets/js/jquery.js')}}"></script>
    <script src="{{url('storage/app/public/web-assets/js/bootstrap/bootstrap.bundle.min.js')}} "></script>
    <script src="{{url('storage/app/public/web-assets/js/owl/owl.carousel.min.js')}} "></script>
    <script src="{{url('storage/app/public/web-assets/js/custom.js')}}"></script>
    <script>
        let rtl = {{ $basicinfo->web_layout == 1 ? 'false' : 'true' }};
    </script>
</body>
</html>