@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex mb-3">
                <h5 class="text-uppercase">{{ trans('labels.dashboard') }}</h5>
            </div>
            <div class="row">
                
                @if (Auth::user()->type == 1)
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 box-shadow h-100">
                            <div class="card-body">
                                <div class="dashboard-card">
                                    <span class="card-icon">
                                        <i class="fa-regular fa-user fs-5"></i>
                                    </span>
                                    <span class="text-end">
                                        <p class="text-muted fw-medium mb-1">{{ trans('labels.users') }}</p>
                                        <h4>{{ $users_count }}</h4>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 box-shadow h-100">
                            <div class="card-body">
                                <div class="dashboard-card">
                                    <span class="card-icon">
                                        <i class="fa-regular fa-medal fs-5"></i>
                                    </span>
                                    <span class="text-end">
                                        <p class="text-muted fw-medium mb-1">{{ trans('labels.plans') }}</p>
                                        <h4>{{ $plans_count }}</h4>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 box-shadow h-100">
                            <div class="card-body">
                                <div class="dashboard-card">
                                    <span class="card-icon">
                                        <i class="fa-regular fa-cart-shopping fs-5"></i>
                                    </span>
                                    <span class="text-end">
                                        <p class="text-muted fw-medium mb-1">{{ trans('labels.orders') }}</p>
                                        <h4>{{ $transactions_count }}</h4>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 box-shadow h-100">
                            <div class="card-body">
                                <div class="dashboard-card">
                                    <span class="card-icon">
                                        <i class="fa-regular fa-money-bill-1-wave fs-5"></i>
                                    </span>
                                    <span class="text-end">
                                        <p class="text-muted fw-medium mb-1">{{ trans('labels.business') }}</p>
                                        <h4>{{ $business_count }}</h4>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                        <div class="card border-0 box-shadow h-100">
                            <div class="card-body">
                                <div class="dashboard-card">
                                    <span class="card-icon">
                                        <i class="fa-regular fa-money-bill-1-wave fs-5"></i>
                                    </span>
                                    <span class="text-end">
                                        <p class="text-muted fw-medium mb-1">{{ trans('labels.appointments') }}</p>
                                        <h4>{{ $appointments_count }}</h4>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="dashboard-card">
                                <span class="card-icon">
                                    <i class="fa-regular fa-money-bill-1-wave fs-5"></i>
                                </span>
                                <span class="text-end">
                                    <p class="text-muted fw-medium mb-1">{{ trans('labels.subscription') }}</p>
                                    <h4>{{ helper::currency_format($subscription_sum) }}</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8  mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title">{{ trans('labels.total_subscription') }}</h5>
                                <select class="form-select form-select-sm w-auto" name="subscription_year"
                                    id="subscription_year" data-url="{{ URL::to('admin/dashboard') }}">
                                    @if (count($subscription_years) != 0)
                                        @foreach ($subscription_years as $year)
                                            <option value="{{ $year->year }}"
                                                {{ $year->year == date('Y') ? 'selected' : '' }}>{{ $year->year }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <canvas id="subscription_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title">
                                    @if (Auth::user()->type == 2)
                                        {{ trans('labels.total_appointments') }}
                                    @else
                                        {{ trans('labels.total_users') }}
                                    @endif
                                </h5>
                                <select class="form-select form-select-sm w-auto" name="user_year" id="user_year"
                                    data-url="{{ URL::to('admin/dashboard') }}">
                                    @if (count($user_years) != 0)
                                        @foreach ($user_years as $year)
                                            <option value="{{ $year->year }}"
                                                {{ $year->year == date('Y') ? 'selected' : '' }}>{{ $year->year }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <canvas id="user_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="card border-0 box-shadow h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title">{{ trans('labels.total_business') }}</h5>
                                <select class="form-select form-select-sm w-auto" name="business_year" id="business_year"
                                    data-url="{{ URL::to('admin/dashboard') }}">
                                    @if (count($business_years) != 0)
                                        @foreach ($business_years as $year)
                                            <option value="{{ $year->year }}"
                                                {{ $year->year == date('Y') ? 'selected' : '' }}>{{ $year->year }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
                                <canvas id="business_chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ url('storage/app/public/admin-assets/js/chartjs/chart_3.9.1.min.js') }}"></script>
    <script>
        let check_type = {{ Js::from(Auth::user()->type) }}
        var subscription_label = "{{ trans('labels.subscription') }}"
        var business_label = "{{ trans('labels.business') }}"
    </script>

    <!-- Subscription Chart -->
    <script>
        var subscription_chart = null;
        var subscription_labels = {{ Js::from($subscription_labels) }};
        var subscription_data = {{ Js::from($subscription_data) }};
        createRevenueChart(subscription_labels, subscription_data);
        $("#subscription_year").on('change', function() {
            "use strict";
            let year = $("#subscription_year").val();
            let url = $("#subscription_year").attr('data-url');
            $('#preloader , #status').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "GET",
                data: {
                    subscription_year: year
                },
                dataType: "JSON",
                success: function(data) {
                    $('#preloader , #status').hide();
                    createRevenueChart(data.subscription_labels, data.subscription_data)
                },
                error: function(data) {
                    $('#preloader , #status').hide();
                    // console.log(data);
                }
            });
        });

        function createRevenueChart(subscription_labels, subscription_data) {
            "use strict";
            const chartdata = {
                labels: subscription_labels,
                datasets: [{
                    label: subscription_label,
                    data: subscription_data,
                    fill: {
                        target: 'origin',
                        above: 'rgba(29, 201, 183, 0.2)',
                    },
                    borderColor: 'rgba(29, 201, 183, 0.7)',
                    tension: 0.1,
                    pointBackgroundColor: '#1dc9b7',
                    pointBorderColor: '#1dc9b7',
                }]
            };
            const config = {
                type: 'line',
                data: chartdata,
                options: {}
            };
            if (subscription_chart != null) {
                subscription_chart.destroy();
            }
            if (document.getElementById("subscription_chart")) {
                subscription_chart = new Chart(document.getElementById('subscription_chart'), config);
            }
        }
    </script>


    <!-- User Chart -->
    <script>
        var user_chart = null;
        var user_labels = {{ Js::from($user_labels) }};
        var user_data = {{ Js::from($user_data) }};
        createOrderChart(user_labels, user_data);
        $("#user_year").on('change', function() {
            "use strict";
            let year = $("#user_year").val();
            let url = $("#user_year").attr('data-url');
            $('#preloader , #status').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "GET",
                data: {
                    user_year: year
                },
                dataType: "JSON",
                success: function(data) {
                    $('#preloader , #status').hide();
                    createOrderChart(data.user_labels, data.user_data)
                },
                error: function(data) {
                    $('#preloader , #status').hide();
                    // console.log(data);
                }
            });
        });

        function createOrderChart(user_labels, user_data) {
            "use strict";
            const chartdata = {
                labels: user_labels,
                datasets: [{
                    label: 'Users',
                    data: user_data,
                    backgroundColor: ['rgba(54, 162, 235, 0.4)', 'rgba(255, 150, 86, 0.4)',
                        'rgba(140, 162, 198, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(255, 99, 132, 0.4)',
                        'rgba(255, 159, 64, 0.4)', 'rgba(255, 205, 86, 0.4)', 'rgba(75, 192, 192, 0.4)',
                        'rgba(54, 170, 235, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(201, 203, 207, 0.4)',
                        'rgba(255, 159, 64, 0.4)'
                    ],
                    hoverOffset: 10
                }]
            };
            const config = {
                type: 'pie',
                data: chartdata,
                options: {}
            };
            if (user_chart != null) {
                user_chart.destroy();
            }
            if (document.getElementById("user_chart")) {
                user_chart = new Chart(document.getElementById('user_chart'), config);
            }
        }
    </script>


    <!-- Business Chart -->
    <script>
        var business_chart = null;
        var business_labels = {{ Js::from($business_labels) }};
        var business_data = {{ Js::from($business_data) }};
        createUserChart(business_labels, business_data);
        $("#business_year").on('change', function() {
            "use strict";
            let year = $("#business_year").val();
            let url = $("#business_year").attr('data-url');
            $('#preloader , #status').show();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "GET",
                data: {
                    business_year: year
                },
                dataType: "JSON",
                success: function(data) {
                    $('#preloader , #status').hide();
                    createUserChart(data.business_labels, data.business_data)
                },
                error: function(data) {
                    $('#preloader , #status').hide();
                    // console.log(data);
                }
            });
        });

        function createUserChart(business_labels, business_data) {
            "use strict";
            const chartdata = {
                labels: business_labels,
                datasets: [{
                    label: business_label,
                    data: business_data,
                    backgroundColor: ['rgba(54, 162, 235, 0.4)', 'rgba(255, 150, 86, 0.4)',
                        'rgba(140, 162, 198, 0.4)', 'rgba(255, 206, 86, 0.4)', 'rgba(255, 99, 132, 0.4)',
                        'rgba(255, 159, 64, 0.4)', 'rgba(255, 205, 86, 0.4)', 'rgba(75, 192, 192, 0.4)',
                        'rgba(54, 170, 235, 0.4)', 'rgba(153, 102, 255, 0.4)', 'rgba(201, 203, 207, 0.4)',
                        'rgba(255, 159, 64, 0.4)'
                    ],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 150, 86, 1)', 'rgba(140, 162, 198, 1)',
                        'rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(54, 170, 235, 1)',
                        'rgba(153, 102, 255, 1)', 'rgba(201, 203, 207, 1)', 'rgba(255, 159, 64, 1)'
                    ],

                    borderWidth: 1
                }]
            };
            const config = {
                type: 'bar',
                data: chartdata,
                options: {}
            };
            if (business_chart != null) {
                business_chart.destroy();
            }
            if (document.getElementById("business_chart")) {
                business_chart = new Chart(document.getElementById('business_chart'), config);
            }
        }
    </script>
@endsection
