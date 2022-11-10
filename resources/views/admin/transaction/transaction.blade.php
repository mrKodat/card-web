@extends('admin.layout.default')
@section('styles')
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/datatables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ url('storage/app/public/admin-assets/css/datatables/buttons.dataTables.min.css') }}">
    <!-- Datatables CSS -->
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <h5 class="text-uppercase">{{ trans('labels.transaction') }}</h5>
                <div class="card border-0 my-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped py-3 w-100" id="transaction">
                                <thead>
                                    <tr class="text-uppercase fw-500">
                                        @if (Auth::user()->type == 1)
                                            <td>{{ trans('labels.vendor_name') }}</td>
                                        @endif
                                        <td>{{ trans('labels.plan_name') }}</td>
                                        <td>{{ trans('labels.amount') }}</td>
                                        <td>{{ trans('labels.payment_type') }}</td>
                                        <td>{{ trans('labels.start_date') }}</td>
                                        <td>{{ trans('labels.end_date') }}</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction as $transactiondata)
                                        @if ($transactiondata->vendor_id == Auth::user()->id || Auth::user()->type == '1')
                                            <tr class="fs-7">
                                                @if (Auth::user()->type == 1)
                                                    <td>{{ $transactiondata['users_info']->name }}</td>
                                                @endif
                                                <td>{{ $transactiondata['plans_info']->name }}</td>
                                                <td>{{ helper::currency_format($transactiondata->amount) }}</td>
                                                <td>{{ $transactiondata['paymentmethod_info']->payment_name }} : {{ $transactiondata->payment_id }}</td>
                                                <td>{{ helper::date_format($transactiondata->created_at) }}</td>
                                                @php
                                                    $now = date('Y-m-d');
                                                    if ($transactiondata['plans_info']->duration == '1') {
                                                        $purchasedate = date('Y-m-d', strtotime($transactiondata['users_info']->purchase_date));
                                                        $exdate = date('Y-m-d', strtotime($purchasedate . ' +30 days'));
                                                    }
                                                    if ($transactiondata['plans_info']->duration == '2') {
                                                        $purchasedate = date('Y-m-d', strtotime($transactiondata['users_info']->purchase_date));
                                                        $exdate = date('Y-m-d', strtotime($purchasedate . ' +90 days'));
                                                    }
                                                    if ($transactiondata['plans_info']->duration == '3') {
                                                        $purchasedate = date('Y-m-d', strtotime($transactiondata['users_info']->purchase_date));
                                                        $exdate = date('Y-m-d', strtotime($purchasedate . ' +180 days'));
                                                    }
                                                    if ($transactiondata['plans_info']->duration == '4') {
                                                        $purchasedate = date('Y-m-d', strtotime($transactiondata['users_info']->purchase_date));
                                                        $exdate = date('Y-m-d', strtotime($purchasedate . ' +365 days'));
                                                    }
                                                @endphp
                                                <td>{{ helper::date_format($exdate) }}</td>
                                            </tr>
                                        @endif
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
            $('#transaction').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ]
            });
        });
    </script>
@endsection
