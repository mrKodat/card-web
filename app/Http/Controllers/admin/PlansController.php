<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plans;
use App\Models\Paymentmethod;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Settings;
use App\Models\SystemAddons;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Stripe;

class PlansController extends Controller
{
    public function index(Request $request)
    {
        $planlist = Plans::orderBy('price');
        if (Auth::user()->type == 2) {
            $planlist = $planlist->where('is_available', 1);
        }
        $planlist = $planlist->get();
        return view('admin.plans.plans', compact('planlist'));
    }
    public function addplans(Request $request)
    {
        Plans::where('id', 3)->delete();
        return view('admin.plans.add');
    }
    public function store(Request $request)
    {

        $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_duration' => 'required',
            'plan_max_business' => 'required',
            'plan_appointment_limit' => 'required',
            'plan_features' => 'required',
            "themecheckbox" => 'required'
        ], [
            "plan_name.required" => trans('messages.plan_required'),
            "plan_price.required" => trans('messages.plan_price_required'),
            "plan_duration.required" => trans('messages.plan_duration_required'),
            "plan_features.required" => trans('messages.plan_features_required'),
            "plan_max_business.required" => trans('messages.plan_max_business_required'),
            "plan_appointment_limit.required" => trans('messages.plan_appointment_limit_required'),
            "themecheckbox.required" => trans('messages.themes_required'),
        ]);

        $free_plan = Plans::where('price', 0)->first();
        if ($free_plan->price == $request->plan_price) {
            return redirect()->back()->with('error', trans('messages.plan_already_exist'));
        }
        $plan = new Plans;
        $plan->name = $request->plan_name;
        $plan->price = $request->plan_price;
        $plan->duration = $request->plan_duration;
        $plan->order_limit = $request->plan_max_business;
        $plan->appointment_limit = $request->plan_appointment_limit;
        $plan->is_available = 1;
        $plan->description = $request->plan_description;
        $plan->features = implode('|', $request->plan_features);
        $plan->themes_id = implode(',', $request->themecheckbox);
        $plan->save();
        return redirect(URL::to('admin/plans'))->with('success', trans('messages.success'));
    }
    public function getplan(Request $request)
    {
        $plandata = Plans::find($request->id);
        if (empty($plandata)) {
            abort(404);
        }
        return view('admin.plans.edit', compact('plandata'));
    }
    public function updateplan(Request $request)
    {
        $plandata = Plans::where('id', $request->id)->first();
        $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_duration' => 'required',
            'plan_max_business' => 'required',
            'plan_appointment_limit' => 'required',
            'plan_features' => 'required',
            "themecheckbox" => 'required'
        ], [
            "plan_name.required" => trans('messages.plan_required'),
            "plan_price.required" => trans('messages.plan_price_required'),
            "plan_duration.required" => trans('messages.plan_duration_required'),
            "plan_features.required" => trans('messages.plan_features_required'),
            "plan_max_business.required" => trans('messages.plan_max_business_required'),
            "plan_appointment_limit.required" => trans('messages.plan_appointment_limit_required'),
            "themecheckbox.required" => trans('messages.themes_required'),
        ]);
        $plandata->name = $request->plan_name;
        $plandata->price = $request->plan_price;
        $plandata->duration = $request->plan_duration;
        $plandata->order_limit = $request->plan_max_business;
        $plandata->appointment_limit = $request->plan_appointment_limit;
        $plandata->description = $request->plan_description;
        $plandata->features = implode('|', $request->plan_features);
        $plandata->themes_id = implode(',', $request->themecheckbox);
        $plandata->save();
        return redirect(URL::to('admin/plans'))->with('success', trans('messages.success'));
    }
    public function changestatus(Request $request)
    {
        $plans = Plans::where('id', $request->id)->update(['is_available' => $request->status]);
        if ($plans) {
            return 1;
        } else {
            return 0;
        }
    }
    public function selectplan(Request $request)
    {
        $plan = Plans::find($request->id);
        if (empty($plan)) {
            abort(404);
        }
        if (Auth::user()->plan_id == "" && $plan->price == 0) {
            User::where('id', Auth::user()->id)->update(['plan_id' => $plan->id, 'purchase_amount' => $plan->price, 'payment_type' => '0', 'purchase_date' => date("Y-m-d h:i:sa")]);
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            $paymentmethod = Paymentmethod::where('vendor_id', 1)->where('is_available', 1)->get();
            return view('admin.plans.buynow', compact('plan', 'paymentmethod'));
        }
    }
    public function buyplan(Request $request)
    {
        $settingsdata = Settings::where('id', 1)->first();
        date_default_timezone_set($settingsdata->timezone);
        $payment_id = "";
        if ($request->payment_type == 3 or $request->payment_type == 4 or $request->payment_type == 5 or $request->payment_type == 6) {
            $payment_id = $request->payment_id;
        }
        if ($request->payment_type == 4) {
            $paymentmethod = Paymentmethod::where('id', $request->payment_type)->where('is_available', 1)->first();
            $stripekey = $paymentmethod->secret_key;
            try {
                Stripe\Stripe::setApiKey($stripekey);
                $charge = Stripe\Charge::create([
                    'amount' => $request->amount * 100,
                    'currency' => 'usd',
                    'description' => 'Example charge',
                    'source' => $request->payment_id,
                ]);
                $payment_id = $charge->id;
            } catch (Exception $e) {
                return response()->json(['status' => 0, 'message' => $e->getMessage()], 200);
            }
        }
        User::where('id', Auth::user()->id)->update(['payment_id' => @$payment_id, 'plan_id' => $request->plan_id, 'purchase_amount' => $request->amount, 'payment_type' => $request->payment_type, 'purchase_date' => date("Y-m-d h:i:sa"),]);

        $transaction = new Transaction;
        $transaction->vendor_id = Auth::user()->id;
        $transaction->plan_id = $request->plan_id;
        $transaction->payment_type = $request->payment_type;
        $transaction->payment_id = $payment_id;
        $transaction->amount = $request->amount;
        $transaction->save();
        if (!empty($payment_id)) {
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } else {
            return response()->json(['status' => 2, 'message' => trans('messages.payment_failed')], 200);
        }
    }
}
