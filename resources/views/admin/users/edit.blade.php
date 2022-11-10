@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.edit_user') }}</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/users') }}">{{ trans('labels.users') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.edit') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <form action="{{ URL::to('admin/users/update-' . $userdata->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.name') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $userdata->name }}"
                                    placeholder="{{ trans('labels.name') }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.email') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ $userdata->email }}"
                                    placeholder="{{ trans('labels.email') }}" readonly>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.mobile') }}</label>
                                <input type="number" class="form-control" name="mobile" value="{{ $userdata->mobile }}"
                                    placeholder="{{ trans('labels.mobile') }}">
                                @error('mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ trans('labels.image') }}</label>
                                <input type="file" class="form-control" name="profile">
                                <img class="rounded-circle mt-2" src="{{ helper::image_path($userdata->image) }}"
                                    alt="" width="70" height="70">
                                @error('profile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-secondary mt-4"
                                @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
