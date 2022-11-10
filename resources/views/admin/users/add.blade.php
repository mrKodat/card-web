@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.add_user') }}</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ URL::to('admin/users') }}">{{ trans('labels.users') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form action="{{ URL::to('admin/users/store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-label">{{ trans('labels.name') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        id="name" placeholder="{{ trans('labels.name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">{{ trans('labels.email') }}</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        id="email" placeholder="{{ trans('labels.email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mobile" class="form-label">{{ trans('labels.mobile') }}</label>
                                    <input type="number" class="form-control" name="mobile" value="{{ old('mobile') }}"
                                        id="mobile" placeholder="{{ trans('labels.mobile') }}">
                                    @error('mobile')
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
                                <button class="btn btn-secondary mt-4"
                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.submit') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
