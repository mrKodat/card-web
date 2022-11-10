@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/datatables/buttons.dataTables.min.css') }}">
    
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <h5 class="text-uppercase">{{ trans('labels.appointments') }}</h5>
                <div class="card border-0 my-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped py-3 w-100" id="appointments">
                                <thead>
                                    <tr class="text-uppercase fw-500">
                                        <td>{{ trans('labels.date') }}</td>
                                        <td>{{ trans('labels.name') }}</td>
                                        <td>{{ trans('labels.email') }}</td>
                                        <td>{{ trans('labels.time') }}</td>
                                        <td>{{ trans('labels.status') }}</td>
                                        <td class="text-center">{{ trans('labels.action') }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $data)
                                        <tr>
                                            <td>{{ helper::date_format($data->date) }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->time }}</td>
                                            <td>
                                                @if ($data->status == 1 )
                                                <button class="btn btn-info btn-sm">{{trans('labels.pending')}}</button>    
                                                @elseif ($data->status == 2 )
                                                <button class="btn btn-success btn-sm">{{trans('labels.accepted')}}</button>    
                                                @else
                                                <button class="btn btn-danger btn-sm">{{trans('labels.rejected')}}</button>    
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class="dropdown-toggle cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ trans('labels.select') }}
                                                </a>
                                                <ul class="dropdown-menu">
                                                  <li><a onclick="status('{{$data->id}}', '2', '{{URL::to('admin/appointments/changestatus')}}')" class="dropdown-item">{{ trans('labels.accepted') }}</a></li>
                                                  <li><a onclick="status('{{$data->id}}', '3', '{{URL::to('admin/appointments/changestatus')}}')" class="dropdown-item">{{ trans('labels.rejected') }}</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/dataTables.buttons.min.js') }}"></script><!-- Datatables Buttons JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/jszip.min.js') }}"></script><!-- Datatables Excel Buttons JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/pdfmake.min.js') }}"></script><!-- Datatables Make PDF Buttons JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/vfs_fonts.js') }}"></script><!-- Datatables Export PDF Buttons JS -->
    <script src="{{ url('storage/app/public/admin-assets/js/datatables/buttons.html5.min.js') }}"></script><!-- Datatables Buttons HTML5 JS -->
    <script>
        $(document).ready(function() {
            "use strict";
            $('#appointments').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ]
            });
        });

        function status(id, status, url) {
            "use strict";
            $('#preloader , #status').show();
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
                        toastr.error(error)
                    }
                },
                failure: function(response) {
                    toastr.error(error)
                }
            });
        }
    </script>
@endsection
