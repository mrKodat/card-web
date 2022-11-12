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
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/owl/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/owl/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ url('storage/app/public/web-assets/css/responsive.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ helper::image_path($basicinfo->favicon) }}">
    <title>{{ $basicinfo->title }}</title>
</head>

<body>
    <style>
        :root {
            --theme-two: {{ $basicinfo->primary_color }};
        }

        .bg-primary {
            background-color: var(--theme-two) !important;
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
                        <div class="theme2-cover">
                           
                            <div class=" profile-sec">
                                @if ($basicinfo->profile_image == '')
                                <img src="{{ helper::image_path('default-profile.jpg') }}" alt="" class="profile-img">
                                @else
                                <img src="{{ helper::image_path($basicinfo->profile_image) }}" class="profile-img">
                                @endif
                                <div class="profile-text">
                                    <h5>{{ $basicinfo->title }} - {{ $basicinfo->designation }} </h5>
                                    <p class="pb-3">{{ $basicinfo->sub_title }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body main2-sec">
                          
                            @if (helper::section_aviable('contact_info', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                            count($contactinfo) > 0)
                            <div class="pt-5">
                                <div class="container">
                                    <div class="row justify-content-center contact2-sec">
                                        <a href="{{ URL::to($basicinfo->slug . '/savecard') }}" class="   col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-contacts.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">Add Contact</p>
                                               
                                            </div>
                                        </a>
                                    @foreach ($contactinfo as $contact)
                                    @if ($contact->type == 1)
                                    @if ($contact->contact_info == url($contact->contact_info))
                                        <a href="{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                            {!! ($contact->icon ) !!}
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Address')
                                        <a href="https://www.google.com/maps/place/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-map.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Whatsapp')
                                        <a href="https://wa.me/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-whatsapp.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                     @elseif($contact->title == 'Website')
                                        <a href="https://{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-website.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                        @elseif($contact->title == 'Tiktok')
                                        <a href="https://tiktok.com/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-tiktok.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Linkdin')
                                        <a href="https://www.linkedin.com/in/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-linkedin.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Facebook')
                                        <a href="https://facebook.com/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-facebook.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Instagram')
                                        <a href="https://instagram.com/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-instagram.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Youtube')
                                        <a href="https://youtube.com/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-youtube.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Twitter')
                                        <a href="https://twitter.com/{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-twitter.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Phone')
                                        <a href="tel:{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-phone.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @elseif($contact->title == 'Email')
                                        <a href="mailto:{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                        <img src="{{ url('storage/app/public/admin-assets/images/icons/icon-mail.png') }}" alt="">
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>
                                    @else
                                        <a href="https://{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }}  col-md-3 text-center contect-box" target="_blank">
                                            {!! ($contact->icon ) !!}
                                            <div class="contact2-text">
                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                               
                                            </div>
                                        </a>                                    
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (helper::section_aviable('business_hours', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                        count($timeinfo) > 0)
                        <div class="business2-sec py-5">
                            <h2 class="business2-text text-center pb-4">{{ trans('labels.business_hours') }}
                            </h2>
                            <div class="working-hours">
                                <ul class="list-group border-0 bg-none">
                                    @foreach ($timeinfo as $time)
                                    <li class="list-group-item d-md-flex border-0">
                                        <div class="col-md-6 d-flex justify-content-center align-itmes-center">
                                            <p class="fw-semibold">
                                                {{ trans('labels.' . strtolower($time->day)) }}
                                            </p>
                                        </div>
                                        @if ($time->is_closed == 1)
                                        <p class=" text-center col-md-6 ">{{ trans('labels.closed') }}
                                        </p>
                                        @elseif($time->is_closed == 2)
                                        <div class="fw-normal col-md-6 d-flex justify-content-md-evenly align-itmes-center business_time">
                                            <h6 class="time2-text">{{ $time->start_time }}</h6>
                                            <span>To</span>
                                            <h6 class="time2-text">{{ $time->end_time }}</h6>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        @if (helper::section_aviable('appointments', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                        count($appointments) > 0)
                        <div class="appointment2-sec pb-5" id="appointment_section">
                            <h2 class="appointment2-text pb-4 text-center">{{ trans('labels.appointments') }}
                            </h2>
                            <div class="p-4 appoiment-form">
                                <form method="POST" action="{{ URL::to($basicinfo->slug . '/store_appointments-'.$basicinfo->vendor_id) }}" class="pt-4">
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
                                        <div class="time-option2">
                                            <label class="appoiment">{{ trans('labels.time') }}:</label>
                                            <div class="row ">
                                                @foreach ($appointments as $appountment)
                                                <label class="form-check-label col-md-4 text-center">
                                                    <input type="radio" class="form-check-input" name="time" value="{{ $appountment->start_time . '-' . $appountment->end_time }}">
                                                    <div class="appo-time2">
                                                        {{ $appountment->start_time }} -
                                                        {{ $appountment->end_time }}
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
                                        <button type="submit" class="btn coman-btn text-white">
                                            <i class="fa-duotone fa-calendar-days"></i>
                                            {{ trans('labels.make_appointment') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @if (helper::section_aviable('services', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($services) > 0)
                        <div class="service2-sec pb-5">
                            <h2 class="service2-text text-center pb-4">{{ trans('labels.services') }}</h2>
                            <div class="owl-carousel carousel_se_02 owl-theme">
                                @foreach ($services as $service)
                                <div class="carousel-item-icon text-center carousel-sec">
                                    <div class="image-hw">
                                        <img src="{{ helper::image_path($service->image) }}">
                                    </div>
                                    <div class="item-cotent2">
                                        <h4 class="item-title">{{ $service->title }}</h4>
                                        <span class="itexm-text">{{ $service->description }}</span>
                                        <a href="{{ $service->purchase_link }} " target="_blank" class="btn coman-btn d-block  mx-auto col-lg-6 col-6 my-4 text-white">
                                            {{ $service->link_title }}
                                            <i class="fa-duotone fa-angles-right"></i>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        <div class="more2-sec pb-5">
                            
                         
                            <a class="btn coman-btn mx-auto d-block col-lg-6 col-sm-6 mb-4 text-white" data-bs-toggle="modal" data-bs-target="#share_card_modal">
                                <i class="fa-duotone fa-share-all"></i>
                                {{ trans('labels.share_card') }}
                            </a>
                            @include('web.share_card_modal')
                        </div>
                        @if (helper::section_aviable('testimonials', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                        count($testimonials) > 0)
                        <div class="testimonial2-sec pb-5">
                            <h2 class="testimonial2-text text-center pb-4">{{ trans('labels.testimonials') }}
                            </h2>
                            <div id="carouselExampleFade" class="carousel-fade" data-bs-ride="carousel" data-bs-intervel="500">
                                <div class="carousel-inner">
                                    @foreach ($testimonials as $key => $testimonial)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="text-center carousel2-sec">
                                            <img src="{{ helper::image_path($testimonial->image) }}">
                                            <p class="itexm-text">{{ $testimonial->review }}</p>
                                            <div class="d-flex justify-content-center">
                                                @for ($s = 1; $s <= 5; $s++) <p class=" {{ $s <= $testimonial->rating ? 'text-warning' : 'text-secondary' }} m-1">
                                                    <i class="fa-solid fa-star"></i>
                                                    </p>
                                                    @endfor
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        @if (helper::section_aviable('social_links', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                        count($socialinfo) > 0)
                        <div class="social2-sec pb-5">
                            <h2 class="social2-text pb-3 text-center">{{ trans('labels.social') }}</h2>
                            <div class="row">
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
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src=" {{ url('storage/app/public/web-assets/js/jquery.js') }}"></script>
    <script src="{{ url('storage/app/public/web-assets/js/bootstrap/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ url('storage/app/public/web-assets/js/owl/owl.carousel.min.js') }} "></script>
    <script src="{{ url('storage/app/public/web-assets/js/custom.js') }}"></script>
    <script>
        let rtl = {{ $basicinfo -> web_layout == 1 ? 'false' : 'true' }};
    </script>
</body>

</html>