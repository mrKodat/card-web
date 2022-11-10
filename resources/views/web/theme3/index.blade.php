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

<body class="main-bg">
    <style>
        :root {
            --theme-three: {{ $basicinfo->primary_color }};
        }

        .bg-primary {
            background-color: var(--theme-three) !important;
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
            <div class="row mb-5">
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
                <div class="col-lg-3 col-md-4 sidebar-sec mb-4">
                    <div class="side-main-box2">
                        <div class="side-bannar">

                            @if ($basicinfo->banner_image == '')
                                <img src="{{ helper::image_path('default-banner.jpg') }}" alt="" class="rounded-4">
                            @else
                                <img src="{{ helper::image_path($basicinfo->banner_image) }}" class="rounded-4">
                            @endif
                        </div>
                        <div class="side-profile">
                            @if ($basicinfo->profile_image == '')
                                <img src="{{ helper::image_path('default-profile.jpg') }}" alt=""
                                    class="side-profile-img rounded-4">
                            @else
                                <img src="{{ helper::image_path($basicinfo->profile_image) }}" alt=""
                                    class="side-profile-img rounded-4">
                            @endif
                        </div>
                        <div class="user-name text-center">
                            <h5>{{ $basicinfo->title }} - {{ $basicinfo->designation }}</h5>
                            <div class="user-bg">{{ $basicinfo->sub_title }}</div>
                            @if (helper::section_aviable('social_links', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                                count($socialinfo) > 0)
                                <div class="side-social-icon">
                                    @foreach ($socialinfo as $social)
                                        @if ($social->type == 2)
                                            @if ($social->title == 'Address')
                                                <a href="https://www.google.com/maps/place/{{ $social->contact_info }}"
                                                    class="{{ helper::get_icon_color($social->title) }}"
                                                    target="_blank">
                                                    {!! $social->icon !!}
                                                </a>
                                            @elseif($social->title == 'Phone')
                                                <a href="tel:{{ $social->contact_info }}"
                                                    class="{{ helper::get_icon_color($social->title) }}"
                                                    target="_blank">
                                                    {!! $social->icon !!}
                                                </a>
                                            @elseif($social->title == 'Email')
                                                <a href="mailto:{{ $social->contact_info }}"
                                                    class="{{ helper::get_icon_color($social->title) }}"
                                                    target="_blank">
                                                    {!! $social->icon !!}
                                                </a>
                                            @else
                                                <a href="{{ $social->contact_info }}"
                                                    class="{{ helper::get_icon_color($social->title) }}"
                                                    target="_blank">
                                                    {!! $social->icon !!}
                                                </a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @if (helper::section_aviable('contact_info', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                            count($contactinfo) > 0)
                            <div class="side-social">
                                <ul class="list">
                                    @foreach ($contactinfo as $contact)
                                        @if ($contact->type == 1)
                                            <li class="list-item mb-4 d-flex">
                                                @if ($contact->contact_info == url($contact->contact_info))
                                                    <a href="{{ $contact->contact_info }}"
                                                        class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                        target="_blank">
                                                        {!! $contact->icon !!}
                                                        <p class="mx-3 text-dark">{{ $contact->title }}</p>
                                                    </a>
                                                @elseif($contact->title == 'Address')
                                                    <a href="https://www.google.com/maps/place/{{ $contact->contact_info }}"
                                                        class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                        target="_blank">
                                                        {!! $contact->icon !!}
                                                        <p class="mx-3 text-dark">{{ $contact->contact_info }}</p>
                                                    </a>
                                                @elseif($contact->title == 'Phone')
                                                    <a href="tel:{{ $contact->contact_info }}"
                                                        class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                        target="_blank">
                                                        {!! $contact->icon !!}
                                                        <p class="mx-3 text-dark">{{ $contact->contact_info }}</p>
                                                    </a>
                                                @elseif($contact->title == 'Email')
                                                    <a href="mailto:{{ $contact->contact_info }}"
                                                        class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                        target="_blank">
                                                        {!! $contact->icon !!}
                                                        <p class="mx-3 text-dark">{{ $contact->contact_info }}</p>
                                                    </a>
                                                @else
                                                    <a href="{{ $contact->contact_info }}"
                                                        class="{{ helper::get_icon_color($contact->title) }} d-flex"
                                                        target="_blank">
                                                        {!! $contact->icon !!}
                                                        <p class="mx-3 text-dark">{{ $contact->contact_info }}</p>
                                                    </a>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <a href="{{ URL::to($basicinfo->slug . '/savecard') }}" class="btn sidebar-btn">
                                    <i class="fa-light fa-download"></i>
                                    {{ trans('labels.save_card') }}
                                </a>
                                <a class="btn sidebar-btn" data-bs-toggle="modal" data-bs-target="#share_card_modal">
                                    <i class="fa-light fa-share-all"></i>
                                    {{ trans('labels.share_card') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="side-main-box">
                        <div class="about2-sec py-4 ">
                            <h2 class="about-title">{{ trans('labels.about_us') }}</h2>
                            <p class="px-2 about-content">{!! clean(nl2br(e($basicinfo->description))) !!}</p>
                        </div>
                        @if (helper::section_aviable('services', $basicinfo->id, $basicinfo->vendor_id) == 1 && count($services) > 0)
                            <div class="doing-sec">
                                <h5 class="main-title">{{ trans('labels.services') }}</h5>
                                <div class="owl-carousel carousel_se_05 owl-theme mt-3">
                                    @foreach ($services as $service)
                                        <div class="carousel-item-icon Service-inner-content">
                                            <div class="design-box">
                                                <div class="image-hw">
                                                    <img src="{{ helper::image_path($service->image) }}">
                                                </div>
                                                <h6 class="fw-bold">{{ $service->title }}</h6>
                                                <p>{{ $service->description }}</p>
                                                <a href="{{ $service->purchase_link }}"
                                                    class="btn d-block col-lg-6 my-4 text-white theme-3-btn"
                                                    target="_blank">
                                                    {{ $service->link_title }}
                                                    <i class="fa-duotone fa-angles-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if (helper::section_aviable('testimonials', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                            count($testimonials) > 0)
                            <div class="testi-sec">
                                <h5 class="main-title">{{ trans('labels.testimonials') }}</h5>
                                <div class="testi-inner">
                                    <div class="owl-carousel carousel_se_04 owl-theme mt-3">
                                        @foreach ($testimonials as $key => $testimonial)
                                            <div class="carousel-item-icon ">
                                                <div class="testi-inner-content">
                                                    <div class="box-shadow">
                                                        <div class="inner-box-shadow">
                                                            <img src="{{ helper::image_path($testimonial->image) }}"
                                                                alt="review" class="mx-4 testi-img">
                                                        </div>
                                                    </div>
                                                    <i class="fa-solid fa-quote-left d-flex justify-content-end"></i>
                                                    <p>{{ $testimonial->review }}</p>
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
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (helper::section_aviable('business_hours', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                            count($timeinfo) > 0)
                            <div class="business2-sec py-4">
                                <h2 class="business3-text main-title pb-4">{{ trans('labels.business_hours') }}</h2>
                                <div class="working-hours">
                                    <ul class="list-group border-0 bg-none">
                                        @foreach ($timeinfo as $time)
                                            <li
                                                class="list-group-item d-flex justify-content-around align-items-baseline border-0 border-0">
                                                <div class="col-6 d-flex justify-content-center">
                                                    <p class="fw-semibold">
                                                        {{ trans('labels.' . strtolower($time->day)) }}</p>
                                                </div>
                                                <div
                                                    class="fw-normal d-flex align-items-baseline justify-content-evenly col-6 time2-text">
                                                    @if ($time->is_closed == 1)
                                                        <p class="col-md-6 text-center m-0">
                                                            {{ trans('labels.closed') }}
                                                        </p>
                                                    @elseif($time->is_closed == 2)
                                                        <p class="m-0">{{ $time->start_time }}</p>
                                                        <span>-</span>
                                                        <p class="m-0">{{ $time->end_time }}</p>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (helper::section_aviable('appointments', $basicinfo->id, $basicinfo->vendor_id) == 1 &&
                            count($appointments) > 0)
                            <div class="appoment3-sec pb-4" id="appointment_section">
                                <h2 class="appoment4-text main-title pb-4">{{ trans('labels.appointments') }}</h2>
                                <form method="POST"
                                    action="{{ URL::to($basicinfo->slug . '/store_appointments-' . $basicinfo->vendor_id) }}">
                                    @csrf
                                    <input type="hidden" value="{{ $basicinfo->id }}" name="business_id">
                                    <div class="row">
                                        <div class="col-sm-6  form-group">
                                            <label class="mx-1 form-label">{{ trans('labels.name') }}:</label>
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
                                            <label class="mx-1 form-label">{{ trans('labels.email') }}:</label>
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
                                                class="mx-1 form-label">{{ trans('labels.mobile') }}:</label>
                                            <input type="text" class="form-control" name="mobile"
                                                value="{{ old('mobile') }}"
                                                placeholder="{{ trans('labels.mobile') }}">
                                            @error('mobile')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6  form-group">
                                            <label class="mx-1 form-label">{{ trans('labels.date') }}:</label>
                                            <input type="date" class="form-control" name="date"
                                                value="{{ old('date') }}" id="date_picker">
                                            @error('date')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="time-option3 form-group">
                                        <label class="form-label">{{ trans('labels.time') }}:</label>
                                        <div class="row">
                                            @foreach ($appointments as $appountment)
                                                <label class="form-check-label col-md-4">
                                                    <input type="radio" class="form-check-input" name="time"
                                                        value="{{ $appountment->start_time . '-' . $appountment->end_time }}">
                                                    <div class="appo-time3">
                                                        {{ $appountment->start_time }} -{{ $appountment->end_time }}
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                    @error('time')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <div class="pt-3">
                                        <button type="submit"
                                            class="btn btn-primary mx-auto d-block text-white coman2-btn border-0">
                                            <i
                                                class="fa-light fa-calendar-days"></i>{{ trans('labels.make_appointment') }}
                                        </button>
                                    </div>
                                </form>
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
    </section>
    @include('web.share_card_modal')
    <script src=" {{ url('storage/app/public/web-assets/js/jquery.js') }}"></script>
    <script src="{{ url('storage/app/public/web-assets/js/bootstrap/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ url('storage/app/public/web-assets/js/owl/owl.carousel.min.js') }} "></script>
    <script src="{{ url('storage/app/public/web-assets/js/custom.js') }}"></script>
    <script>
        let rtl = {{ $basicinfo->web_layout == 1 ? 'false' : 'true' }};
    </script>
</body>

</html>
