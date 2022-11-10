<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $settingsdata = Settings::where('vendor_id',Auth::user()->id)->first();
        return view('admin.settings.settings', compact('settingsdata'));
    }
    public function store(Request $request)
    {
        if (Settings::count() == 0) {
            $request->validate([
                'currency' => 'required',
                'timezone' => 'required',
                'web_title' => 'required',
                'copyright' => 'required',
                'logo' => 'required',
                'favicon' => 'required',
            ], [
                "currency.required" => trans('messages.currency_required'),
                "timezone.required" => trans('messages.timezone_required'),
                "web_title.required" => trans('messages.web_title_required'),
                "copyright.required" => trans('messages.copyright_required'),
            ]);
            if ($request->file('logo') || $request->file('favicon') != "") {
                $request->validate([
                    'logo' => 'image|max:1024',
                    'favicon' => 'image|max:1024',
                ], [
                    "logo.image" => trans('messages.enter_image_file'),
                    "logo.max" => trans('messages.image_max_size'),
                    "favicon.image" => trans('messages.enter_image_file'),
                    "favicon.max" => trans('messages.image_max_size'),
                ]);
            }
            
            $logo_name = 'logo-' . uniqid() . '.' . $request->logo->getClientOriginalExtension();
            $favicon_name = 'favicon-' . uniqid() . '.' . $request->favicon->getClientOriginalExtension();
            $request->logo->move(storage_path('app/public/admin-assets/images/logo'), $logo_name);
            $request->favicon->move(storage_path('app/public/admin-assets/images/favicon'), $favicon_name);
            $settings = new Settings;
            $settings->currency = $request->currency;
            $settings->currency_position = $request->currency_position;
            $settings->timezone = $request->timezone;
            $settings->web_title = $request->web_title;
            $settings->copyright = $request->copyright;
            $settings->logo = $logo_name;
            $settings->favicon = $favicon_name;
            $settings->save();
            return redirect()->back()->with('success', trans('messages.success'));
        } else {
            $settingsdata = Settings::where('vendor_id', Auth::user()->id)->first();
            $request->validate([
                'currency' => 'required',
                'timezone' => 'required',
                'web_title' => 'required',
                'copyright' => 'required',
            ], [
                "currency.required" => trans('messages.currency_required'),
                "timezone.required" => trans('messages.timezone_required'),
                "web_title.required" => trans('messages.web_title_required'),
                "copyright.required" => trans('messages.copyright_required'),
            ]);
            if ($request->file('logo') || $request->file('favicon') != "") {
                $request->validate([
                    'logo' => 'image|max:1024',
                    'favicon' => 'image|max:1024',
                ], [
                    "logo.image" => trans('messages.enter_image_file'),
                    "logo.max" => trans('messages.image_max_size'),
                    "favicon.image" => trans('messages.enter_image_file'),
                    "favicon.max" => trans('messages.image_max_size'),
                ]);
            }
            if ($request->hasFile('logo')) {
                if (!empty($settingsdata->logo) && Str::contains($settingsdata->logo, 'default')) {
                    if (file_exists(storage_path('app/public/admin-assets/images/logo/' . $settingsdata->logo))) {
                        unlink(storage_path('app/public/admin-assets/images/logo/' . $settingsdata->logo));
                    }
                }
                $logo_name = 'logo-' . uniqid() . '.' . $request->logo->getClientOriginalExtension();
                $request->logo->move(storage_path('app/public/admin-assets/images/logo'), $logo_name);
                $settingsdata->logo = $logo_name;
            }
            if ($request->hasFile('favicon')) {
                if (!empty($settingsdata->favicon) && Str::contains($settingsdata->favicon, 'default')) {
                    if (file_exists(storage_path('app/public/admin-assets/images/favicon/' . $settingsdata->favicon))) {
                        unlink(storage_path('app/public/admin-assets/images/favicon/' . $settingsdata->favicon));
                    }
                }
                $favicon_name = 'favicon-' . uniqid() . '.' . $request->favicon->getClientOriginalExtension();
                $request->favicon->move(storage_path('app/public/admin-assets/images/favicon'), $favicon_name);
                $settingsdata->favicon = $favicon_name;
            }
            $settingsdata->currency = $request->currency;
            $settingsdata->currency_position = $request->currency_position;
            $settingsdata->timezone = $request->timezone;
            $settingsdata->web_title = $request->web_title;
            $settingsdata->copyright = $request->copyright;
            $settingsdata->save();
            return redirect()->back()->with('success', trans('messages.success'));
        }
    }
}
