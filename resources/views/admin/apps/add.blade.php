@extends('admin.layout.default')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-uppercase">{{ trans('labels.add') }}</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('admin/users')}}">SystemAddons</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.add') }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 box-shadow">
                    <div class="card-body">
                        <form method="post" action="{{ URL::to('admin/systemaddons/store')}}" name="about" id="about" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-3 col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="addon_zip" class="col-form-label">Zip File</label>
                                        <input type="file" class="form-control" name="addon_zip" id="addon_zip" required="">
                                    </div>
                                </div>
                            </div>

                            @if (env('Environment') == 'sendbox')
                            <button type="button" class="btn btn-primary" onclick="myFunction()">Install</button>
                            @else
                            <button type="submit" class="btn btn-primary">Install</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection