@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.plans') }}</h5>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="text-secondary">{{ $plan->name }}</h5>
                                @if (Auth::user()->type == '1')
                                    <a href="{{ URL::to('admin/plans/edit-' . $plan->id) }}">
                                        <i class="fa-regular fa-pen-to-square pe-2"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="my-4">
                                <h2 class="mb-2">${{ $plan->price }}
                                    <span class="fs-7 text-muted">
                                        {{-- Dont' remove this / --}}
                                        /
                                        @if ($plan->duration == 1)
                                            {{ trans('labels.one_month') }}
                                        @elseif ($plan->duration == 2)
                                            {{ trans('labels.three_months') }}
                                        @elseif ($plan->duration == 3)
                                            {{ trans('labels.six_months') }}
                                        @else
                                            {{ trans('labels.one_year') }}
                                        @endif
                                    </span>
                                </h2>
                                <small class="text-muted text-center">{{ $plan->description }}</small>
                            </div>
                            <ul class="pb-5">
                                @php $themes = explode(',', $plan->themes_id); @endphp
                                <li class="mb-3"><i
                                        class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ count($themes) }}
                                    {{ trans('labels.themes') }}</li>
                                @php $features = explode('|', $plan->features); @endphp
                                @foreach ($features as $features)
                                    <li class="mb-3"><i
                                            class="fa-regular fa-circle-check text-secondary mx-2"></i>{{ $features }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6 mb-3 payments">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            <h5 class="card-title mb-4">{{ trans('labels.select_payment_method') }}</h5>
                            <div class="row">
                                @foreach ($paymentmethod as $pmdata)
                                    @php
                                        $payment_type = $pmdata->id;
                                        $paymentname = $pmdata->payment_name;
                                        if ($pmdata->id == 1) {
                                            $src = helper::image_path('cod.png');
                                        } elseif ($pmdata->id == 2) {
                                            $src = helper::image_path('wallet.png');
                                        } elseif ($pmdata->id == 3) {
                                            $src = helper::image_path('razorpay.png');
                                        } elseif ($pmdata->id == 4) {
                                            $src = helper::image_path('stripe.png');
                                        } elseif ($pmdata->id == 5) {
                                            $src = helper::image_path('flutterwave.png');
                                        } elseif ($pmdata->id == 6) {
                                            $src = helper::image_path('paystack.png');
                                        } else {
                                            $src = helper::image_path('no-data.png');
                                        }
                                    @endphp
                                    <div class="col-sm-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-text">
                                                <input class="form-check-input mt-0" type="radio"
                                                    value="{{ $pmdata->public_key }}" id="{{ $payment_type }}"
                                                    data-transaction-type="{{ $payment_type }}" name="paymentmode">
                                            </div>
                                            <label for="{{ $payment_type }}"
                                                class="d-flex align-items-center form-control">
                                                <img src="{{ $src }}"width="20" height="20"
                                                    class="mx-2"alt="" srcset="">{{ $paymentname }}
                                            </label>
                                        </div>
                                    </div>
                                    @if ($payment_type == 4)
                                        <input type="hidden" name="stripe_public_key" id="stripe_public_key"
                                            value="{{ $pmdata->public_key }}">
                                        <div class="stripe-form d-none">
                                            <div id="card-element"></div>
                                            <div class="text-danger stripe_error" role="alert"></div>
                                        </div>
                                    @endif
                                @endforeach
                                <span
                                    class="text-danger payment_error d-none">{{ trans('messages.select_atleast_one') }}</span>
                            </div>
                            <button type="button" class="btn btn-secondary buy_now">
                                {{ trans('labels.checkout') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="price" id="price" value="{{ $plan->price }}">
    <input type="hidden" name="plan_id" id="plan_id" value="{{ $plan->id }}">
    <input type="hidden" name="user_name" id="user_name" value="{{ Auth::user()->name }}">
    <input type="hidden" name="user_email" id="user_email" value="{{ Auth::user()->email }}">
    <input type="hidden" name="user_mobile" id="user_mobile" value="{{ Auth::user()->mobile }}">
@endsection
@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script> {{-- Razorpay --}}
    <script src="https://js.stripe.com/v3/"></script> {{-- Stripe --}}
    <script src="https://js.paystack.co/v1/inline.js"></script> {{-- Paystack --}}
    <script src="https://checkout.flutterwave.com/v3.js"></script> {{-- Flutterwave --}}
    <script>
        var SITEURL = '{{ URL::to('') }}';
        var api_key = "";
        var payment_type = "";
        var price = $('#price').val();
        var plan_id = $('#plan_id').val();
        var user_name = $('#user_name').val();
        var user_email = $('#user_email').val();
        var user_mobile = $('#user_mobile').val();
        var stripe_public_key = $('#stripe_public_key').val();
        var stripe = Stripe(stripe_public_key);
        var card = stripe.elements().create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                },
            },
        });
        card.mount('#card-element');
        $('.__PrivateStripeElement iframe').removeAttr('style');
        $('input[name=paymentmode]').on('click', function(e) {
            "use strict";
            $(".payment_error").addClass('d-none');
            api_key = $('input[name=paymentmode]:checked').val();
            payment_type = $('input[name=paymentmode]:checked').attr('data-transaction-type');
            if (payment_type == 4) {
                $('.stripe-form').removeClass('d-none');
            } else {
                $('.stripe-form').addClass('d-none');
            }
        });
        $('.buy_now').on('click', function(e) {
            "use strict";
            if ($('input[name=paymentmode]:checked').length == 0) {
                $(".payment_error").removeClass('d-none');
                return false;
            } else {
                $(".payment_error").addClass('d-none');
            }
            $('#preloader').show();
            //payment_type = COD : 1, Wallet : 2, RazorPay : 3, Stripe : 4, Flutterwave : 5, Paystack : 6
            // RazorPay
            if (payment_type == 3) {
                var options = {
                    "key": api_key,
                    "amount": price * 100, // 2000 paise = INR 20
                    "name": "Visiting Card",
                    "description": "Plan Purchase Payment",
                    "image": 'https://badges.razorpay.com/badge-light.png',
                    "handler": function(response) {
                        $('#preloader').show();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ URL::to('admin/plans/buyplan') }}",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                amount: price,
                                plan_id: plan_id,
                                payment_type: payment_type,
                                payment_id: response.razorpay_payment_id,
                            },
                            success: function(response) {
                                $('#preloader').hide();
                                if (response.status == 1) {
                                    toastr.success(response.message);
                                    window.location.href = "{{ URL::to('admin/plans') }}";
                                }
                                if (response.status == 2) {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(error) {
                                $('#preloader').hide();
                                toastr.error(error);
                            }
                        });
                    },
                    "modal": {
                        "ondismiss": function() {
                            location.reload();
                        }
                    },
                    "prefill": {
                        "name": user_name,
                        "email": user_email,
                        "contact": user_mobile,
                    },
                    "theme": {
                        "color": "#528FF0"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
                e.preventDefault();
            }
            // Stripe
            if (payment_type == 4) {
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        $('.stripe_error').html(result.error.message);
                    } else {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ URL::to('admin/plans/buyplan') }}",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                amount: price,
                                plan_id: plan_id,
                                payment_type: payment_type,
                                payment_id: result.token.id,
                            },
                            success: function(response) {
                                $('#preloader').hide();
                                if (response.status == 1) {
                                    toastr.success(response.message);
                                    window.location.href = "{{ URL::to('admin/plans') }}";
                                }
                                if (response.status == 2) {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(error) {
                                $('#preloader').hide();
                                toastr.error(error);
                            }
                        });
                    }
                });
            }
            // Flutterwave
            if (payment_type == 5) {
                FlutterwaveCheckout({
                    public_key: api_key,
                    tx_ref: user_name,
                    amount: price,
                    currency: "NGN",
                    payment_options: "",
                    customer: {
                        email: user_email,
                        phone_number: user_mobile,
                        name: user_name,
                    },
                    callback: function(response) {
                        $('#preloader').show();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ URL::to('admin/plans/buyplan') }}",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                amount: price,
                                plan_id: plan_id,
                                payment_type: payment_type,
                                payment_id: response.flw_ref,
                            },
                            success: function(response) {
                                $('#preloader').hide();
                                if (response.status == 1) {
                                    toastr.success(response.message);
                                    window.location.href = "{{ URL::to('admin/plans') }}";
                                }
                                if (response.status == 2) {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(error) {
                                $('#preloader').hide();
                                toastr.error(error);
                            }
                        });
                    },
                    onclose: function() {
                        location.reload();
                    },
                    customizations: {
                        title: "Visiting Card",
                        description: 'Flutterwave Order payment',
                        logo: "https://flutterwave.com/images/logo/logo-mark/full.svg",
                    },
                });
            }
            // Paystack
            if (payment_type == 6) {
                var handler = PaystackPop.setup({
                    key: api_key,
                    email: user_email,
                    amount: price *
                        100, 
                    currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
                    callback: function(response) {
                        var reference = response.reference;
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ URL::to('admin/plans/buyplan') }}",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                amount: price,
                                plan_id: plan_id,
                                payment_type: payment_type,
                                payment_id: reference,
                            },
                            success: function(response) {
                                $('#preloader').hide();
                                if (response.status == 1) {
                                    toastr.success(response.message);
                                    window.location.href = "{{ URL::to('admin/plans') }}";
                                }
                                if (response.status == 2) {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(error) {
                                toastr.error(error);
                            }
                        });
                    },
                    onClose: function() {
                        window.location.reload();
                    },
                });
                handler.openIframe();
            }
        });
    </script>
@endsection
