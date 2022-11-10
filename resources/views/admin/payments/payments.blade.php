@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex align-items-center mb-3">
                <h5 class="text-uppercase">{{ trans('labels.payment_settings') }}</h5>
            </div>
            <div class="row mb-3 payments">
                <div class="col-12">
                    <div class="card border-0 box-shadow">
                        <div class="card-body">
                            @if (count($paymentmethod) > 0)
                                <form action="{{ URL::to('admin/paymentmethod') }}" method="POST">
                                    @csrf
                                    <div class="accordion accordion-flush" id="accordionExample">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($paymentmethod as $pmdata)
                                            @php
                                                $transaction_type = $pmdata->id;
                                                $paymentname = $pmdata->payment_name;
                                                if ($pmdata->id == 3) {
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
                                            <input type="hidden" name="transaction_type[]" value="{{ $transaction_type }}">
                                            <div class="accordion-item card rounded border mb-3">
                                                <h2 class="accordion-header" id="heading{{ $transaction_type }}">
                                                    <button class="accordion-button rounded collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#targetto-{{ $i }}-{{ $transaction_type }}"
                                                        aria-expanded="false"
                                                        aria-controls="targetto-{{ $i }}-{{ $transaction_type }}">
                                                        <img src="{{ $src }}" width="20" height="20"
                                                            class="mx-2" alt="" srcset="">
                                                        {{ $paymentname }}
                                                    </button>
                                                </h2>
                                                <div id="targetto-{{ $i }}-{{ $transaction_type }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading{{ $transaction_type }}"
                                                    data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p class="form-label">{{ trans('labels.environment') }}</p>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="environment[{{ $transaction_type }}]"
                                                                        id="{{ $transaction_type }}_environment"
                                                                        value="1"
                                                                        {{ $pmdata->environment == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="{{ $transaction_type }}_environment">
                                                                        {{ trans('labels.sandbox') }}
                                                                    </label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="environment[{{ $transaction_type }}]"
                                                                        id="{{ $transaction_type }}_environment"
                                                                        value="2"
                                                                        {{ $pmdata->environment == 2 ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="{{ $transaction_type }}_environment">
                                                                        {{ trans('labels.live') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div
                                                                    class="form-check form-switch d-flex justify-content-end mb-2">
                                                                    <input id="checkbox-switch{{ $transaction_type }}"
                                                                        type="checkbox" class="checkbox-switch"
                                                                        name="status[{{ $transaction_type }}]"
                                                                        value="1"
                                                                        {{ $pmdata->is_available == 1 ? 'checked' : '' }}>
                                                                    <label for="checkbox-switch{{ $transaction_type }}"
                                                                        class="switch">
                                                                        <span class="switch__circle">
                                                                            <span class="switch__circle-inner"></span>
                                                                        </span>
                                                                        <span
                                                                            class="switch__left ps-2">{{ trans('labels.off') }}</span>
                                                                        <span
                                                                            class="switch__right pe-2">{{ trans('labels.on') }}</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="{{ $transaction_type }}_publickey"
                                                                        class="form-label">
                                                                        {{ trans('labels.public_key') }}
                                                                    </label>
                                                                    <input type="text"
                                                                        id="{{ $transaction_type }}_publickey"
                                                                        class="form-control"
                                                                        name="public_key[{{ $transaction_type }}]"
                                                                        placeholder="{{ trans('labels.public_key') }}"
                                                                        value="{{ $pmdata->public_key }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="{{ $transaction_type }}_secretkey"
                                                                        class="form-label">
                                                                        {{ trans('labels.secret_key') }}
                                                                    </label>
                                                                    <input type="text"
                                                                        id="{{ $transaction_type }}_secretkey"
                                                                        class="form-control"
                                                                        name="secret_key[{{ $transaction_type }}]"
                                                                        placeholder="{{ trans('labels.secret_key') }}"
                                                                        value="{{ $pmdata->secret_key }}">
                                                                </div>
                                                            </div>
                                                            @if ($transaction_type == 5)
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label for="{{ $transaction_type }}_secretkey"
                                                                            class="form-label">
                                                                            {{ trans('labels.encryption_key') }}
                                                                        </label>
                                                                        <input type="text" id="encryptionkey"
                                                                            class="form-control" name="encryption_key"
                                                                            placeholder="{{ trans('labels.encryption_key') }}"
                                                                            value="{{ $pmdata->encryption_key }}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button
                                        class="btn btn-secondary mt-4"@if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save_changes') }}</button>
                                </form>
                            @else
                                <img src="{{ helper::image_path('no-data.svg') }}" height="500">
                                <h5 class="text-center mb-3">{{ trans('labels.nodata_found') }}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.basic').on('click', function() {
            "use strict";
            if ($(this).attr('data-tab') == 'basicinfo') {
                $('html, body').animate({
                    scrollTop: 0
                }, '1000');
            }
            $('.list-options').find('.active').removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endsection
