@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.edit_plan') }}</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/plans') }}">{{ trans('labels.plans') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form action="{{ URL::to('admin/plans/update-' . $plandata->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.name') }}</label>
                                        <input type="text" class="form-control" name="plan_name"
                                            value="{{ $plandata->name }}" placeholder="{{ trans('labels.name') }}">
                                        @error('plan_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.price') }}</label>
                                        <input type="number" class="form-control" name="plan_price"
                                            value="{{ $plandata->price }}" placeholder="{{ trans('labels.price') }}">
                                        @error('plan_price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.duration') }}</label>
                                        <select class="form-select" name="plan_duration">
                                            <option value="1" {{ $plandata->duration == '1' ? 'selected' : '' }}>
                                                {{ trans('labels.one_month') }}</option>
                                            <option value="2" {{ $plandata->duration == '2' ? 'selected' : '' }}>
                                                {{ trans('labels.three_months') }}</option>
                                            <option value="3" {{ $plandata->duration == '3' ? 'selected' : '' }}>
                                                {{ trans('labels.six_months') }}</option>
                                            <option value="4" {{ $plandata->duration == '4' ? 'selected' : '' }}>
                                                {{ trans('labels.one_year') }}</option>
                                        </select>
                                        @error('plan_duration')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.max_business') }}</label>
                                        <input type="number" class="form-control" name="plan_max_business"
                                            value="{{ $plandata->order_limit }}"
                                            placeholder="{{ trans('labels.max_business') }}">
                                        <small
                                            class="form-text text-danger">{{ trans('labels.note_unlimited_business') }}</small><br>
                                        @error('plan_max_business')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.appointment_limit') }}</label>
                                        <input type="number" class="form-control" name="plan_appointment_limit"
                                            value="{{ $plandata->appointment_limit }}"
                                            placeholder="{{ trans('labels.appointment_limit') }}">
                                        <small
                                            class="form-text text-danger">{{ trans('labels.note_unlimited_business') }}</small><br>
                                        @error('plan_appointment_limit')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.description') }}</label>
                                        <textarea class="form-control" rows="3" name="plan_description" placeholder="{{ trans('labels.description') }}">{{ $plandata->description }}</textarea>
                                        @error('plan_description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label class="form-label">{{ trans('labels.features') }}</label>
                                        <div id="repeater">
                                            @php $features = explode('|', $plandata->features); @endphp
                                            @foreach ($features as $key => $features)
                                                <div class="d-flex mb-2" id="deletediv{{ $key }}">
                                                    <input type="text" class="form-control" name="plan_features[]"
                                                        value="{{ $features }}"
                                                        placeholder="{{ trans('labels.features') }}" required>
                                                    <button type="button"
                                                        class="btn btn-danger mx-2 btn-sm"onclick="deletefeature('{{ $key }}')">
                                                        <i class="fa-regular fa-xmark"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-outline-secondary mx-2 btn-sm"
                                            id="addfeature">
                                            {{ trans('labels.add') }}
                                        </button>
                                        @error('plan_features')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <h5 class="form-label mb-3">{{ trans('labels.select_themes') }}</h5>
                                        @error('themecheckbox')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <ul class="theme-selection">
                                            @php $themes = explode(',', $plandata->themes_id); @endphp
                                            <li>
                                                <input type="checkbox" name="themecheckbox[]" id="theme1" value="1"
                                                    {{ in_array(1, $themes) == '1' ? 'checked' : '' }}>
                                                <label for="theme1">
                                                    <img
                                                        src="{{ url('storage/app/public/admin-assets/images/themes/1.jpg') }}">
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="themecheckbox[]" id="theme2" value="2"
                                                    {{ in_array(2, $themes) == '2' ? 'checked' : '' }}>
                                                <label for="theme2">
                                                    <img
                                                        src="{{ url('storage/app/public/admin-assets/images/themes/2.jpg') }}">
                                                </label>
                                            </li>
                                            @if (App\Models\SystemAddons::where('unique_identifier', 'theme')->first() != null && App\Models\SystemAddons::where('unique_identifier', 'theme')->first()->activated)
                                            <li>
                                                <input type="checkbox" name="themecheckbox[]" id="theme3" value="3"
                                                    {{ is_array(old('themecheckbox')) && in_array(3, old('themecheckbox')) ? 'checked' : '' }}>
                                                <label for="theme3">
                                                    <img src="{{ url('storage/app/public/admin-assets/images/themes/3.jpg') }}">
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="themecheckbox[]" id="theme4"
                                                    value="4"
                                                    {{ is_array(old('themecheckbox')) && in_array(4, old('themecheckbox')) ? 'checked' : '' }}>
                                                <label for="theme4">
                                                    <img src="{{ url('storage/app/public/admin-assets/images/themes/4.jpg') }}">
                                                </label>
                                            </li>
                                            <li>
                                                <input type="checkbox" name="themecheckbox[]" id="theme5"
                                                    value="5"
                                                    {{ is_array(old('themecheckbox')) && in_array(4, old('themecheckbox')) ? 'checked' : '' }}>
                                                <label for="theme5">
                                                    <img src="{{ url('storage/app/public/admin-assets/images/themes/5.jpg') }}">
                                                </label>
                                            </li>
                                            @else
                                            <li>
                                                <input disabled type="checkbox" name="themecheckbox[]" id="theme3" value="3"
                                                    {{ is_array(old('themecheckbox')) && in_array(3, old('themecheckbox')) ? 'checked' : '' }}>
                                                <label for="theme3">
                                                    <img class="filter-blur" src="{{ url('storage/app/public/admin-assets/images/themes/3.jpg') }}">
                                                    <span>This template available on extended license</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input disabled type="checkbox" name="themecheckbox[]" id="theme4"
                                                    value="4"
                                                    {{ is_array(old('themecheckbox')) && in_array(4, old('themecheckbox')) ? 'checked' : '' }}>
                                                <label for="theme4">
                                                    <img class="filter-blur" src="{{ url('storage/app/public/admin-assets/images/themes/4.jpg') }}">
                                                    <span>This template available on extended license</span>
                                                </label>
                                            </li>
                                            <li>
                                                <input disabled type="checkbox" name="themecheckbox[]" id="theme5"
                                                    value="5"
                                                    {{ is_array(old('themecheckbox')) && in_array(4, old('themecheckbox')) ? 'checked' : '' }}>
                                                <label for="theme5">
                                                    <img class="filter-blur" src="{{ url('storage/app/public/admin-assets/images/themes/5.jpg') }}">
                                                    <span>This template available on extended license</span>
                                                </label>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <button class="btn btn-secondary mt-4" @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var i = 1;
        $("#addfeature").on('click', function() {
            "use strict";
            var html =
                '<div class="d-flex mb-2" id="removediv-' + i +
                '"><input type="text" class="form-control" name="plan_features[]" value="{{ old('plan_features[]') }}" placeholder="{{ trans('labels.features') }}" required><button type="button" class="btn btn-danger mx-2 btn-sm" onclick="removefeature(' +
                i + ')"><i class="fa-regular fa-xmark"></i></button></div>';
            $("#repeater").append(html);
            i++;
        })

        function deletefeature(id) {
            "use strict";
            $('#deletediv' + id).remove();
        }

        function removefeature(id) {
            "use strict";
            $('#removediv-' + id).remove();
        }
    </script>
@endsection
