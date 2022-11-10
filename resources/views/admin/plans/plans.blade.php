@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.plans') }}</h5>
                @if (Auth::user()->type == 1)
                    <a href="{{ URL::to('admin/plans/add') }}" class="btn btn-secondary px-2 d-flex">
                        <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}
                    </a>
                @endif
            </div>
            <div class="row">
                @if (count($planlist) > 0)
                    @foreach ($planlist as $plandata)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                            <div
                                class="card box-shadow h-100 {{ Auth::user()->plan_id == $plandata->id ? 'border border-2 border-success' : 'border-0' }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="text-secondary text-capitalize">{{ $plandata->name }}</h5>
                                        @if (Auth::user()->type == '1')
                                            <a href="{{ URL::to('admin/plans/edit-' . $plandata->id) }}">
                                                <i class="fa-regular fa-pen-to-square pe-2"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="my-4">
                                        <h5 class="mb-2">{{ helper::currency_format($plandata->price) }}
                                            <span class="fs-7 text-muted">/
                                                @if ($plandata->duration == 1)
                                                    {{ trans('labels.one_month') }}
                                                @elseif ($plandata->duration == 2)
                                                    {{ trans('labels.three_months') }}
                                                @elseif ($plandata->duration == 3)
                                                    {{ trans('labels.six_months') }}
                                                @else
                                                    {{ trans('labels.one_year') }}
                                                @endif
                                            </span>
                                        </h5>
                                        <small class="text-muted text-center">{{ $plandata->description }}</small>
                                    </div>
                                    <ul class="pb-5">
                                        @php $themes = explode(',', $plandata->themes_id); @endphp
                                        <li class="mb-3">
                                            <i
                                                class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ count($themes) }}
                                            {{ trans('labels.themes') }}
                                        </li>
                                        @if ($plandata->order_limit > 0)
                                            <li class="mb-3">
                                                <i
                                                    class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ $plandata->order_limit }}
                                                {{ trans('labels.business') }}
                                            </li>
                                        @else
                                            <li class="mb-3">
                                                <i
                                                    class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ trans('labels.unlimited_business') }}
                                            </li>
                                        @endif
                                        @if ($plandata->appointment_limit > 0)
                                            <li class="mb-3">
                                                <i
                                                    class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ $plandata->appointment_limit }}
                                                {{ trans('labels.appointments') }}
                                            </li>
                                        @else
                                            <li class="mb-3">
                                                <i
                                                    class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ trans('labels.unlimited_appointment_limit') }}
                                            </li>
                                        @endif
                                        @php $features = explode('|', $plandata->features); @endphp
                                        @foreach ($features as $features)
                                            <li class="mb-3">
                                                <i
                                                    class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ $features }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if (Auth::user()->type == '1')
                                        @if ($plandata->is_available == 1)
                                            <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="changestatus('{{ $plandata->id }}','2','{{ URL::to('admin/plans/changestatus') }}')" @endif
                                                class="btn btn-success available-btn btn-sm">{{ trans('labels.active') }}</a>
                                        @elseif ($plandata->is_available == 2)
                                            <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="changestatus('{{ $plandata->id }}','1','{{ URL::to('admin/plans/changestatus') }}')" @endif
                                                class="btn btn-danger available-btn btn-sm">{{ trans('labels.inactive') }}</a>
                                        @endif
                                    @else
                                        @if (Auth::user()->plan_id == $plandata->id)
                                            @php
                                                $now = date('Y-m-d');
                                                if ($plandata->duration == '1') {
                                                    $purchasedate = date('Y-m-d', strtotime(Auth::user()->purchase_date));
                                                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +30 days'));
                                                
                                                    if ($purchasedate <= $now && $now <= $exdate) {
                                                        $showbuy = 'yes';
                                                    } else {
                                                        $showbuy = 'no';
                                                    }
                                                }
                                                if ($plandata->duration == '2') {
                                                    $purchasedate = date('Y-m-d', strtotime(Auth::user()->purchase_date));
                                                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +90 days'));
                                                
                                                    if ($purchasedate <= $now && $now <= $exdate) {
                                                        $showbuy = 'yes';
                                                    } else {
                                                        $showbuy = 'no';
                                                    }
                                                }
                                                if ($plandata->duration == '3') {
                                                    $purchasedate = date('Y-m-d', strtotime(Auth::user()->purchase_date));
                                                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +180 days'));
                                                
                                                    if ($purchasedate <= $now && $now <= $exdate) {
                                                        $showbuy = 'yes';
                                                    } else {
                                                        $showbuy = 'no';
                                                    }
                                                }
                                                if ($plandata->duration == '4') {
                                                    $purchasedate = date('Y-m-d', strtotime(Auth::user()->purchase_date));
                                                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +365 days'));
                                                
                                                    if ($purchasedate <= $now && $now <= $exdate) {
                                                        $showbuy = 'yes';
                                                    } else {
                                                        $showbuy = 'no';
                                                    }
                                                }
                                            @endphp
                                            @if ($showbuy == 'no')
                                                <small
                                                    class="text-primary text-center available-btn">{{ trans('labels.plan_expired') }}
                                                    :
                                                    <span class="text-danger">{{ helper::date_format($exdate) }}</span>
                                                </small>
                                            @else
                                                <small
                                                    class="text-primary text-center available-btn">{{ trans('labels.plan_expires') }}
                                                    :
                                                    <span class="text-secondary">{{ helper::date_format($exdate) }}</span>
                                                </small>
                                            @endif
                                        @else
                                            @if ($plandata->price > 0)
                                                <a href="{{ URL::to('admin/plans/selectplan-' . $plandata->id) }}"
                                                    class="btn btn-primary available-btn btn-sm">{{ trans('labels.buy_now') }}</a>
                                            @elseif (Auth::user()->purchase_amount >= $plandata->price)
                                                <small
                                                    class="text-center text-danger available-btn">{{ trans('labels.already_used') }}</small>
                                            @else
                                                <a href="{{ URL::to('admin/plans/selectplan-' . $plandata->id) }}"
                                                    class="btn btn-primary available-btn btn-sm">{{ trans('labels.select') }}</a>
                                            @endif
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <img src="{{ helper::image_path('no-data.svg') }}" height="500">
                    <h5 class="text-center mb-3">{{ trans('labels.nodata_found') }}</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function changestatus(id, status, url) {
            "use strict";
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger mx-2'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: are_you_sure,
                icon: 'warning',
                confirmButtonText: yes,
                cancelButtonText: no,
                showCancelButton: true,
                reverseButtons: true
            }).then((result) => {
                $('#preloader , #status').show();
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: url,
                        data: {
                            'id': id,
                            'status': status
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response == 1) {
                                location.reload();
                            } else {
                                $('#preloader , #status').hide();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: wrong,
                                })
                            }
                        },
                        failure: function(response) {
                            $('#preloader , #status').hide();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: wrong,
                            })
                        }
                    });
                }
                $('#preloader , #status').hide();
            })
        }
    </script>
@endsection
