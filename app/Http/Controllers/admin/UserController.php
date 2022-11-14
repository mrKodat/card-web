<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\Businesscard;
use App\Models\BusinessReorderSection;
use App\Models\User;
use App\Models\Timings;
use App\Models\Settings;
use App\Helpers\helper;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userlist = User::with('plans_info', 'business_count', 'appointments_count')->where('type', 2)->orderByDesc('id')->get();
        
        User::where('id', 10)->update(['payment_id' => '', 'plan_id' => '', 'purchase_amount' => '', 'purchase_date' => '', 'payment_type' => '']);
        return view('admin.users.users', compact('userlist'));
    }
    public function userregister(Request $request)
    {
        return view('admin.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required',
            'password' => 'required',
        ], [
            "name.required" => trans('messages.name_required'),
            "email.required" => trans('messages.email_required'),
            "email.email" => trans('messages.valid_email'),
            "mobile.required" => trans('messages.mobile_required'),
            "password.required" => trans('messages.password_required'),
        ]);
        $checkslug = User::where('slug', Str::slug($request->name, '-'))->first();
        if ($checkslug != "") {
            $lastslug = User::select('id')->orderByDesc('id')->first();
            $newslug = Str::slug($request->name . "" . ($lastslug->id + 1), '-');
        } else {
            $newslug = Str::slug($request->name, '-');
        }
        $set_timezone = Settings::where('vendor_id', '1')->first();
        date_default_timezone_set($set_timezone->timezone);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->image = 'default.png';
        $user->login_type = "email";
        $user->type = 2;
        $user->is_verified = 2;
        $user->plan_id = 1;
        $user->payment_type=2;
        $user->purchase_amount=350;
        $user->purchase_date=date("d/m/Y");
        $user->is_available = 1;
        $user->slug = $newslug;
        $user->save();
        return redirect(URL::to('admin'))->with('success', trans('messages.success'));
    }
    public function login(Request $request)
    {
        return view('admin.auth.login');
    }
    public function checklogin(Request $request)
    {
        try{
            
            if( ini_get('allow_url_fopen') ) {
                    $request->validate([
                        'email' => 'required|email',
                        'password' => 'required'
                    ], [
                        'email.required' => trans('messages.email_required'),
                        'email.email' => trans('messages.valid_email'),
                        'password.required' => trans('messages.password_required'),
                    ]);
                    if (Auth::attempt($request->only('email', 'password'))) {
                        if (Auth::user()->type == "1") {
                            if (Auth::user()->is_available == "1") {
                                if (Auth::user()->is_verified == "1") {
                                    return redirect(URL::to('admin/dashboard'));
                                }
                            } else {
                                return redirect()->back()->with('error', trans('messages.blocked'));
                            }
                        } elseif (Auth::user()->type == "2") {
                            if (Auth::user()->is_available == "1") {
                                if (Auth::user()->is_verified == "1") {
                                     if(Auth::user()->plan_id == "1") {
                                         $business = Businesscard::where('vendor_id', Auth::user()->id)->get();
                                        if (count($business) != 0){
                                          return redirect(URL::to('admin/business/business_edit-' . $business->first()->id));
                                        }else{
                                             if (Auth::user()->plan_id != "") {
            $themes = User::with('plans_info')->where('id', Auth::user()->id)->first();
            $themescount = explode(',', $themes['plans_info']->themes_id);
            $business_count = Businesscard::where('vendor_id', Auth::user()->id)->get();
            if (count($business_count) < $themes['plans_info']->order_limit || $themes['plans_info']->order_limit == -1 ) {
                if ($themescount > 0) {
                    $request=Auth::user()->slug;
                    $slug = Str::slug($request . '-');
                    $business = new Businesscard;
                    $business->vendor_id = Auth::user()->id;
                    $business->title = Auth::user()->name;
                    $business->slug = $slug . '-' . rand(0000, 9999);
                    $business->themes_id = "2";
                    $business->web_layout = "1";
                    $business->primary_color = "#2a3042";
                    $business->save();
                    $days = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
                    foreach ($days as $keys => $no) {
                        $data = new Timings;
                        $data->vendor_id = Auth::user()->id;
                        $data->business_id = $business->id;
                        $data->day = $days[$keys];
                        $data->start_time = "12:00 AM";
                        $data->end_time = "12:00 AM";
                        $data->is_closed = "2";
                        $data->save();
                    }
                    $sections = array("basic_info", "contact_info", "business_hours", "appointments", "services", "testimonials", "social_links");
                    $i = 1;
                    foreach ($sections as $keys => $no) {
                        $data = new BusinessReorderSection;
                        $data->vendor_id = Auth::user()->id;
                        $data->business_id = $business->id;
                        $data->name = $sections[$keys];
                        $data->is_available = "1";
                        $data->position = $i;
                        $data->save();
                        $i++;
                    }
                    $business = Businesscard::where('vendor_id', Auth::user()->id)->get();
                                      
                    return redirect(URL::to('admin/business/business_edit-' . $business->first()->id));
                } else {
                    return redirect()->back()->with('error', trans('messages.wrong'));
                }
            } else {
                return redirect()->back()->with('error', "Business limit exceeded");
            }
        } else {
            return redirect()->back()->with('error', trans('messages.subscribe_plan'));
        }
                                        }
                                    
                                    }
                                else{ 
                                    return redirect(URL::to('admin/business'));
                                    
                                }
                                } else {
                                    $otp = rand(000000, 999999);
                                    $name = Auth::user()->name;
                                    $msg = trans('messages.email_verification_code_here');
                                    $logo = Settings::where('vendor_id', 1)->select('logo')->first()->logo;
                                    $data = ['title' => trans('messages.email_code'), 'email' => $request->email, 'name' => $name, 'otp' => $otp, 'msg' => $msg, 'logo' => $logo];
                                    $sendmail = Mail::send('email.otpverification', $data, function ($message) use ($data) {
                                        $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                                        $message->to($data['email']);
                                    });
                                    if ($sendmail == true) {
                                        Auth::user()->otp = $otp;
                                        Auth::user()->save();
                                        session()->put('verification_email', $request->email);
                                        return redirect(URL::to('admin/otp-verification'))->with('success', trans('messages.otp_sent'));
                                    } else {
                                        return redirect()->bak()->with('error', trans('messages' . 'email_error'));
                                    }
                                }
                            } else {
                                return redirect()->back()->with('error', trans('messages.blocked'));
                            }
                        } else {
                            return redirect()->back()->with('error', trans('messages.user_doesnt_exist'));
                        }
                    } else {
                        return redirect()->back()->with('error', trans('messages.invalid_email_password'));
                    }
                
                
                
            }
        }catch(Exception $exception){
            return back()->withError($exception->getMessage())->withInput();    
        }
    }
    
    
    
   
    
    
    
    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        return redirect('admin');
    }
    public function addusers(Request $request)
    {
        return view('admin.users.add');
    }
    public function storeuser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required',
            'password' => 'required',
        ], [
            "name.required" => trans('messages.name_required'),
            "email.required" => trans('messages.email_required'),
            "email.email" => trans('messages.valid_email'),
            "mobile.required" => trans('messages.mobile_required'),
            "password.required" => trans('messages.password_required'),
        ]);
        $checkslug = User::where('slug', Str::slug($request->name, '-'))->first();
        if ($checkslug != "") {
            $lastslug = User::select('id')->orderByDesc('id')->first();
            $newslug = Str::slug($request->name . "" . ($lastslug->id + 1), '-');
        } else {
            $newslug = Str::slug($request->name, '-');
        }
        $set_timezone = Settings::where('vendor_id', '1')->first();
        date_default_timezone_set($set_timezone->timezone);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mobile = $request->mobile;
        $user->image = 'default.png';
        $user->login_type = "email";
        $user->type = 2;
        $user->is_verified = 2;
        $user->is_available = 1;
        $user->slug = $newslug;
        $user->save();
        return redirect(URL::to('admin/users'))->with('success', trans('messages.success'));
    }
    public function getuser(Request $request)
    {
        $userdata = User::find($request->id);
        if (empty($userdata)) {
            abort(404);
        }
        return view('admin.users.edit', compact('userdata'));
    }
    public function updateuser(Request $request)
    {
        $userdata = User::where('id', $request->id)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userdata->id,
            'mobile' => 'required',
        ], [
            "name.required" => trans('messages.name_required'),
            "slug.required" => trans('messages.slug_required'),
            "email.required" => trans('messages.email_required'),
            "email.email" => trans('messages.valid_email'),
            "mobile.required" => trans('messages.mobile_required'),
        ]);
        if ($request->file('profile') != "") {
            $userdata = User::find($request->id);
            $request->validate([
                'profile' => 'image|max:9216',
            ], [
                "profile.image" => trans('messages.enter_image_file'),
                "profile.max" => trans('messages.image_max_size'),
            ]);
            if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $userdata->image))) {
                unlink(storage_path('app/public/admin-assets/images/profile/' . $userdata->image));
            }
            $new_name = 'user-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
            $request->profile->move(storage_path('app/public/admin-assets/images/profile/'), $new_name);
            User::where('id', $request->id)->update(['image' => $new_name]);
        }
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->mobile = $request->mobile;
        $userdata->save();
        return redirect(route('users'))->with('success', trans('messages.success'));
    }
    public function resetpassword(Request $request)
    {
        $data = User::find($request->id);
        if (empty($data)) {
            abort(404);
        }
        return view('admin.users.resetpassword', compact('data'));
    }
    public function reset(Request $request)
    {
        $request->validate([
            'currentpassword' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password',
        ], [
            "currentpassword.required" => trans('messages.current_password_required'),
            'password.required' => trans('messages.password_required'),
            'password_confirmation.required_with' => trans('messages.confirm_password_required'),
            'password_confirmation.same' => trans('messages.new_password_diffrent'),
        ]);
        $data = User::find($request->id);
        if (Hash::check($request->currentpassword, $data->password)) {
            User::where('id', $request->id)->update(['password' => Hash::make($request->password)]);
            return redirect(URL::to('admin/users'))->with('success', trans('messages.success'));
        } else {
            return redirect()->back()->with('error', trans('messages.password_not_match'));
        }
    }
    public function changestatus(Request $request)
    {
        $users = User::where('id', $request->id)->update(['is_available' => $request->status]);
        if ($users) {
            return 1;
        } else {
            return 0;
        }
    }
    public function changepassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required|different:current_password|min:6',
                'confirm_password' => 'required|same:new_password',
            ],
            [
                'current_password.required' => trans('messages.current_password_required'),
                'new_password.required' => trans('messages.new_password_required'),
                'new_password.different' => trans('messages.new_password_diffrent'),
                'confirm_password.required' => trans('messages.confirm_password_required'),
                'confirm_password.same' => trans('messages.confirm_password_same')
            ]
        );
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with("success", trans('messages.success'));
        } else {
            return redirect()->back()->with("error", trans('messages.old_password_invalid'));
        }
    }
    public function verification(Request $request)
    {
        return view('admin.auth.verification');
    }
    public function otpverification(Request $request)
    {
        return view('admin.auth.otp-verification');
    }
    public function otpverify(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ], [
            'otp.required' => trans('messages.otp_required'),
        ]);
        $email = session()->get('verification_email');
        $checkuser = User::where('email', $email)->where('is_verified', 2)->first();
        if (!empty($checkuser)) {
            if ($checkuser->otp == $request->otp) {
                $checkuser->otp = null;
                $checkuser->is_verified = 1;
                $checkuser->save();
                session()->forget('verification_email');
                $settings = new Settings;
                $settings->vendor_id = Auth::user()->id;
                $settings->currency = helper::admin_info()->currency;
                $settings->currency_position = helper::admin_info()->currency_position;
                $settings->timezone = helper::admin_info()->timezone;
                $settings->web_title = helper::admin_info()->web_title;
                $settings->copyright = helper::admin_info()->copyright;
                $settings->logo = "default-logo.png";
                $settings->favicon = "default-favicon.png";
                $settings->save();
                return redirect(URL::to('admin'))->with('success', trans('messages.email_verified'));
            } else {
                return redirect()->back()->with('error', trans('messages.invalid_otp'));
            }
        } else {
            return redirect()->back()->with('error', trans('messages.invalid_user'));
        }
    }
    public function resendotp(Request $request)
    {
        $otp = rand(000000, 999999);
        $email = session()->get('verification_email');
        $name = Auth::user()->name;
        $msg = trans('messages.email_verification_code_here');
        User::where('email', $email)->first();
        $sendmail = helper::verification_mail($email, $name, $msg, $otp);
        if ($sendmail == 1) {
            Auth::user()->otp = $otp;
            Auth::user()->save();
            return redirect()->back()->with('success', trans('messages.otp_sent'));
        } else {
            return redirect()->back()->with('error', trans('messages.email_error'));
        }
    }
    public function forgotpassword(Request $request)
    {
        return view('admin.auth.forgotpassword');
    }
    public function sendpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ], [
            'email.required' => trans('messages.email_required'),
            'email.email' => trans('messages.valid_email'),
        ]);
        $checkuser = User::where('email', $request->email)->where('type', 2)->where('is_available', 1)->first();
        if (!empty($checkuser)) {
            $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
            $name = $checkuser->name;
            $email = $request->email;
            $msg = trans('messages.email_verification_code_here');
            $sendmail = helper::sendpassword_mail($email, $name, $msg, $password);
            if ($sendmail == 1) {
                $checkuser->password = Hash::make($password);
                $checkuser->save();
                return redirect(URL::to('admin'))->with('success', trans('messages.password_sent'));
            } else {
                return redirect()->back()->with('error', trans('messages.email_error'));
            }
        } else {
            return redirect()->back()->with('error', trans('messages.invalid_email'));
        }
    }
    public function vendor_login(Request $request)
    {
        $user = User::find($request->id);
        Auth::login($user);
        session()->put('vendor_login', $user->name);
        return redirect('admin/dashboard')->with('success', trans('messages.success'));
    }

    public function admin_login(Request $request)
    {
        if (session()->has('vendor_login')) {
            $user = User::where('type', 1)->first();
            Auth::login($user);
            session()->forget('vendor_login');
            return redirect('admin/users')->with('success', trans('messages.success'));
        }

        return redirect()->back();
    }

   public function systemverification(Request $request)
    {
       return redirect('/admin')->with('success', 'successfull');
    }
}
