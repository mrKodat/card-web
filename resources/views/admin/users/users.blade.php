@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.users') }}</h5>
                <div class="d-inline-flex">
                    <form class="search-box">
                        <div class="position-relative">
                            <input type="text" id="search_user" class="form-control" placeholder="Search here">
                            <i class="fa-regular fa-magnifying-glass search-icon"></i>
                        </div>
                    </form>
                    <a href="{{ URL::to('admin/users/add') }}" class="btn btn-secondary px-2 d-flex">
                        <i class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}</a>
                </div>
            </div>
            <div class="row search_row">
                @if (count($userlist) > 0)
                    @foreach ($userlist as $userdata)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3" id="searchuser">
                            <div class="card border-0 box-shadow h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        @if ($userdata->is_available == 1)
                                            <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="changestatus('{{ $userdata->id }}','2','{{ URL::to('admin/users/changestatus') }}')" @endif
                                                class="btn btn-success btn-sm">{{ trans('labels.active') }}</a>
                                        @elseif ($userdata->is_available == 2)
                                            <a @if (env('Environment') == 'sendbox') onclick="myFunction()" @else onclick="changestatus('{{ $userdata->id }}','1','{{ URL::to('admin/users/changestatus') }}')" @endif
                                                class="btn btn-danger btn-sm">{{ trans('labels.inactive') }}</a>
                                        @endif
                                        <button class="border-0 bg-transparent" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-ellipsis-stroke-vertical text-muted"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ URL::to('admin/users/edit-' . $userdata->id) }}"class="dropdown-item py-2">
                                                <i class="fa-regular fa-pen-to-square pe-2"></i>{{ trans('labels.edit') }}
                                            </a>
                                            <a href="{{ URL::to('admin/users/vendor_login-' . $userdata->id) }}"class="dropdown-item py-2">
                                                <i class="fa-regular fa-arrow-right-to-bracket pe-2"></i>{{ trans('labels.vendor_login') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-grid justify-items-center mb-3">
                                        <img class="border rounded-circle object-fit-cover"
                                            src="{{ helper::image_path($userdata->image) }}" width="70" height="70">
                                        <h4 class="mt-2" id="user_name">{{ $userdata->name }}</h4>
                                        <small class="text-break">{{ $userdata->email }}</small>
                                    </div>  
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h6 class="text-capitalize">{{ trans('labels.subscription') }}</h6>
                                        <a href="{{ URL::to('admin/plans') }}" class="btn btn-primary btn-sm">{{ @$userdata['plans_info']->name == "" ? '-' : $userdata['plans_info']->name }}</a>
                                    </div>
                                    <div class="d-flex mb-5">
                                        <div class="col-6 text-center">
                                            <h6>{{ count($userdata['business_count']) }}</h6>
                                            <p class="fw-light">{{ trans('labels.business') }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <h6>{{ count($userdata['appointments_count']) }}</h6>
                                            <p class="fw-light"> {{ trans('labels.appointments') }} </p>
                                        </div>
                                    </div>
                                    @if ($userdata->purchase_date != '')
                                        @if (helper::check_plan_expire($userdata->purchase_date, $userdata['plans_info']->duration)['status'] == 2)
                                            <p class="text-primary text-center">{{ trans('labels.plan_expired') }} :
                                                <span class="text-danger">
                                                    {{ helper::date_format(helper::check_plan_expire($userdata->purchase_date, $userdata['plans_info']->duration)['exdate']) }}
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-primary text-center">{{ trans('labels.plan_expires') }} :
                                                <span class="text-secondary">
                                                    {{ helper::date_format(helper::check_plan_expire($userdata->purchase_date, $userdata['plans_info']->duration)['exdate']) }}
                                                </span>
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-primary text-center text-danger">
                                            {{ trans('labels.doesnt_select_plan') }}</p>
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
                                $('#preloader , #status').hide();
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
    <script>
        // live search
        $(document).ready(function() {
            "use strict";
            $("#search_user").keyup(function() {
                var value = $(this).val().toLowerCase();
                $(".search_row #searchuser").filter(function() {
                    $(this).toggle($(this).find('#user_name').text().toLowerCase().indexOf(value) > - 1)
                });
            });
        });
    </script>
@endsection
