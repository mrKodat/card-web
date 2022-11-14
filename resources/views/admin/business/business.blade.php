@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-uppercase">{{ trans('labels.business') }}</h5>
                    <form class="col-md-4" action="{{ URL::to('admin/business/business_add') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="business_name"
                                placeholder="{{ trans('labels.business_name') }}">
                            <button type="submit" class="btn btn-secondary"><i
                                    class="fa-regular fa-plus mx-1"></i>{{ trans('labels.add') }}</button>
                        </div>
                        @error('business_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </form>
                </div>
                <div class="card border-0 my-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped py-3 w-100" id="datatable">
                                <thead>
                                    <tr class="text-uppercase fw-500">
                                        <td>{{ trans('labels.business_name') }}</td>
                                        <td>{{ trans('labels.action') }}</td>
                                    </tr>
                                </thead>
                             @if (!empty($business))
                               
                                 @endif
                                @foreach ($business as $business_data)
                                    <tr>
                                        <td><a href="{{ URL::to('admin/business/business_edit-' . $business_data->id) }}"
                                                class="btn btn-outline-primary">{{ $business_data->title }}</a></td>
                                        <td>
                                            <input type="hidden" value=""
                                                name="" id="business_link">
                                            <button onclick="copytext(this)" type="button"
                                                data-clipboard-text="{{ URL::to('/' . $business_data->slug) }}" title="Click to copy card link"
                                                class="btn btn-outline-success btn-sm mx-1">
                                                <i class="fa-regular fa-clone"></i>
                                            </button>
                                            <a href="{{ URL::to('admin/business/business_edit-' . $business_data->id) }}"
                                                type="button" title="Edit" class="btn btn-outline-info btn-sm mx-1">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a onclick="delete_business('{{$business_data->id}}','{{ URL::to('admin/business/business_delete') }}')"
                                                type="button" title="Delete" class="btn btn-outline-danger btn-sm mx-1">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </a>
                                            <a href="{{ URL::to('/' . $business_data->slug) }}" target="_blank" class="btn btn-outline-warning btn-sm mx-1">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/jquery.dataTables.min.js') }}"></script><!-- Datatables JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/dataTables.bootstrap5.min.js') }}"></script><!-- Datatables Bootstrap5 JS -->
    <script>
        $(document).ready(function() {
            "use strict";
            $('#datatable').DataTable();
        });
        function copytext(x) {
            "use strict";
            var temp = $("<input>");
            $("body").append(temp);
            temp.val($(x).attr('data-clipboard-text')).select();
            document.execCommand("copy");
            temp.remove();
        }

        function delete_business(id, url) {
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
                if (result.isConfirmed) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: url,
                        data: {
                            'id': id
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response == 1) {
                                location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: wrong,
                                })
                            }
                        },
                        failure: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: wrong,
                            })
                        }
                    });
                }
            })
        }
    </script>
@endsection
