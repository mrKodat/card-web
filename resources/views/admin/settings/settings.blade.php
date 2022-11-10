@extends('admin.layout.default')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row settings">
                <div class="col-xl-3 mb-3">
                    <div class="card card-sticky-top border-0">
                        <ul class="list-group list-options">
                            <a href="#basicinfo" data-tab="basicinfo"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center active"
                                aria-current="true">{{ trans('labels.basic_info') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#editprofile" data-tab="editprofile"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.edit_profile') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                            <a href="#changepasssword" data-tab="changepasssword"
                                class="list-group-item basicinfo p-3 list-item-secondary d-flex justify-content-between align-items-center"
                                aria-current="true">{{ trans('labels.change_password') }}
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="settingmenuContent">
                        <div id="basicinfo">
                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <h5 class="text-uppercase">{{ trans('labels.basic_info') }}</h5>
                                            </div>
                                            <form action="{{ URL::to('admin/basicinfo/store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @if (Auth::user()->type == 1)
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label class="form-label">{{ trans('labels.currency') }}</label>
                                                            <input type="text" class="form-control" name="currency"
                                                                value="{{ @$settingsdata != '' ? @$settingsdata->currency : old('currency') }}">
                                                            @error('currency')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <p class="form-label">{{ trans('labels.currency_position') }}
                                                            </p>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input form-check-input-secondary"
                                                                    type="radio" name="currency_position" value="1"
                                                                    {{ @$settingsdata->currency_position == 1 ? 'checked' : '' }}>
                                                                <label
                                                                    class="form-check-label">{{ trans('labels.left') }}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input form-check-input-secondary"
                                                                    type="radio" name="currency_position" value="2"
                                                                    {{ @$settingsdata->currency_position == 2 ? 'checked' : '' }}>
                                                                <label
                                                                    class="form-check-label">{{ trans('labels.right') }}</label>
                                                            </div>
                                                            @error('currency_position')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group">
                                                    <label class="form-label">{{ trans('labels.time_zone') }}</label>
                                                    <select class="form-select" name="timezone">
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Midway' ? 'selected' : '' }}
                                                            value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Adak' ? 'selected' : '' }}
                                                            value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Etc/GMT+10' ? 'selected' : '' }}
                                                            value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Marquesas' ? 'selected' : '' }}
                                                            value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Gambier' ? 'selected' : '' }}
                                                            value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Anchorage' ? 'selected' : '' }}
                                                            value="America/Anchorage">(GMT-09:00) Alaska</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Ensenada' ? 'selected' : '' }}
                                                            value="America/Ensenada">(GMT-08:00) Tijuana, Baja California
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Etc/GMT+8' ? 'selected' : '' }}
                                                            value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Los_Angeles' ? 'selected' : '' }}
                                                            value="America/Los_Angeles">(GMT-08:00) Pacific Time (US &amp;
                                                            Canada)
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Denver' ? 'selected' : '' }}
                                                            value="America/Denver">(GMT-07:00) Mountain Time (US &amp;
                                                            Canada)
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Chihuahua' ? 'selected' : '' }}
                                                            value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz,
                                                            Mazatlan
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Dawson_Creek' ? 'selected' : '' }}
                                                            value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Belize' ? 'selected' : '' }}
                                                            value="America/Belize">(GMT-06:00) Saskatchewan, Central
                                                            America
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Cancun' ? 'selected' : '' }}
                                                            value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City,
                                                            Monterrey
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Chile/EasterIsland' ? 'selected' : '' }}
                                                            value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Chicago' ? 'selected' : '' }}
                                                            value="America/Chicago">(GMT-06:00) Central Time (US &amp;
                                                            Canada)
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/New_York' ? 'selected' : '' }}
                                                            value="America/New_York">(GMT-05:00) Eastern Time (US &amp;
                                                            Canada)
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Havana' ? 'selected' : '' }}
                                                            value="America/Havana">(GMT-05:00) Cuba</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Bogota' ? 'selected' : '' }}
                                                            value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio
                                                            Branco
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Caracas' ? 'selected' : '' }}
                                                            value="America/Caracas">(GMT-04:30) Caracas</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Santiago' ? 'selected' : '' }}
                                                            value="America/Santiago">(GMT-04:00) Santiago</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/La_Paz' ? 'selected' : '' }}
                                                            value="America/La_Paz">(GMT-04:00) La Paz</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Atlantic/Stanley' ? 'selected' : '' }}
                                                            value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Campo_Grande' ? 'selected' : '' }}
                                                            value="America/Campo_Grande">(GMT-04:00) Brazil</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Goose_Bay' ? 'selected' : '' }}
                                                            value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Glace_Bay' ? 'selected' : '' }}
                                                            value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/St_Johns' ? 'selected' : '' }}
                                                            value="America/St_Johns">(GMT-03:30) Newfoundland</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Araguaina' ? 'selected' : '' }}
                                                            value="America/Araguaina">(GMT-03:00) UTC-3</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Montevideo' ? 'selected' : '' }}
                                                            value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Miquelon' ? 'selected' : '' }}
                                                            value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Godthab' ? 'selected' : '' }}
                                                            value="America/Godthab">(GMT-03:00) Greenland</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Argentina' ? 'selected' : '' }}
                                                            value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Sao_Paulo' ? 'selected' : '' }}
                                                            value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'America/Noronha' ? 'selected' : '' }}
                                                            value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Atlantic/Cape_Verde' ? 'selected' : '' }}
                                                            value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Atlantic/Azores' ? 'selected' : '' }}
                                                            value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Belfast' ? 'selected' : '' }}
                                                            value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Dublin' ? 'selected' : '' }}
                                                            value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Lisbon' ? 'selected' : '' }}
                                                            value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/London' ? 'selected' : '' }}
                                                            value="Europe/London">(GMT) Greenwich Mean Time : London
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Africa/Abidjan' ? 'selected' : '' }}
                                                            value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Amsterdam' ? 'selected' : '' }}
                                                            value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern,
                                                            Rome,
                                                            Stockholm, Vienna</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Belgrade' ? 'selected' : '' }}
                                                            value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava,
                                                            Budapest,
                                                            Ljubljana, Prague</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Brussels' ? 'selected' : '' }}
                                                            value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen,
                                                            Madrid, Paris
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Africa/Algiers' ? 'selected' : '' }}
                                                            value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Africa/Windhoek' ? 'selected' : '' }}
                                                            value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Beirut' ? 'selected' : '' }}
                                                            value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Africa/Cairo' ? 'selected' : '' }}
                                                            value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Gaza' ? 'selected' : '' }}
                                                            value="Asia/Gaza">(GMT+02:00) Gaza</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Africa/Blantyre' ? 'selected' : '' }}
                                                            value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Jerusalem' ? 'selected' : '' }}
                                                            value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Minsk' ? 'selected' : '' }}
                                                            value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Damascus' ? 'selected' : '' }}
                                                            value="Asia/Damascus">(GMT+02:00) Syria</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Europe/Moscow' ? 'selected' : '' }}
                                                            value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg,
                                                            Volgograd
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Africa/Addis_Ababa' ? 'selected' : '' }}
                                                            value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Tehran' ? 'selected' : '' }}
                                                            value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Dubai' ? 'selected' : '' }}
                                                            value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Yerevan' ? 'selected' : '' }}
                                                            value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Kabul' ? 'selected' : '' }}
                                                            value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Yekaterinburg' ? 'selected' : '' }}
                                                            value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
                                                        <option value="Asia/Tashkent"
                                                            {{ @$settingsdata->timezone == 'Asia/Tashkent' ? 'selected' : '' }}>
                                                            (GMT+05:00) Tashkent</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Kolkata' ? 'selected' : '' }}
                                                            value="Asia/Kolkata">
                                                            (GMT+05:30) Chennai, Kolkata,
                                                            Mumbai, New Delhi</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Katmandu' ? 'selected' : '' }}
                                                            value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Dhaka' ? 'selected' : '' }}
                                                            value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Novosibirsk' ? 'selected' : '' }}
                                                            value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Rangoon' ? 'selected' : '' }}
                                                            value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Bangkok' ? 'selected' : '' }}
                                                            value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Kuala_Lumpur' ? 'selected' : '' }}
                                                            value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Krasnoyarsk' ? 'selected' : '' }}
                                                            value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Hong_Kong' ? 'selected' : '' }}
                                                            value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong
                                                            Kong,
                                                            Urumqi</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Irkutsk' ? 'selected' : '' }}
                                                            value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Perth' ? 'selected' : '' }}
                                                            value="Australia/Perth">(GMT+08:00) Perth</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Eucla' ? 'selected' : '' }}
                                                            value="Australia/Eucla">(GMT+08:45) Eucla</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Tokyo' ? 'selected' : '' }}
                                                            value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Seoul' ? 'selected' : '' }}
                                                            value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Yakutsk' ? 'selected' : '' }}
                                                            value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Adelaide' ? 'selected' : '' }}
                                                            value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Darwin' ? 'selected' : '' }}
                                                            value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Brisbane' ? 'selected' : '' }}
                                                            value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Hobart' ? 'selected' : '' }}
                                                            value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Vladivostok' ? 'selected' : '' }}
                                                            value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Australia/Lord_Howe' ? 'selected' : '' }}
                                                            value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Etc/GMT-11' ? 'selected' : '' }}
                                                            value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Magadan' ? 'selected' : '' }}
                                                            value="Asia/Magadan">(GMT+11:00) Magadan</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Norfolk' ? 'selected' : '' }}
                                                            value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Asia/Anadyr' ? 'selected' : '' }}
                                                            value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Auckland' ? 'selected' : '' }}
                                                            value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Etc/GMT-12' ? 'selected' : '' }}
                                                            value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.
                                                        </option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Chatham' ? 'selected' : '' }}
                                                            value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Tongatapu' ? 'selected' : '' }}
                                                            value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                                        <option
                                                            {{ @$settingsdata->timezone == 'Pacific/Kiritimati' ? 'selected' : '' }}
                                                            value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
                                                    </select>
                                                    @error('time_zone')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                @if (Auth::user()->type == 1)
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.web_title') }}</label>
                                                        <input type="text" class="form-control" name="web_title"
                                                            value="{{ @$settingsdata != '' ? @$settingsdata->web_title : old('web_title') }}"
                                                            placeholder="{{ trans('labels.web_title') }}">
                                                        @error('web_title')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">{{ trans('labels.copyright') }}</label>
                                                        <input type="text" class="form-control" name="copyright"
                                                            value="{{ @$settingsdata != '' ? @$settingsdata->copyright : old('copyright') }}"
                                                            placeholder="{{ trans('labels.copyright') }}">
                                                        @error('copyright')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label class="form-label">{{ trans('labels.logo') }}</label>
                                                            <input type="file" class="form-control" name="logo">
                                                            <img class="mt-2 hw-70"
                                                                src="{{ @$settingsdata != '' ? helper::image_path(@$settingsdata->logo) : '' }}"
                                                                alt="">
                                                            @error('logo')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label
                                                                class="form-label">{{ trans('labels.favicon') }}</label>
                                                            <input type="file" class="form-control" name="favicon">
                                                            <img class="mt-2 hw-70"
                                                                src="{{ @$settingsdata != '' ? helper::image_path(@$settingsdata->favicon) : '' }}"
                                                                alt="">
                                                            @error('favicon')
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                                <button class="btn btn-secondary mt-4"
                                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save_changes') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="editprofile">
                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <h5 class="text-uppercase">{{ trans('labels.edit_profile') }}</h5>
                                            </div>
                                            <form action="{{ URL::to('admin/users/update-' . Auth::user()->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label class="form-label">{{ trans('labels.name') }}</label>
                                                        <input type="text" class="form-control" name="name"
                                                            value="{{ Auth::user()->name }}"
                                                            placeholder="{{ trans('labels.name') }}">
                                                        @error('name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="form-label">{{ trans('labels.email') }}</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ Auth::user()->email }}"
                                                            placeholder="{{ trans('labels.email') }}">
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="form-label">{{ trans('labels.mobile') }}</label>
                                                        <input type="number" class="form-control" name="mobile"
                                                            value="{{ Auth::user()->mobile }}"
                                                            placeholder="{{ trans('labels.mobile') }}">
                                                        @error('mobile')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label class="form-label">{{ trans('labels.image') }}</label>
                                                        <input type="file" class="form-control" name="profile">
                                                        <img class="rounded-circle mt-2"
                                                            src="{{ helper::image_path(Auth::user()->image) }}"
                                                            alt="" width="70" height="70">
                                                        @error('profile')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn-secondary mt-4"
                                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save_changes') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="changepasssword">
                            <div class="row mb-5">
                                <div class="col-12">
                                    <div class="card border-0 box-shadow">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <h5 class="text-uppercase">{{ trans('labels.change_password') }}</h5>
                                            </div>
                                            <form action="{{ URL::to('admin/users/changepassword') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.current_password') }}</label>
                                                        <input type="password" class="form-control"
                                                            name="current_password"
                                                            value="{{ old('current_password') }}"
                                                            placeholder="{{ trans('labels.current_password') }}">
                                                        @error('current_password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.new_password') }}</label>
                                                        <input type="password" class="form-control" name="new_password"
                                                            value="{{ old('new_password') }}"
                                                            placeholder="{{ trans('labels.new_password') }}">
                                                        @error('new_password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label
                                                            class="form-label">{{ trans('labels.confirm_password') }}</label>
                                                        <input type="password" class="form-control"
                                                            name="confirm_password"
                                                            value="{{ old('confirm_password') }}"
                                                            placeholder="{{ trans('labels.confirm_password') }}">
                                                        @error('confirm_password')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <button class="btn btn-secondary mt-4"
                                                    @if (env('Environment') == 'sendbox') type="button" onclick="myFunction()" @else type="submit" @endif>{{ trans('labels.save_changes') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.basicinfo').on('click', function() {
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
