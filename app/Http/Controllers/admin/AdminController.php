<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plans;
use App\Models\Transaction;
use App\Models\Businesscard;
use App\Models\Appointments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users_count = User::where('type', 2)->count();
        $plans_count = Plans::count();
        $transactions_count = Transaction::count();
        $business_count = Businesscard::where('vendor_id', Auth::user()->id)->count();
        $appointments_count = Appointments::where('vendor_id', Auth::user()->id)->count();
        if (Auth::user()->type == 2) {
            $subscription_sum = Transaction::where('vendor_id', Auth::user()->id)->sum('amount');
        } else {
            $subscription_sum = Transaction::sum('amount');
        }

        // Total Appointment Chart Start
        if (Auth::user()->type == 2) {
            $subscription_years = Transaction::select(DB::raw("YEAR(created_at) as year"))->where('vendor_id', Auth::user()->id)->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            if ($request->has('subscription_year') && $request->subscription_year != "") {
                $subscription_year = $request->subscription_year;
            } else {
                $subscription_year = date('Y');
            }
            $subscription_chart_data = Transaction::select(DB::raw("YEAR(created_at) as year"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("SUM(amount) as total_amount"))->where('vendor_id', Auth::user()->id)->whereYear('created_at', $subscription_year)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_amount', 'month_name');
        } else {
            $subscription_years = Transaction::select(DB::raw("YEAR(created_at) as year"))->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            if ($request->has('subscription_year') && $request->subscription_year != "") {
                $subscription_year = $request->subscription_year;
            } else {
                $subscription_year = date('Y');
            }
            $subscription_chart_data = Transaction::select(DB::raw("YEAR(created_at) as year"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("SUM(amount) as total_amount"))->whereYear('created_at', $subscription_year)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_amount', 'month_name');
        }
        $subscription_labels = $subscription_chart_data->keys();
        $subscription_data = $subscription_chart_data->values();
        // Total Revenue Chart End



        // Total User Chart Start
        if (Auth::user()->type == 2) {
            $user_years = Appointments::select(DB::raw("YEAR(created_at) as year"))->where('vendor_id', Auth::user()->id)->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            if ($request->has('user_year') && $request->user_year != "") {
                $user_year = $request->user_year;
            } else {
                $user_year = date('Y');
            }
            $user_chart_data = Appointments::select(DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("COUNT(id) as total_user"))->where('vendor_id', Auth::user()->id)->whereYear('created_at', $user_year)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_user', 'month_name');
        } else {
            $user_years = User::select(DB::raw("YEAR(created_at) as year"))->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            if ($request->has('user_year') && $request->user_year != "") {
                $user_year = $request->user_year;
            } else {
                $user_year = date('Y');
            }
            $user_chart_data = User::select(DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("COUNT(id) as total_user"))->where('type', 2)->whereYear('created_at', $user_year)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_user', 'month_name');
        }
        $user_labels = $user_chart_data->keys();
        $user_data = $user_chart_data->values();
        // Total User Chart End



        // Total Business Chart Start
        if (Auth::user()->type == 2) {
            $business_years = Businesscard::select(DB::raw("YEAR(created_at) as year"))->where('vendor_id', Auth::user()->id)->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            if ($request->has('business_year') && $request->business_year != "") {
                $business_year = $request->business_year;
            } else {
                $business_year = date('Y');
            }
            $business_chart_data = Businesscard::select(DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("COUNT(id) as total_business"))->where('vendor_id', Auth::user()->id)->whereYear('created_at', $business_year)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_business', 'month_name');
        } else {
            $business_years = Businesscard::select(DB::raw("YEAR(created_at) as year"))->groupBy(DB::raw("YEAR(created_at)"))->orderByDesc('created_at')->get();
            if ($request->has('business_year') && $request->business_year != "") {
                $business_year = $request->business_year;
            } else {
                $business_year = date('Y');
            }
            $business_chart_data = Businesscard::select(DB::raw("MONTHNAME(created_at) as month_name"), DB::raw("COUNT(id) as total_business"))->whereYear('created_at', $business_year)->orderBy('created_at')->groupBy(DB::raw("MONTHNAME(created_at)"))->pluck('total_business', 'month_name');
        }
        $business_labels = $business_chart_data->keys();
        $business_data = $business_chart_data->values();
        // Total Business Chart End


        if ($request->ajax()) {
            return response()->json(['subscription_data' => $subscription_data, 'subscription_labels' => $subscription_labels, 'business_data' => $business_data, 'business_labels' => $business_labels, 'user_data' => $user_data, 'user_labels' => $user_labels], 200);
        } else {
            return view('admin.index', compact('users_count', 'plans_count', 'transactions_count', 'business_count', 'appointments_count', 'subscription_sum', 'subscription_years', 'subscription_chart_data', 'subscription_data', 'subscription_labels', 'user_years', 'user_chart_data', 'user_data', 'user_labels', 'business_years', 'business_chart_data', 'business_data', 'business_labels'));
        }
    }
}
