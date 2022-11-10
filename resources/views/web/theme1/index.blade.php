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
            --theme-one: {{ $basicinfo->primary_color }};
        }
        .bg-primary {
            background-color: var(--theme-one) !important;
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
                <div class="col-lg-8 col-12">
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
                    <div class="card bg-light border-0 mb-5">
                        <div class="position-relative">
                            @if ($basicinfo->banner_image == '')
                                <img src="{{ helper::image_path('default-banner.jpg') }}" alt="" class="card-img">
                            @else
                                <img src="{{ helper::image_path($basicinfo->banner_image) }}" class="card-img" alt="banner">
                            @endif
                            <div class="{{ $basicinfo->web_layout == 1 ? 'designer-img' : 'rtl-designer-img' }}">
                                @if ($basicinfo->profile_image == '')
                                    <img src="{{ helper::image_path('default-profile.jpg') }}" alt="">
                                @else
                                    <img src="{{ helper::image_path($basicinfo->profile_image) }}" alt="">
                                @endif
                                <div class="design-text mt-5 mx-3">
                                    <h5>{{ $basicinfo->title }} - {{ $basicinfo->designation }} </h5>
                                    <p class="text-muted design-content">{{ $basicinfo->sub_title }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body main-sec">
                            <div class="about-sec py-4">
                                <h2 class="{{ $basicinfo->web_layout == 1 ? 'about-text' : 'rtl-about-text' }}">
                                    {{ trans('labels.about_us') }}</h2>
                                <p class="px-2 about-content">{!! clean(nl2br(e($basicinfo->description)) ) !!}</p>
                            </div>
                            @if (helper::section_aviable('contact_info', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($contactinfo) > 0)
                                <div class="contact-sec p-4 rounded contact_info">
                                    <ul class="list-group list-group-flush">
                                        @foreach ($contactinfo as $contact)
                                            @if ($contact->type == 1)
                                                <li class="list-group-item py-3">
                                                    @if ($contact->contact_info == url($contact->contact_info))
                                                        <a href="{{ $contact->contact_info }}"
                                                            class="{{ helper::get_icon_color($contact->title) }} d-flex align-items-center"
                                                            target="_blank">
                                                            {!! ($contact->icon ) !!}
                                                            <div class="contact-text mx-3">
                                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                                            </div>
                                                        </a>
                                                    @elseif($contact->title == 'Address')
                                                        <a href="https://www.google.com/maps/place/{{ $contact->contact_info }}"
                                                            class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                            target="_blank">
                                                            {!! ($contact->icon ) !!}
                                                            <div class="contact-text mx-3">                                                              
                                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                                                <h6 class="text-dark">{{ $contact->contact_info }}</h6>
                                                            </div>
                                                        </a>
                                                    @elseif($contact->title == 'Phone')
                                                        <a href="tel:{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                            target="_blank">
                                                            {!! ($contact->icon ) !!}
                                                            <div class="contact-text mx-3">                                                              
                                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                                                <h6 class="text-dark">{{ $contact->contact_info }}</h6>
                                                            </div>
                                                        </a>
                                                    @elseif($contact->title == 'Email')
                                                        <a href="mailto:{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                            target="_blank">
                                                            {!! ($contact->icon ) !!}
                                                            <div class="contact-text mx-3">                                                              
                                                                <p class="text-muted mb-1">{{ $contact->title }}</p>
                                                                <h6 class="text-dark">{{ $contact->contact_info }}</h6>
                                                            </div>
                                                        </a>
                                                    @else
                                                    <a href="{{ $contact->contact_info }}" class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                        target="_blank">
                                                        {!! ($contact->icon ) !!}
                                                        <div class="contact-text mx-3">                                                              
                                                            <p class="text-muted mb-1">{{ $contact->title }}</p>
                                                            <h6 class="text-dark">{{ $contact->contact_info }}</h6>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (helper::section_aviable('business_hours', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($timeinfo) > 0)
                                <div class="business-sec py-4">
                                    <h2
                                        class=" {{ $basicinfo->web_layout == 1 ? 'business-text' : 'rtl-business-text' }}">
                                        {{ trans('labels.business_hours') }}</h2>
                                    <div class="working-hours pt-4">
                                        <ul class="list-group border-0 bg-none ">
                                            @foreach ($timeinfo as $time)
                                                <li class="list-group-item d-md-flex border-0 default-color">
                                                    <p class="fw-bold col-md-6 text-center">
                                                        {{ trans('labels.' . strtolower($time->day)) }}</p>
                                                    @if ($time->is_closed == 1)
                                                        <p class="col-md-6 text-center">{{ trans('labels.closed') }}
                                                        </p>
                                                    @elseif($time->is_closed == 2)
                                                        <p class="col-md-6 text-center">{{ $time->start_time }} To
                                                            {{ $time->end_time }}</p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @if (helper::section_aviable('appointments', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($appointments) > 0)
                                <div class="appointment-sec pb-4" id="appointment_section">
                                    <h2
                                        class=" {{ $basicinfo->web_layout == 1 ? 'appointment-text' : 'rtl-appointment-text' }}">
                                        {{ trans('labels.appointments') }}</h2>
                                    <form method="POST" action="{{ URL::to($basicinfo->slug . '/store_appointments-' . $basicinfo->vendor_id) }}" class="pt-4">
                                        @csrf
                                        <input type="hidden" value="{{ $basicinfo->id }}" name="business_id">
                                        <div class="row">
                                            <div class="col-sm-6 form-group">
                                                <label class="form-label">{{ trans('labels.name') }}:</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}"
                                                    placeholder="{{ trans('labels.name') }}">
                                                @error('name')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="form-label">{{ trans('labels.email') }}:</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}"
                                                    placeholder="{{ trans('labels.email') }}">
                                                @error('email')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label name="mobile"
                                                    class="form-label">{{ trans('labels.mobile') }}:</label>
                                                <input type="text" class="form-control" name="mobile"
                                                    value="{{ old('mobile') }}"
                                                    placeholder="{{ trans('labels.mobile') }}">
                                                @error('mobile')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label class="form-label">{{ trans('labels.date') }}:</label>
                                                <input type="date" class="form-control" name="date"
                                                    value="{{ old('date') }}" id="date_picker">
                                                @error('date')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="time-option">
                                                <label
                                                    class="appoiment form-label">{{ trans('labels.time') }}:</label>
                                                <div class="row">
                                                    @foreach ($appointments as $appountment)
                                                        <label class="form-check-label col-md-4">
                                                            <input type="radio" class="form-check-input"
                                                                name="time"
                                                                value="{{ $appountment->start_time . '-' . $appountment->end_time }} ">
                                                            <div class="appo-time">
                                                                {{ $appountment->start_time }}
                                                                -{{ $appountment->end_time }}
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
                                        <div class="pt-3">
                                            <button type="submit"
                                                class="btn btn-primary mx-auto d-block col-md-6 text-white theme-1-btn">
                                                <i
                                                    class="fa-light fa-calendar-days"></i>{{ trans('labels.make_appointment') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                            @if (helper::section_aviable('services', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($services) > 0)
                                <div class="service-sec pb-4">
                                    <h2
                                        class=" {{ $basicinfo->web_layout == 1 ? 'service-text' : 'rtl-service-text' }}">
                                        {{ trans('labels.services') }}</h2>
                                    <div class="owl-carousel carousel_se_01 owl-theme mt-5">
                                        @foreach ($services as $service)
                                            <div class="carousel-item-icon text-center h-100">
                                                <div class="image-hw">
                                                    <img src="{{ helper::image_path($service->image) }}">
                                                </div>
                                                <div class="item-cotent">
                                                    <h4 class="item-title">{{ $service->title }}</h4>
                                                    <span class="itexm-text">{{ $service->description }}</span>
                                                    <a href="{{ $service->purchase_link }}"class="btn btn-primary d-block  mx-auto col-lg-6 col-6 my-4 text-white theme-1-btn" target="_blank">
                                                        {{ $service->link_title }}
                                                        <i class="fa-light fa-chevrons-right mx-1"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="more-sec pb-4">
                                <h2 class=" mb-3 {{ $basicinfo->web_layout == 1 ? 'more-text' : 'rtl-more-text' }}">
                                    {{ trans('labels.more') }}</h2>
                                <a href="{{ URL::to($basicinfo->slug . '/savecard') }}"
                                    class="btn btn-primary mx-auto d-block col-lg-6 col-sm-6 mb-4 text-white theme-1-btn">
                                    <i class="fa-light fa-arrow-down-to-bracket"></i>
                                    {{ trans('labels.save_card') }}
                                </a>
                                <a type="button"
                                    class="btn mx-auto d-block col-lg-6 col-sm-6 mb-4 text-white theme-1-btn"
                                    data-bs-toggle="modal" data-bs-target="#share_card_modal">
                                    <i class="fa-light fa-share-nodes"></i>
                                    {{ trans('labels.share_card') }}
                                </a>
                                @include('web.share_card_modal')
                            </div>
                            @if (helper::section_aviable('testimonials', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($testimonials) > 0)
                                <div class="testimonials-sec pb-4">
                                    <h2
                                        class=" mb-3  {{ $basicinfo->web_layout == 1 ? 'testimonials-text' : 'rtl-testimonials-text' }}">
                                        {{ trans('labels.testimonials') }}</h2>
                                    <div class="row">
                                        <div id="carousel" class="carousel-fade" data-bs-ride="carousel"
                                            data-bs-intervel="500">
                                            <div class="carousel-inner">
                                                @foreach ($testimonials as $key => $testimonial)
                                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                        <div class="review">
                                                            <i class="fa-solid fa-quote-left"></i>
                                                            <div class="review-body ">
                                                                <p class="review-text mt-2">{{ $testimonial->review }}
                                                                </p>
                                                                <div class="review-img ">
                                                                    <img src="{{ helper::image_path($testimonial->image) }}"
                                                                        alt="review" class="mx-4">
                                                                    <div class="d-flex justify-content-center">
                                                                        @for ($s = 1; $s <= 5; $s++)
                                                                            <p
                                                                                class=" {{ $s <= $testimonial->rating ? 'text-warning' : 'text-secondary' }} m-1">
                                                                                <i class="fa-solid fa-star"></i>
                                                                            </p>
                                                                        @endfor
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (helper::section_aviable('social_links', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($socialinfo) > 0)
                                <div class="social-sec1 pb-4">
                                    <h2
                                        class=" mb-3 {{ $basicinfo->web_layout == 1 ? 'social-text' : 'rtl-social-text' }}">
                                        {{ trans('labels.social') }}</h2>
                                    <div class="row">
                                        <div class="social-icon text-center">
                                            @foreach ($socialinfo as $social)
                                                @if ($social->type == 2)
                                                    @if($social->title == 'Address')
                                                    <a href="https://www.google.com/maps/place/{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}"
                                                        target="_blank">
                                                        {!! ($social->icon ) !!}
                                                    </a>
                                                    @elseif($social->title == 'Phone')
                                                    <a href="tel:{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}"
                                                        target="_blank">
                                                        {!! ($social->icon ) !!}
                                                    </a>
                                                    @elseif($social->title == 'Email')
                                                    <a href="mailto:{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}"
                                                        target="_blank">
                                                        {!! ($social->icon ) !!}
                                                    </a>
                                                    @else
                                                    <a href="{{ $social->contact_info }}" class="{{ helper::get_icon_color($social->title) }}"
                                                        target="_blank">
                                                        {!! ($social->icon ) !!}
                                                    </a>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="footer pb-4 text-center">
                                <h2>{{ trans('labels.thank_you') }}</h2>
                                <p>{{ $basicinfo->copyright }}</p>
                            </div>
                        </div>
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
        let rtl = {{ $basicinfo->web_layout == 1 ? 'false' : 'true' }};
    </script>
</body>
</html>
