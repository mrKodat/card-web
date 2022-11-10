<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\User;
use App\Models\Plans;
use App\Helpers\helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentsController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointments::where('vendor_id', Auth::user()->id)->orderByDesc('id')->get();
        return view('admin.appointments.appointments', compact('appointments'));
    }
    public function store_appointments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required|max_digits:10',
            'email' => 'required|email',
            'date' => 'required',
            'time' => 'required',
        ], [
            'name.required' => trans('messages.name_required'),
            'mobile.required' => trans('messages.mobile_required'),
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
            'date.required' => trans('messages.date_required'),
            'time.required' => trans('messages.time_required')
        ]);
        if ($validator->fails()) {
            return redirect(url()->previous() . '#appointment_section')->withErrors($validator)->withInput();
        } else {
            $check_business = helper::checkplan($request->id);
            $v = json_decode(json_encode($check_business));
            if ($v->original->status == '2') {
                $infomsg = $v->original->message;
            } else {
                $infomsg = trans('messages.success');
            }

            $vendor = User::find($request->id);
            $checkplan = Plans::find($vendor->plan_id);
            $total_appointment = Appointments::where('vendor_id', $vendor->id)->count();
            if ($total_appointment < $checkplan->appointment_limit) {
                $appointments = new Appointments;
                $appointments->vendor_id = $vendor->id;
                $appointments->business_id = $request->business_id;
                $appointments->name = $request->name;
                $appointments->email = $request->email;
                $appointments->date = $request->date;
                $appointments->time = $request->time;
                $appointments->mobile = $request->mobile;
                $appointments->save();

                $msg = trans('messages.new_appointment');
                $date = date("d-m-Y", strtotime($request->date));
                $getvendordata = User::select('id', 'name', 'email')->where('id', $vendor->id)->first();
                $sendmail = helper::send_appointment_mail($getvendordata->name, $getvendordata->email, $request->name, $request->email, $request->mobile, $request->time, $date, $msg);
                if ($sendmail == 1) {
                    return redirect()->back()->with("success", trans('messages.success'));
                } else {
                    return redirect()->back()->with("error", trans('messages.error'));
                }
            }
            return redirect()->back()->with(['infomsg' => $infomsg]);
        }
    }
    public function changestatus(Request $request)
    {
        $appointment = Appointments::where('id', $request->id)->first();
        $appointment->status = $request->status;
        $appointment->save();
        if ($request->status == 2) {
            $msg = trans('messages.appointment_accepted');
            $date = date("d-m-Y", strtotime($appointment->date));
            $sendmail = helper::send_appointment_mail($appointment->name, $appointment->email, $appointment->name, $appointment->email, $appointment->mobile, $appointment->time, $date, $msg);
            if ($sendmail == 1) {
                return 1;
            }
        }
        if ($request->status == 3) {
            $msg = trans('messages.appointment_rejected');
            $date = date("d-m-Y", strtotime($appointment->date));
            $sendmail = helper::send_appointment_mail($appointment->name, $appointment->email, $appointment->name, $appointment->email, $appointment->mobile, $appointment->time, $date, $msg);
            if ($sendmail == 1) {
                return 1;
            }
        }
        return 1;
    }
}
