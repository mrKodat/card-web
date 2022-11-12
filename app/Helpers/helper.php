<?php

namespace App\Helpers;

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\BusinessReorderSection;
use App\Models\User;
use App\Models\Businesscard;
use App\Models\Appointments;
use App\Models\Plans;

class helper
{
    public static function image_path($image)
    {
        $path = url('/storage/app/public/admin-assets/images/' . $image);
        if (Str::contains($image, 'authformbgimage')) {
            $path = url('/storage/app/public/admin-assets/images/' . $image);
        }
        if (Str::contains($image, 'icon')) {
            $path = url('/storage/app/public/admin-assets/icons/' . $image);
        }
        if (Str::contains($image, 'user') || Str::contains($image, 'profile')) {
            $path = url('/storage/app/public/admin-assets/images/profile/' . $image);
        }
        if (Str::contains($image, 'og_image')) {
            $path = url('/storage/app/public/admin-assets/images/og_image/' . $image);
        }
        if (Str::contains($image, 'banner')) {
            $path = url('/storage/app/public/admin-assets/images/banner/' . $image);
        }
        if (Str::contains($image, 'service')) {
            $path = url('/storage/app/public/admin-assets/images/service/' . $image);
        }
        if (Str::contains($image, 'testimonial')) {
            $path = url('/storage/app/public/admin-assets/images/testimonial/' . $image);
        }
        if (Str::contains($image, 'favicon')) {
            $path = url('/storage/app/public/admin-assets/images/favicon/' . $image);
        }
        if (Str::contains($image, 'logo')) {
            $path = url('/storage/app/public/admin-assets/images/logo/' . $image);
        }
        if (Str::contains($image, 'cod') || Str::contains($image, 'wallet') || Str::contains($image, 'razorpay') || Str::contains($image, 'stripe') || Str::contains($image, 'flutterwave') || Str::contains($image, 'paystack')) {
            $path = url('/storage/app/public/admin-assets/images/payment/' . $image);
        }
        return $path;
    }
    public static function admin_info()
    {
        $data = Settings::where('vendor_id', 1)->first();
        return $data;
    }
    public static function vendor_info()
    {
        $data = Settings::where('vendor_id', @Auth::user()->id)->first();
        if ($data == "") {
            $data = Settings::where('vendor_id', 1)->first();
        }
        return $data;
    }
    public static function currency_format($price)
    {
        $price = floatval($price);
        if (helper::vendor_info()->currency_position == "1") {
            return helper::vendor_info()->currency . number_format($price, 2);
        }
        if (helper::vendor_info()->currency_position == "2") {
            return number_format($price, 2) . helper::vendor_info()->currency;
        }
    }
    public static function date_format($date)
    {
        return date("d M, Y", strtotime($date));
    }
    public static function date_time_format($date)
    {
        return date("j F Y, g:i a", strtotime($date));
    }
    public static function number_format($number)
    {
        return number_format($number, 2);
    }
    public static function send_appointment_mail($vendor_name, $vendor_email, $name, $email, $mobile, $time, $date, $msg)
    {
        $data = ['vendorname' => $vendor_name, 'vendoremail' => $vendor_email, 'logo' => @helper::admin_info()->logo, 'fullname' => $name, 'email' => $email, 'mobile' => $mobile, 'time' => $time, 'date' => $date, 'msg' => $msg];
        try {
            Mail::send('email.appointment', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject(trans('labels.new_appointment'));
                $message->to($data['vendoremail']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function verification_mail($email, $name, $msg, $otp)
    {
        $data = ['title' => trans('messages.email_code'), 'email' => $email, 'name' => $name, 'otp' => $otp, 'msg' => $msg, 'logo' => @Helper::admin_info()->logo];
        try {
            Mail::send('email.otpverification', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function sendpassword_mail($email, $name, $msg, $password)
    {
        $data = ['title' => trans('messages.new_password'), 'email' => $email, 'password' => $password, 'name' => $name, 'msg' => $msg, 'logo' => @Helper::admin_info()->logo];
        try {
            Mail::send('email.sendpassword', $data, function ($message) use ($data) {
                $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                $message->to($data['email']);
            });
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }
    public static function section_aviable($section, $business_id, $vendor_id)
    {
        $data = BusinessReorderSection::select('is_available')->where('name', $section)->where('business_id', $business_id)->where('vendor_id', $vendor_id)->first();

        return $data->is_available;
    }
    public static function check_plan_expire($purchase_date, $duration)
    {
        $now = date('Y-m-d');
        $purchasedate = date('Y-m-d', strtotime($purchase_date));
        if ($duration == '1') {
            $exdate = date('Y-m-d', strtotime($purchasedate . ' +30 days'));
        }
        if ($duration == '2') {
            $exdate = date('Y-m-d', strtotime($purchasedate . ' +90 days'));
        }
        if ($duration == '3') {
            $exdate = date('Y-m-d', strtotime($purchasedate . ' +180 days'));
        }
        if ($duration == '4') {
            $exdate = date('Y-m-d', strtotime($purchasedate . ' +365 days'));
        }
        if ($purchasedate <= $now && $now <= $exdate) {
            $status = 1;
        } else {
            $status = 2;
        }

        return ['status' => $status, 'exdate' => $exdate];
    }
    public static function get_icon_color($title)
    {
        $color = 'text-primary';
        if ($title == 'Phone') {
            $color = 'phone-icon';
        } elseif ($title == 'Website') {
            $color = 'website-icon';
        } elseif ($title == 'Address') {
            $color = 'location-icon';
        } elseif ($title == 'Email') {
            $color = 'email-icon';
        } elseif ($title == 'Facebook') {
            $color = 'facebook-icon';
        } elseif ($title == 'Instagram') {
            $color = 'insta-icon';
        } elseif ($title == 'Linkdin') {
            $color = 'linkedin-icon';
        } elseif ($title == 'Twitter') {
            $color = 'twitter-icon';
        } elseif ($title == 'Youtube') {
            $color = 'youtube-icon';
        } elseif ($title == 'Behance') {
            $color = 'behance-icon';
        } elseif ($title == 'Dribble') {
            $color = 'dribbble-icon';
        } elseif ($title == 'Figma') {
            $color = 'figma-icon';
        } elseif ($title == 'Messenger') {
            $color = 'messenger-icon';
        } elseif ($title == 'Pinterest') {
            $color = 'printrest-icon';
        } elseif ($title == 'Tik-tok') {
            $color = 'tiktok-icon';
        } elseif ($title == 'Whatsapp') {
            $color = 'whatsapp-icon';
        } elseif ($title == 'Website') {
            $color = 'website-icon';
        }

        return $color;
    }






    public static function checkplan($id)
    {
        date_default_timezone_set(Helper::vendor_info()->timezone);
        $business_info = User::where('id', $id)->first();
        if ($business_info->is_verified == "1") {
            if ($business_info->is_available == "2") {
                return response()->json(['status' => 2, 'message' => trans('labels.business_is_unavailable')], 200);
            }
            $checkplan = Plans::where('id', $business_info->plan_id)->first();
            $check_appointment = Appointments::where('vendor_id', $id)->count();
            $check_business = Businesscard::where('vendor_id', $id)->count();

            if (!empty($checkplan)) {

                if (@$checkplan->duration == "1") {
                    $purchasedate = date("Y-m-d", strtotime($business_info->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' + 30 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->duration == "2") {
                    $purchasedate = date("Y-m-d", strtotime($business_info->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +90 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->duration == "3") {
                    $purchasedate = date("Y-m-d", strtotime($business_info->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +180 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->duration == "4") {
                    $purchasedate = date("Y-m-d", strtotime($business_info->purchase_date));
                    $exdate = date('Y-m-d', strtotime($purchasedate . ' +365 days'));
                    $currentdate = date('Y-m-d');
                    if ($currentdate > $exdate) {
                        return response()->json(['status' => 2, 'message' => trans('labels.expired')], 200);
                    }
                }
                if (@$checkplan->order_limit != -1) {
                    if (@$check_business >= @$checkplan->order_limit) {
                        return response()->json(['status' => 2, 'message' => trans('labels.business_unit_exceeded')], 200);
                    } else {
                        if (@$checkplan->appointment_limit != -1) {
                            if ($check_appointment >= @$checkplan->appointment_limit) {
                                return response()->json(['status' => 2, 'message' => trans('labels.appointment_limit_exceeded')], 200);
                            } else {
                                return response()->json(['status' => 1], 200);
                            }
                        } else {
                            return response()->json(['status' => 1], 200);
                        }
                    }
                } else {
                    return response()->json(['status' => 1], 200);
                }
            } else {
                return response()->json(['status' => 2, 'message' => trans('labels.plan_is_unavailable')], 200);
            }
        } else {
            return response()->json(['status' => 1], 200);
        }
    }
}
