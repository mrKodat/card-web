@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.reset_password') }}</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('admin/users')}}">{{ trans('labels.users') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.reset_password') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <form action="{{URL::to('admin/users/reset-'.$data->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="oldpass" class="form-label">{{ trans('labels.current_password') }}</label>
                                    <input type="password" class="form-control" name="currentpassword" id="oldpass" placeholder="{{ trans('labels.current_password') }}">
                                    @error('currentpassword')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="newpass" class="form-label">{{ trans('labels.new_password') }}</label>
                                    <input type="password" class="form-control" name="password" id="newpass" placeholder="{{ trans('labels.new_password') }}">
                                    @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="cfpass" class="form-label">{{ trans('labels.confirm_password') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="cfpass" placeholder="{{ trans('labels.confirm_password') }}">
                                    @error('password_confirmation')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <button type="submit" class="btn btn-secondary mt-4">{{ trans('labels.change_password') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
