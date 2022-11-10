@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/timepicker/jquery.timepicker.min.css') }}">
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row settings">
                <div class="col-xl-3 mb-3">
                    <div class="card card-sticky-top border-0">
                        <ul class="list-group list-options">
                            <a href="#basic_info" data-tab="basic_info"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center active"
                                aria-current="true">{{ trans('labels.basic_info') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#contact_info" data-tab="contact_info"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.contact_info') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#business_hours" data-tab="business_hours"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.business_hours') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#appointments" data-tab="appointments"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.appointments') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#services" data-tab="services"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.services') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#testimonials" data-tab="testimonials"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.testimonials') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#social_links" data-tab="social_links"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.social_links') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#reorder_section" data-tab="reorder_section"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.reorder_section') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#seo" data-tab="seo"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.seo') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="basic_info">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <h5 class="text-uppercase">{{ trans('labels.basic_info') }}</h5>
                                        </div>
                                        <form
                                            action="{{ URL::to('admin/business/store_basic_info-' . $businessdata->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group">
                                                    @error('themecheckbox')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <ul class="theme-selection">
                                                        @if (in_array(1, $themescount))
                                                            <li>
                                                                <input type="radio" name="themecheckbox" id="theme1"
                                                                    value="1"
                                                                    {{ $businessdata->themes_id == '1' ? 'checked' : '' }}>
                                                                <label for="theme1"> <img
                                                                        src="{{ url('storage/app/public/admin-assets/images/themes/1.jpg') }}">
                                                                </label>
                                                            </li>
                                                        @endif
                                                        @if (in_array(2, $themescount))
                                                            <li>
                                                                <input type="radio" name="themecheckbox" id="theme2"
                                                                    value="2"
                                                                    {{ $businessdata->themes_id == '2' ? 'checked' : '' }}>
                                                                <label for="theme2"> <img
                                                                        src="{{ url('storage/app/public/admin-assets/images/themes/2.jpg') }}">
                                                                </label>
                                                            </li>
                                                        @endif
                                                        @if (in_array(3, $themescount))
                                                            <li>
                                                                <input type="radio" name="themecheckbox" id="theme3"
                                                                    value="3"
                                                                    {{ $businessdata->themes_id == '3' ? 'checked' : '' }}>
                                                                <label for="theme3"> <img
                                                                        src="{{ url('storage/app/public/admin-assets/images/themes/3.jpg') }}">
                                                                </label>
                                                            </li>
                                                        @endif
                                                        @if (in_array(4, $themescount))
                                                            <li>
                                                                <input type="radio" name="themecheckbox" id="theme4"
                                                                    value="4"
                                                                    {{ $businessdata->themes_id == '4' ? 'checked' : '' }}>
                                                                <label for="theme4"> <img
                                                                        src="{{ url('storage/app/public/admin-assets/images/themes/4.jpg') }}">
                                                                </label>
                                                            </li>
                                                        @endif
                                                        @if (in_array(5, $themescount))
                                                            <li>
                                                                <input type="radio" name="themecheckbox" id="theme5"
                                                                    value="5"
                                                                    {{ $businessdata->themes_id == '5' ? 'checked' : '' }}>
                                                                <label for="theme5"> <img
                                                                        src="{{ url('storage/app/public/admin-assets/images/themes/5.jpg') }}">
                                                                </label>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="form-label">{{ trans('labels.title') }}</label>
                                                    <input type="text" class="form-control" name="title"
                                                        value="{{ $businessdata->title }}"
                                                        placeholder="{{ trans('labels.title') }}">
                                                    @error('title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="form-label">{{ trans('labels.sub_title') }}</label>
                                                    <input type="text" class="form-control" name="sub_title"
                                                        value="{{ $businessdata->sub_title }}"
                                                        placeholder="{{ trans('labels.sub_title') }}">
                                                    @error('sub_title')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <label class="form-label">{{ trans('labels.designation') }}</label>
                                                    <input type="text" class="form-control" name="designation"
                                                        value="{{ $businessdata->designation }}"
                                                        placeholder="{{ trans('labels.designation') }}">
                                                    @error('designation')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p class="form-label">{{ trans('labels.web_layout') }}</p>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input form-check-input-secondary"
                                                                    type="radio" name="web_layout" value="1"
                                                                    {{ @$businessdata->web_layout == 1 ? 'checked' : '' }}>
                                                                <label
                                                                    class="form-check-label">{{ trans('labels.ltr') }}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input form-check-input-secondary"
                                                                    type="radio" name="web_layout" value="2"
                                                                    {{ @$businessdata->web_layout == 2 ? 'checked' : '' }}>
                                                                <label
                                                                    class="form-check-label">{{ trans('labels.rtl') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="primary_color"
                                                                class="form-label">{{ trans('labels.primary_color') }}</label>
                                                            <input type="color"
                                                                class="form-control form-control-color w-100 border-0"
                                                                name="primary_color" id="primary_color"
                                                                value="{{ $businessdata->primary_color }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        class="form-label">{{ trans('labels.personalized_link') }}</label>
                                                    <div class="input-group">
                                                        <div class="input-group-append overflow-auto">
                                                            <span class="input-group-text">{{ url('/') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control"
                                                            name="personalized_link" value="{{ $businessdata->slug }}"
                                                            placeholder="{{ trans('labels.personalized_link') }}">
                                                    </div>
                                                    @error('personalized_link')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">{{ trans('labels.copyright') }}</label>
                                                    <input type="text" class="form-control" name="copyright"
                                                        value="{{ $businessdata->copyright }}"
                                                        placeholder="{{ trans('labels.copyright') }}">
                                                    @error('copyright')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class=" form-group">
                                                    <label class="form-label">{{ trans('labels.description') }}</label>
                                                    <textarea class="form-control" rows="3" name="description" placeholder="{{ trans('labels.description') }}">{{ $businessdata->description }}</textarea>
                                                    @error('description')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="profileupload"
                                                            class="form-label">{{ trans('labels.profile') }}</label>
                                                        <input type="file" name="profile" class="form-control"
                                                            id="profileupload">
                                                        @if (!empty($businessdata->profile_image))
                                                            <img src="{{ helper::image_path($businessdata->profile_image) }}"
                                                                alt="" width="80" height="80"
                                                                class="rounded mx-2" id="profile_show">
                                                        @endif
                                                        <div id="profilepreview" class="mx-2">
                                                            <img src="" alt="" id="profile_imgupload"
                                                                width="80" height="80" class="rounded">
                                                        </div>
                                                    </div>
                                                    @error('profile')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-group col-md-4">
                                                        <label for="bannerupload"
                                                            class="form-label">{{ trans('labels.banner') }}</label>
                                                        <input type="file" name="banner" class="form-control"
                                                            id="bannerupload">
                                                        @if (!empty($businessdata->banner_image))
                                                            <img src="{{ helper::image_path($businessdata->banner_image) }}"
                                                                alt="" width="150" height="80"
                                                                class="rounded mx-2" id="banner_show">
                                                        @endif
                                                        <div id="bannerpreview" class="mx-2">
                                                            <img src="" alt="" id="banner_imgupload"
                                                                width="150" height="80" class="rounded">
                                                        </div>
                                                    </div>
                                                    @error('banner')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                    <div class="form-group col-md-4">
                                                        <label for="faviconupload"
                                                            class="form-label">{{ trans('labels.favicon') }}</label>
                                                        <input type="file" name="favicon" class="form-control"
                                                            id="faviconupload">
                                                        @if (!empty($businessdata->favicon))
                                                            <img src="{{ helper::image_path($businessdata->favicon) }}"
                                                                alt="" width="80" height="80"
                                                                class="rounded mx-2" id="favicon_show">
                                                        @endif
                                                        <div id="faviconpreview" class="mx-2">
                                                            <img src="" alt="" id="favicon_imgupload"
                                                                width="80" height="80" class="rounded">
                                                        </div>
                                                    </div>
                                                    @error('favicon')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contact_info">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <form
                                            action="{{ URL::to('admin/business/store_contact_info-' . $businessdata->id) }}"
                                            method="POST">
                                            @csrf
                                            <div
                                                class="d-flex justify-content-between align-items-center {{ count($contact_info_data) > 0 ? 'mb-3' : '' }}">
                                                <h5 class="text-uppercase">{{ trans('labels.contact_info') }}</h5>
                                                <div class="d-flex">
                                                    <div class="mx-2">
                                                        <input type="hidden" name="contact_info_id"
                                                            value="{{ $contact_info_section->id }}">
                                                        <input id="checkbox-switch{{ $contact_info_section->id }}"
                                                            type="checkbox" class="checkbox-switch"
                                                            name="contact_info_section" value="1"
                                                            {{ $contact_info_section->is_available == 1 ? 'checked' : '' }}>
                                                        <label for="checkbox-switch{{ $contact_info_section->id }}"
                                                            class="switch">
                                                            <span class="switch__circle">
                                                                <span class="switch__circle-inner"></span>
                                                            </span>
                                                            <span
                                                                class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                            <span
                                                                class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#contactinfo">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="contact_info_card"
                                                class="{{ count($contact_info_data) > 0 ? '' : 'dn' }}">
                                                <div id="contact_info_repeater" class="row">
                                                    @foreach ($contact_info_data as $contact_info)
                                                        <div class="col-sm-6 form-group">
                                                            <div class="d-flex mb-2">
                                                                <div class="input-group">
                                                                    <span
                                                                        class="input-group-text">{!! $contact_info->icon !!}</span>
                                                                    <input type="text" class="form-control"
                                                                        name="edit_contact_info[]"
                                                                        value=" {{ $contact_info->contact_info }} "
                                                                        required>
                                                                    <a href="{{ URL::to('admin/business/delete_contact_field-' . $contact_info->id) }}"
                                                                        class="input-group-text bg-danger text-white border-0 cursor-pointer">
                                                                        <i class='fa-regular fa-trash'></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="edit_contact_info_id[]"
                                                                value="{{ $contact_info->id }}">
                                                            <input type="hidden" class="form-control" name="edit_icon[]"
                                                                value="{{ $contact_info->icon }}">
                                                            <input type="hidden" class="form-control"
                                                                name="edit_title[]" value="{{ $contact_info->title }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="business_hours">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <form action="{{ URL::to('admin/business/store_business_hours') }}"
                                            method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="text-uppercase">{{ trans('labels.business_hours') }}</h5>
                                                <div class="mx-2">
                                                    <input type="hidden" name="business_hours_section_id"
                                                        value="{{ $business_hours_section->id }}">
                                                    <input id="checkbox-switch{{ $business_hours_section->id }}"
                                                        type="checkbox" class="checkbox-switch"
                                                        name="business_hours_section" value="1"
                                                        {{ $business_hours_section->is_available == '1' ? 'checked' : '' }}>
                                                    <label for="checkbox-switch{{ $business_hours_section->id }}"
                                                        class="switch">
                                                        <span class="switch__circle">
                                                            <span class="switch__circle-inner"></span>
                                                        </span>
                                                        <span class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                        <span class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                            @error('day')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div class="d-flex bg-light mb-3 p-2 rounded">
                                                <div class="col-sm-2">
                                                    <small>{{ trans('labels.day') }}</small>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <small>{{ trans('labels.start_time') }}</small>
                                                        </div>
                                                        <div class="col-6">
                                                            <small>{{ trans('labels.end_time') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <small>{{ trans('labels.closed') }}</small>
                                                </div>
                                            </div>
                                            @foreach ($timingsdata as $time)
                                                <div class="row mb-3 px-2">
                                                    <div class="col-sm-2 mb-2">
                                                        @if (strtolower($time->day) == 'monday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.monday') }}</label>
                                                        @endif
                                                        @if (strtolower($time->day) == 'tuesday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.tuesday') }}</label>
                                                        @endif
                                                        @if (strtolower($time->day) == 'wednesday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.wednesday') }}</label>
                                                        @endif
                                                        @if (strtolower($time->day) == 'thursday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.thursday') }}</label>
                                                        @endif
                                                        @if (strtolower($time->day) == 'friday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.friday') }}</label>
                                                        @endif
                                                        @if (strtolower($time->day) == 'saturday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.saturday') }}</label>
                                                        @endif
                                                        @if (strtolower($time->day) == 'sunday')
                                                            <label class="form-check-label"
                                                                for="{{ strtolower($time->day) }}">{{ trans('labels.sunday') }}</label>
                                                        @endif
                                                        <input type="hidden" name="day[]"
                                                            value="{{ strtolower($time->day) }}">
                                                    </div>
                                                    <div class="col-sm-8 mb-2">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="text" autocomplete="off"
                                                                    class="form-control time_picker" name="start_time[]"
                                                                    value="{{ $time->start_time }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" autocomplete="off"
                                                                    class="form-control time_picker" name="end_time[]"
                                                                    value="{{ $time->end_time }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-sm-2 mb-2">
                                                        <select name="closed[]" class="form-select">
                                                            <option value="1"
                                                                {{ $time->is_closed == '1' ? 'selected' : '' }}>
                                                                {{ trans('labels.yes') }}
                                                            </option>
                                                            <option value="2"
                                                                {{ $time->is_closed == '2' ? 'selected' : '' }}>
                                                                {{ trans('labels.no') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <input type="hidden" name="business_id" value="{{ $businessdata->id }}">
                                            <button type="submit"
                                                class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="appointments">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <form
                                            action="{{ URL::to('admin/business/store_appointments_slot-' . $businessdata->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-uppercase">{{ trans('labels.appointments_slots') }}</h5>
                                                <div class="d-flex">
                                                    <div class="mx-2">
                                                        <input type="hidden" name="appointments_section_id"
                                                            value="{{ $appointments_section->id }}">
                                                        <input id="checkbox-switch{{ $appointments_section->id }}"
                                                            type="checkbox" class="checkbox-switch"
                                                            name="appointments_section" value="1"
                                                            {{ $appointments_section->is_available == '1' ? 'checked' : '' }}>
                                                        <label for="checkbox-switch{{ $appointments_section->id }}"
                                                            class="switch">
                                                            <span class="switch__circle">
                                                                <span class="switch__circle-inner"></span>
                                                            </span>
                                                            <span
                                                                class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                            <span
                                                                class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        id="addappointments">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="appointments_info"
                                                class="my-3 {{ count($appontment_slots) > 0 ? '' : 'dn' }}">
                                                <div class="d-flex bg-light mb-3 p-2 rounded">
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <small>{{ trans('labels.start_time') }}</small>
                                                            </div>
                                                            <div class="col-6">
                                                                <small>{{ trans('labels.end_time') }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <small>{{ trans('labels.action') }}</small>
                                                    </div>
                                                </div>
                                                <div id="appointment_repeater">
                                                    @foreach ($appontment_slots as $time)
                                                        <div class="row mb-3 px-2">
                                                            <div class="col-10">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <input type="text"
                                                                            class="form-control time_picker"
                                                                            name="edit_start_time[]"
                                                                            value="{{ $time->start_time }}">
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="text"
                                                                            class="form-control time_picker"
                                                                            name="edit_end_time[]"
                                                                            value="{{ $time->end_time }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <a href="{{ URL::to('admin/business/delete_appointments_slot-' . $time->id) }}"
                                                                    class="btn btn-danger">
                                                                    <i class="fa-light fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="services">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <form
                                            action="{{ URL::to('admin/business/store_services-' . $businessdata->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-uppercase">{{ trans('labels.services') }}</h5>
                                                <div class="d-flex">
                                                    <div class="mx-2">
                                                        <input type="hidden" name="services_section_id"
                                                            value="{{ $services_section->id }}">
                                                        <input id="checkbox-switch{{ $services_section->id }}"
                                                            type="checkbox" class="checkbox-switch"
                                                            name="services_section" value="1"
                                                            {{ $services_section->is_available == '1' ? 'checked' : '' }}>
                                                        <label for="checkbox-switch{{ $services_section->id }}"
                                                            class="switch">
                                                            <span class="switch__circle">
                                                                <span class="switch__circle-inner"></span>
                                                            </span>
                                                            <span
                                                                class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                            <span
                                                                class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        id="addservices"
                                                        data-url="{{ helper::image_path('no-data.png') }}">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="services_card"
                                                class="mt-3 {{ count($service_cards) > 0 ? '' : 'dn' }}">
                                                <div class="row">
                                                    <div id="service_repeater" class="d-content row"></div>
                                                    @foreach ($service_cards as $card)
                                                        <div class="col-sm-6 col-md-4 mb-3">
                                                            <div class="card border-0 box-shadow h-100">
                                                                <img src="{{ helper::image_path($card->image) }}"
                                                                    class="card-img-top object-fit-contain" height="200"
                                                                    alt="">
                                                                <div class="img-overlay">
                                                                    <label for="edit_service_img{{ $card->id }}"
                                                                        class="btn btn-info btn-sm">
                                                                        <i class="fa-light fa-pen"></i>
                                                                    </label>
                                                                    <a href="{{ URL::to('admin/business/delete_services-' . $card->id) }}"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fa-light fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="hidden" name="edit_services_id[]"
                                                                        value="{{ $card->id }}">
                                                                    <input type="file" class="d-none"
                                                                        id="edit_service_img{{ $card->id }}"
                                                                        name="edit_service_img[]">
                                                                    <input type="text" class="form-control mb-2"
                                                                        name="edit_services_title[]"
                                                                        value="{{ $card->title }}" required>
                                                                    <input type="text" class="form-control mb-2"
                                                                        name="edit_description[]"
                                                                        value="{{ $card->description }}" required>
                                                                    <input type="text" class="form-control mb-2"
                                                                        name="edit_purchase_link[]"
                                                                        value="{{ $card->purchase_link }}" required>
                                                                    <input type="text" class="form-control mb-2"
                                                                        name="edit_link_title[]"
                                                                        value="{{ $card->link_title }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-secondary w-auto">{{ trans('labels.save_changes') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="testimonials">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <form
                                            action="{{ URL::to('admin/business/store_testimonials-' . $businessdata->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="text-uppercase">{{ trans('labels.testimonials') }}</h5>
                                                <div class="d-flex">
                                                    <div class="mx-2">
                                                        <input type="hidden" name="testimonials_section_id"
                                                            value="{{ $testimonials_section->id }}">
                                                        <input id="checkbox-switch{{ $testimonials_section->id }}"
                                                            type="checkbox" class="checkbox-switch"
                                                            name="testimonials_section" value="1"
                                                            {{ $testimonials_section->is_available == '1' ? 'checked' : '' }}>
                                                        <label for="checkbox-switch{{ $testimonials_section->id }}"
                                                            class="switch">
                                                            <span class="switch__circle">
                                                                <span class="switch__circle-inner"></span>
                                                            </span>
                                                            <span
                                                                class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                            <span
                                                                class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        id="addtestimonials">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="testimonials_info"
                                                class="mt-3 row {{ count($testimonials) > 0 ? '' : 'dn' }}">
                                                <div class="row">
                                                    <div id="testimonial_repeater" class="d-content row"></div>
                                                    @foreach ($testimonials as $data)
                                                        <div class="col-sm-4 mb-3">
                                                            <div class="card border-0 box-shadow h-100">
                                                                <img src="{{ helper::image_path($data->image) }}"
                                                                    class="card-img-top object-fit-contain" height="200"
                                                                    alt="">
                                                                <div class="img-overlay">
                                                                    <label for="edit_testimonial_img{{ $data->id }}"
                                                                        class="btn btn-info btn-sm">
                                                                        <i class="fa-light fa-pen"></i>
                                                                    </label>
                                                                    <a href="{{ URL::to('admin/business/delete_testimonials-' . $data->id) }}"
                                                                        class="btn btn-danger btn-sm">
                                                                        <i class="fa-light fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="card-body mt-4">
                                                                    <select name="edit_rating[]"
                                                                        class="form-select text-warning mb-2">
                                                                        <option class="text-warning" value="5"
                                                                            {{ $data->rating == '5' ? 'selected' : '' }}>
                                                                            ★★★★★
                                                                        </option>
                                                                        <option class="text-warning" value="4"
                                                                            {{ $data->rating == '4' ? 'selected' : '' }}>
                                                                            ★★★★
                                                                        </option>
                                                                        <option class="text-warning" value="3"
                                                                            {{ $data->rating == '3' ? 'selected' : '' }}>
                                                                            ★★★
                                                                        </option>
                                                                        <option class="text-warning" value="2"
                                                                            {{ $data->rating == '2' ? 'selected' : '' }}>
                                                                            ★★
                                                                        </option>
                                                                        <option class="text-warning" value="1"
                                                                            {{ $data->rating == '1' ? 'selected' : '' }}>★
                                                                        </option>
                                                                    </select>
                                                                    <input type="hidden" name="edit_testimonial_id[]"
                                                                        value="{{ $data->id }}">
                                                                    <input type="file" class="d-none"
                                                                        id="edit_testimonial_img{{ $data->id }}"
                                                                        name="edit_testimonial_img[]">
                                                                    <input type="text" class="form-control mb-2"
                                                                        name="edit_review[]"
                                                                        value="{{ $data->review }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-secondary w-auto mx-3">{{ trans('labels.save_changes') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="social_links">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <form
                                            action="{{ URL::to('admin/business/store_social_links-' . $businessdata->id) }}"
                                            method="POST">
                                            @csrf
                                            <div
                                                class="d-flex justify-content-between align-items-center {{ count($social_link_data) > 0 ? 'mb-3' : '' }}">
                                                <h5 class="text-uppercase">{{ trans('labels.social_links') }}</h5>
                                                <div class="d-flex">
                                                    <div class="mx-2">
                                                        <input type="hidden" name="social_links_section_id"
                                                            value="{{ $social_links_section->id }}">
                                                        <input id="checkbox-switch{{ $social_links_section->id }}"
                                                            type="checkbox" class="checkbox-switch"
                                                            name="social_links_section" value="1"
                                                            {{ $social_links_section->is_available == '1' ? 'checked' : '' }}>
                                                        <label for="checkbox-switch{{ $social_links_section->id }}"
                                                            class="switch">
                                                            <span class="switch__circle">
                                                                <span class="switch__circle-inner"></span>
                                                            </span>
                                                            <span
                                                                class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                            <span
                                                                class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                        </label>
                                                    </div>
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#sociallinks">
                                                        <i class="fa-regular fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="social_links_info"
                                                class="{{ count($social_link_data) > 0 ? '' : 'dn' }}">
                                                <div id="social_links_repeater" class="row">
                                                    @foreach ($social_link_data as $social_link)
                                                        <div class="col-sm-6 form-group ">
                                                            <div class="d-flex mb-2">
                                                                <div class="input-group">
                                                                    <span
                                                                        class="input-group-text">{!! $social_link->icon !!}</span>
                                                                    <input type="text" class="form-control"
                                                                        name="edit_social_info[]"
                                                                        value=" {{ $social_link->contact_info }} "
                                                                        required>
                                                                    <a href="{{ URL::to('admin/business/delete_contact_field-' . $social_link->id) }}"
                                                                        class="input-group-text bg-danger text-white border-0 cursor-pointer">
                                                                        <i class='fa-regular fa-trash'></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="edit_social_info_id[]"
                                                                value="{{ $social_link->id }}">
                                                            <input type="hidden" class="form-control" name="edit_icon[]"
                                                                value="{{ $social_link->icon }}">
                                                            <input type="hidden" class="form-control"
                                                                name="edit_title[]" value="{{ $social_link->title }}">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="reorder_section">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="text-uppercase">{{ trans('labels.reorder_section') }}</h5>
                                        </div>
                                        <form
                                            action="{{ URL::to('admin/business/store_reorder_section-' . $businessdata->id) }}"
                                            method="POST">
                                            @csrf
                                            <ul class="list-group mb-3" id="sortable">
                                                @foreach ($reorder_section as $data)
                                                    <input type="hidden" name="old_position[]"
                                                        value="{{ $data->id }}">
                                                    <li class="list-group-item py-3">
                                                        <input type="hidden" name="position[]"
                                                            value="{{ $data->position }}">
                                                        <input type="hidden" name="name[]"
                                                            value="{{ $data->name }}">
                                                        {{ trans('labels.' . $data->name) }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <button type="submit"
                                                class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="seo">
                        <div class="row mb-5">
                            <div class="col-12">
                                <div class="card border-0 box-shadow">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="text-uppercase">{{ trans('labels.seo') }}</h5>
                                        </div>
                                        <form action="{{ URL::to('admin/business/store_seo-' . $businessdata->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-label">{{ trans('labels.meta_title') }}</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $businessdata->meta_title }}" name="meta_title"
                                                    placeholder="{{ trans('labels.meta_title') }}">
                                                @error('meta_title')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-label">{{ trans('labels.meta_description') }}</label>
                                                <textarea class="form-control" name="meta_description" rows="3"
                                                    placeholder="{{ trans('labels.meta_description') }}">{{ $businessdata->meta_description }}</textarea>
                                                @error('meta_description')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="file" id="og_imageupload" class="d-none"
                                                    name="og_image">
                                                <label for="og_imageupload"
                                                    class="btn btn-primary col-md-6 mb-2 w-auto h-fit-content">
                                                    {{ trans('labels.og_image') }}
                                                </label>
                                                @if (!empty($businessdata->og_image))
                                                    <img src="{{ helper::image_path($businessdata->og_image) }}"
                                                        alt="" width="150" height="80"
                                                        class="rounded mx-2" id="og_image_show">
                                                @endif
                                                <div id="og_imagepreview" class="mx-2">
                                                    <img src="" alt="" id="og_image_imgupload"
                                                        width="150" height="80" class="rounded">
                                                </div>
                                                @error('og_image')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                class="btn btn-secondary">{{ trans('labels.save_changes') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $client = new \GuzzleHttp\Client();
        $res = $client->get(url('storage/app/public/admin-assets/js/contact_fields.json'));
        $cnt_data = json_encode(json_decode((string) $res->getBody()));
        if (!empty(json_decode($cnt_data, true))) {
            foreach (json_decode($cnt_data, true) as $key => $value) {
                $contact_json_data = $value;
            }
        }else {
            $contact_json_data = array();
        }
    @endphp
    <!-- Contact Information Option Modal -->
    <div class="modal fade" id="contactinfo" tabindex="-1" aria-labelledby="contactinfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactinfoLabel">{{ trans('labels.add_fields') }}</h5>
                    <button type="button" mod class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-info-modal">
                        @foreach ($contact_json_data as $key => $value)
                            <a class="contact-info-item" onclick="add_contact_field(this)" data-name='{{ $value['title'] }}' data-icon="{{ $value['icon'] }}">
                                {!! $value['icon'] !!}
                                <span>{{ $value['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Social Links Option Modal -->
    <div class="modal fade" id="sociallinks" tabindex="-1" aria-labelledby="sociallinksLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sociallinksLabel">{{ trans('labels.add_fields') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="contact-info-modal">
                        @foreach ($contact_json_data as $key => $value)
                            <a class="contact-info-item" onclick="add_sociallinks(this)" data-name='{{ $value['title'] }}' data-icon="{{ $value['icon'] }}">
                                {!! $value['icon'] !!}
                                <span>{{ $value['title'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin-assets/js/jquery/jquery_ui.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/timepicker/jquery.timepicker.min.js') }}" defer></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/basic_info_section.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/contact_info_field_section.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/add_appointment_slots_section.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/add_service_card_section.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/add_testimonial_card_section.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/social_link_field_section.js') }}"></script>
    <script src="{{ url('storage/app/public/admin-assets/js/custom/seo_section.js') }}"></script>
    <script>
        let i = 1;
        let different_option = "{{ trans('messages.different_option') }}";
        let services_title = "{{ trans('labels.services_title') }}";
        let description = "{{ trans('labels.description') }}";
        let purchase_link = "{{ trans('labels.purchase_link') }}";
        let link_title = "{{ trans('labels.link_title') }}";
        let review = "{{ trans('labels.review') }}";
        // Section Scroll JS
        $('.basicinfo').on('click', function() {
            "use strict";
            if ($(this).attr('data-tab') == 'basic_info') {
                $('html, body').animate({
                    scrollTop: 0
                }, '1000');
            }
            $('.list-options').find('.active').removeClass('active');
            $(this).addClass('active');
        });
        // Reorder Section JS
        $(function() {
            "use strict";
            $("#sortable").sortable();
        });

        // Timepicker
        $(document).ready(function() {
            "use strict";
            $(".time_picker").timepicker();
        });
    </script>
@endsection
