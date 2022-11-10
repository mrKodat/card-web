<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Businesscard;
use App\Models\Businesscontact;
use App\Models\Timings;
use App\Models\AppointmentSlots;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\BusinessReorderSection;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $business = Businesscard::where('vendor_id', Auth::user()->id)->get();
        return view('admin.business.business', compact('business'));
    }
    public function business_add(Request $request)
    {
        if (Auth::user()->plan_id != "") {
            $themes = User::with('plans_info')->where('id', Auth::user()->id)->first();
            $themescount = explode(',', $themes['plans_info']->themes_id);
            $business_count = Businesscard::where('vendor_id', Auth::user()->id)->get();
            if (count($business_count) < $themes['plans_info']->order_limit || $themes['plans_info']->order_limit == -1 ) {
                if ($themescount > 0) {
                    $request->validate([
                        "business_name" => "required"
                    ], [
                        "business_name.required" => trans('messages.business_name_required')
                    ]);
                    $slug = Str::slug($request->business_name, '-');
                    $business = new Businesscard;
                    $business->vendor_id = Auth::user()->id;
                    $business->title = $request->business_name;
                    $business->slug = $slug . '-' . rand(0000, 9999);
                    $business->themes_id = "1";
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
                    return redirect(URL::to('admin/business'))->with('success', 'success');
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
    public function business_edit(Request $request)
    {
        $businessdata = Businesscard::find($request->id);
        if(empty($businessdata)){
            abort(404);
        }
        $timingsdata = Timings::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->get();
        $contact_info_data = Businesscontact::where('business_id', $request->id)->where('vendor_id', Auth::user()->id)->where('type', 1)->get();
        $social_link_data = Businesscontact::where('business_id', $request->id)->where('vendor_id', Auth::user()->id)->where('type', 2)->get();
        $appontment_slots = AppointmentSlots::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->get();
        $service_cards = Service::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->get();
        $testimonials = Testimonial::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->get();
        $reorder_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->orderBy('position')->get();
        $contact_info_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->where('name', 'contact_info')->select('id', 'is_available')->first();
        $business_hours_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->where('name', 'business_hours')->select('id', 'is_available')->first();
        $appointments_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->where('name', 'appointments')->select('id', 'is_available')->first();
        $services_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->where('name', 'services')->select('id', 'is_available')->first();
        $testimonials_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->where('name', 'testimonials')->select('id', 'is_available')->first();
        $social_links_section = BusinessReorderSection::where('vendor_id', Auth::user()->id)->where('business_id', $request->id)->where('name', 'social_links')->select('id', 'is_available')->first();

        $themes = User::with('plans_info')->where('id', Auth::user()->id)->first();
        $themescount = explode(',', $themes['plans_info']->themes_id);
        
        return view('admin.business.edit', compact('businessdata', 'timingsdata', 'contact_info_data', 'social_link_data', 'appontment_slots', 'service_cards', 'testimonials', 'reorder_section', 'contact_info_section', 'business_hours_section', 'appointments_section', 'services_section', 'testimonials_section', 'social_links_section', 'themescount'));
    }
    public function business_delete(Request $request)
    {
        Timings::where('business_id', $request->id)->delete();
        Businesscontact::where('business_id', $request->id)->delete();
        AppointmentSlots::where('business_id', $request->id)->delete();
        BusinessReorderSection::where('business_id', $request->id)->delete();
        $businessdata = Businesscard::where('id', $request->id)->first();
        if (!empty($businessdata->profile_image)) {
            if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $businessdata->profile_image))) {
                unlink(storage_path('app/public/admin-assets/images/profile/' . $businessdata->profile_image));
            }
        }
        if (!empty($businessdata->banner_image)) {
            if (file_exists(storage_path('app/public/admin-assets/images/banner/' . $businessdata->banner_image))) {
                unlink(storage_path('app/public/admin-assets/images/banner/' . $businessdata->banner_image));
            }
        }
        if (!empty($businessdata->favicon)) {
            if (file_exists(storage_path('app/public/admin-assets/images/favicon/' . $businessdata->favicon))) {
                unlink(storage_path('app/public/admin-assets/images/favicon/' . $businessdata->favicon));
            }
        }
        if (!empty($businessdata->og_image)) {
            if (file_exists(storage_path('app/public/admin-assets/images/og_image/' . $businessdata->og_image))) {
                unlink(storage_path('app/public/admin-assets/images/og_image/' . $businessdata->og_image));
            }
        }
        Businesscard::where('id', $request->id)->delete();
        $servicedata = Service::where('business_id', $request->id)->get();
        foreach ($servicedata as $key => $no) {
            if (!empty($servicedata[$key]->image)) {
                if (file_exists(storage_path('app/public/admin-assets/images/service/' . $servicedata[$key]->image))) {
                    unlink(storage_path('app/public/admin-assets/images/service/' . $servicedata[$key]->image));
                }
            }
        }
        Service::where('business_id', $request->id)->delete();
        $testimonialdata = Testimonial::where('business_id', $request->id)->get();
        foreach ($testimonialdata as $key => $no) {
            if (!empty($testimonialdata[$key]->image)) {
                if (file_exists(storage_path('app/public/admin-assets/images/testimonial/' . $testimonialdata[$key]->image))) {
                    unlink(storage_path('app/public/admin-assets/images/testimonial/' . $testimonialdata[$key]->image));
                }
            }
        }
        Testimonial::where('business_id', $request->id)->delete();
        return 1;
    }
    public function store_basic_info(Request $request)
    {
        $businessdata = Businesscard::where('id', $request->id)->first();
        $slug = str_replace(' ', '', $request->personalized_link);
        $request->validate([
            'title' => 'required',
            'sub_title' => 'required',
            'designation' => 'required',
            'personalized_link' => 'required|unique:business_card,slug,' . $businessdata->id,
            'description' => 'required',
            'copyright' => 'required',
            'themecheckbox' => 'required',
        ], [
            "title.required" => trans('messages.business_name_required'),
            "sub_title.required" => trans('messages.sub_title_required'),
            "designation.required" => trans('messages.designation_required'),
            "personalized_link.required" => trans('messages.personalized_link_required'),
            "description.required" => trans('messages.description_required'),
            "copyright.required" => trans('messages.copyright_required'),
            "themecheckbox.required" => trans('messages.themes_required'),
        ]);
        if ($request->file('profile') != "") {
            $request->validate([
                'profile' => 'required|image|max:500',
            ], [
                "profile.image" => trans('messages.enter_image_file'),
                "profile.max" => trans('messages.image_max_size'),
            ]);
            if (!empty($businessdata->profile_image) && Str::contains($businessdata->profile_image, 'default')) {
                if (file_exists(storage_path('app/public/admin-assets/images/profile/' . $businessdata->profile_image))) {
                    unlink(storage_path('app/public/admin-assets/images/profile/' . $businessdata->profile_image));
                }
            }
            $profile_name = 'profile-' . uniqid() . '.' . $request->profile->getClientOriginalExtension();
            $request->profile->move(storage_path('app/public/admin-assets/images/profile'), $profile_name);
            $businessdata->profile_image = $profile_name;
        }
        if ($request->file('banner') != "") {
            $request->validate([
                'banner' => 'required|image|max:500',
            ], [
                "banner.image" => trans('messages.enter_image_file'),
                "banner.max" => trans('messages.image_max_size'),
            ]);
            if (!empty($businessdata->banner_image) && Str::contains($businessdata->banner_image, 'default')) {
                if (file_exists(storage_path('app/public/admin-assets/images/banner/' . $businessdata->banner_image))) {
                    unlink(storage_path('app/public/admin-assets/images/banner/' . $businessdata->banner_image));
                }
            }
            $banner_name = 'banner-' . uniqid() . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(storage_path('app/public/admin-assets/images/banner'), $banner_name);
            $businessdata->banner_image = $banner_name;
        }
        if ($request->file('favicon') != "") {
            $request->validate([
                'favicon' => 'required|image|max:500',
            ], [
                "favicon.image" => trans('messages.enter_image_file'),
                "favicon.max" => trans('messages.image_max_size'),
            ]);
            if (!empty($businessdata->favicon) && Str::contains($businessdata->favicon, 'default')) {
                if (file_exists(storage_path('app/public/admin-assets/images/favicon/' . $businessdata->favicon))) {
                    unlink(storage_path('app/public/admin-assets/images/favicon/' . $businessdata->favicon));
                }
            }
            $favicon_name = 'favicon-' . uniqid() . '.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(storage_path('app/public/admin-assets/images/favicon'), $favicon_name);
            $businessdata->favicon = $favicon_name;
        }
        $businessdata->title = $request->title;
        $businessdata->sub_title = $request->sub_title;
        $businessdata->designation = $request->designation;
        $businessdata->slug = $slug;
        $businessdata->description = $request->description;
        $businessdata->copyright = $request->copyright;
        $businessdata->themes_id = $request->themecheckbox;
        $businessdata->web_layout = $request->web_layout;
        $businessdata->primary_color = $request->primary_color;
        $businessdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_contact_info(Request $request)
    {
        if ($request->has('contact_info_section')) {
            $data = BusinessReorderSection::find($request->contact_info_id);
            $data->is_available = "1";
            $data->save();
        } else {
            $data = BusinessReorderSection::find($request->contact_info_id);
            $data->is_available = "2";
            $data->save();
        }
        if ($request->has('title')) {
            $contact_info = $request->contact_info;
            $icon = $request->icon;
            $title = $request->title;
            foreach ($title as $key => $no) {
                $input = new Businesscontact;
                $input->vendor_id = Auth::user()->id;
                $input->business_id = $request->id;
                $input->type = "1";
                $input->title = $title[$key];
                $input->contact_info = $contact_info[$key];
                $input->icon = $icon[$key];
                $input->save();
            }
        }
        if ($request->has('edit_contact_info_id')) {
            $edit_contact_info_id = $request->edit_contact_info_id;
            $edit_contact_info = $request->edit_contact_info;
            $edit_icon = $request->edit_icon;
            $edit_title = $request->edit_title;
            foreach ($edit_contact_info_id as $keys => $no) {
                $input = Businesscontact::where('id', $no)->first();
                $input->contact_info = $edit_contact_info[$keys];
                $input->icon = $edit_icon[$keys];
                $input->title = $edit_title[$keys];
                $input->save();
            }
        };
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_contact_field(Request $request)
    {
        $contact_info = Businesscontact::find($request->id);
        if(empty($contact_info)){
            abort(404);
        }
        $contact_info->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_business_hours(Request $request)
    {
        $day = $request->day;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $is_closed = $request->closed;
        if ($request->has('business_hours_section')) {
            $data = BusinessReorderSection::find($request->business_hours_section_id);
            $data->is_available = "1";
            $data->save();
        } else {
            $data = BusinessReorderSection::find($request->business_hours_section_id);
            $data->is_available = "2";
            $data->save();
        }
        foreach ($day as $keys => $no) {
            $input['day'] = $day[$keys];
            $input['start_time'] = $start_time[$keys];
            $input['end_time'] = $end_time[$keys];
            $input['is_closed'] = $is_closed[$keys];
            Timings::where('business_id', $request->business_id)->where('day', $no)->update($input);
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_appointments_slot(Request $request)
    {
        if ($request->has('appointments_section')) {
            $data = BusinessReorderSection::find($request->appointments_section_id);
            $data->is_available = "1";
            $data->save();
        } else {
            $data = BusinessReorderSection::find($request->appointments_section_id);
            $data->is_available = "2";
            $data->save();
        }
        // To Store Business Appointment Slots
        if ($request->has('start_time')) {
            $start_time = $request->start_time;
            $end_time = $request->end_time;
            foreach ($start_time as $key => $no) {
                $input = new AppointmentSlots;
                $input->vendor_id = Auth::user()->id;
                $input->business_id = $request->id;
                $input->start_time = $start_time[$key];
                $input->end_time = $end_time[$key];
                $input->save();
            }
        }
        // To Update Business Appointment Slots
        if ($request->has('edit_slot_id')) {
            $edit_slot_id = $request->edit_slot_id;
            $edit_start_time = $request->edit_start_time;
            $edit_end_time = $request->edit_end_time;
            foreach ($start_time as $key => $no) {
                $input = AppointmentSlots::where('id', $edit_slot_id)->first();
                $input->start_time = $edit_start_time[$key];
                $input->end_time = $edit_end_time[$key];
                $input->save();
            }
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_appointments_slot(Request $request)
    {
        $appointment_slot = AppointmentSlots::find($request->id);
        if(empty($appointment_slot)){
            abort(404);
        }
        $appointment_slot->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_services(Request $request)
    {
        if ($request->has('services_section')) {
            $data = BusinessReorderSection::find($request->services_section_id);
            $data->is_available = "1";
            $data->save();
        } else {
            $data = BusinessReorderSection::find($request->services_section_id);
            $data->is_available = "2";
            $data->save();
        }
        // To Store Business Service
        if ($request->has('services_title')) {
            $title = $request->services_title;
            $description = $request->description;
            $purchase_link = $request->purchase_link;
            $link_title = $request->link_title;
            $image = $request->service_img;
            foreach ($title as $key => $no) {
                $input = new Service;
                $input->vendor_id = Auth::user()->id;
                $input->business_id = $request->id;
                $input->title = $title[$key];
                $input->description = $description[$key];
                $input->purchase_link = $purchase_link[$key];
                $input->link_title = $link_title[$key];
                if ($image[$key] != "") {
                    $new_name = 'service-' . uniqid() . '.' . $image[$key]->getClientOriginalExtension();
                    $image[$key]->move(storage_path('app/public/admin-assets/images/service/'), $new_name);
                }
                $input->image = $new_name;
                $input->save();
            }
        }
        // To Update Business Service
        if ($request->has('edit_services_id')) {
            $edit_services_id = $request->edit_services_id;
            $edit_services_title = $request->edit_services_title;
            $edit_description = $request->edit_description;
            $edit_purchase_link = $request->edit_purchase_link;
            $edit_link_title = $request->edit_link_title;
            $edit_service_img = $request->edit_service_img;
            foreach ($edit_services_id as $key => $no) {
                $input = Service::where('id', $no)->first();
                $input->title = $edit_services_title[$key];
                $input->description = $edit_description[$key];
                $input->purchase_link = $edit_purchase_link[$key];
                $input->link_title = $edit_link_title[$key];
                if (!empty($edit_service_img[$key])) {
                    if (file_exists(storage_path('app/public/admin-assets/images/service/' . $input->image))) {
                        unlink(storage_path('app/public/admin-assets/images/service/' . $input->image));
                    }
                    $edit_new_name = 'service-' . uniqid() . '.' . $edit_service_img[$key]->getClientOriginalExtension();
                    $edit_service_img[$key]->move(storage_path('app/public/admin-assets/images/service/'), $edit_new_name);
                    $input->image = $edit_new_name;
                }
                $input->save();
            }
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_services(Request $request)
    {
        $services_info = Service::find($request->id);
        if(empty($services_info)){
            abort(404);
        }
        if (file_exists(storage_path('app/public/admin-assets/images/service/' . $services_info->image))) {
            unlink(storage_path('app/public/admin-assets/images/service/' . $services_info->image));
        }
        $services_info->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_testimonials(Request $request)
    {
        if ($request->has('testimonials_section')) {
            $data = BusinessReorderSection::find($request->testimonials_section_id);
            $data->is_available = "1";
            $data->save();
        } else {
            $data = BusinessReorderSection::find($request->testimonials_section_id);
            $data->is_available = "2";
            $data->save();
        }
        // To Store Business Testimonial
        if ($request->has('rating')) {
            $rating = $request->rating;
            $review = $request->review;
            $image = $request->testimonial_img;
            foreach ($rating as $key => $no) {
                $input = new Testimonial;
                $input->vendor_id = Auth::user()->id;
                $input->business_id = $request->id;
                $input->rating = $rating[$key];
                $input->review = $review[$key];
                if ($image[$key] != "") {
                    $new_name = 'testimonial-' . uniqid() . '.' . $image[$key]->getClientOriginalExtension();
                    $image[$key]->move(storage_path('app/public/admin-assets/images/testimonial/'), $new_name);
                }
                $input->image = $new_name;
                $input->save();
            }
        }
        // To Update Business Testimonial
        if ($request->has('edit_testimonial_id')) {
            $edit_testimonial_id = $request->edit_testimonial_id;
            $edit_rating = $request->edit_rating;
            $edit_review = $request->edit_review;
            $edit_testimonial_img = $request->edit_testimonial_img;
            foreach ($edit_testimonial_id as $key => $no) {
                $input = Testimonial::where('id', $no)->first();
                $input->rating = $edit_rating[$key];
                $input->review = $edit_review[$key];
                if (!empty($edit_testimonial_img[$key])) {
                    if (file_exists(storage_path('app/public/admin-assets/images/testimonial/' . $input->image))) {
                        unlink(storage_path('app/public/admin-assets/images/testimonial/' . $input->image));
                    }
                    $edit_new_name = 'testimonial-' . uniqid() . '.' . $edit_testimonial_img[$key]->getClientOriginalExtension();
                    $edit_testimonial_img[$key]->move(storage_path('app/public/admin-assets/images/testimonial/'), $edit_new_name);
                    $input->image = $edit_new_name;
                }
                $input->save();
            }
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function delete_testimonials(Request $request)
    {
        $testimonials_info = Testimonial::find($request->id);
        if(empty($testimonials_info)){
            abort(404);
        }
        if (file_exists(storage_path('app/public/admin-assets/images/testimonial/' . $testimonials_info->image))) {
            unlink(storage_path('app/public/admin-assets/images/testimonial/' . $testimonials_info->image));
        }
        $testimonials_info->delete();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_reorder_section(Request $request)
    {
        $old_position = $request->old_position;
        $position = $request->position;
        $name = $request->name;
        foreach ($old_position as $key => $no) {
            $reorderdata = BusinessReorderSection::find($no);
            $reorderdata->name = $name[$key];
            $reorderdata->save();
        }
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_social_links(Request $request)
    {
        if ($request->has('social_links_section')) {
            $data = BusinessReorderSection::find($request->social_links_section_id);
            $data->is_available = "1";
            $data->save();
        } else {
            $data = BusinessReorderSection::find($request->social_links_section_id);
            $data->is_available = "2";
            $data->save();
        }
        if ($request->has('title')) {
            $social_info = $request->social_info;
            $icon = $request->icon;
            $title = $request->title;
            foreach ($title as $key => $no) {
                $input = new Businesscontact;
                $input->vendor_id = Auth::user()->id;
                $input->business_id = $request->id;
                $input->type = "2";
                $input->title = $title[$key];
                $input->contact_info = $social_info[$key];
                $input->icon = $icon[$key];
                $input->save();
            }
        }
        if ($request->has('edit_social_info_id')) {
            $edit_social_info_id = $request->edit_social_info_id;
            $edit_social_info = $request->edit_social_info;
            $edit_icon = $request->edit_icon;
            $edit_title = $request->edit_title;
            foreach ($edit_social_info_id as $keys => $no) {
                $input = Businesscontact::where('id', $no)->first();
                $input->contact_info = $edit_social_info[$keys];
                $input->icon = $edit_icon[$keys];
                $input->title = $edit_title[$keys];
                $input->save();
            }
        };
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function store_seo(Request $request)
    {
        $businessdata = Businesscard::where('id', $request->id)->first();
        $request->validate([
            'meta_title' => 'required',
            'meta_description' => 'required'
        ], [
            "meta_title.required" => trans('messages.meta_title_required'),
            "meta_description.required" => trans('messages.meta_description_required')
        ]);
        if ($request->og_image != "") {
            $request->validate([
                'og_image' => 'required|max:1024',
            ], [
                "og_image.required" => trans('messages.og_image_required'),
                "og_image.max" => trans('messages.image_max_size'),
            ]);
            if (!empty($businessdata->og_image)) {
                if (file_exists(storage_path('app/public/admin-assets/images/og_image/' . $businessdata->og_image))) {
                    unlink(storage_path('app/public/admin-assets/images/og_image/' . $businessdata->og_image));
                }
            }
            $og_image_name = 'og_image-' . uniqid() . '.' . $request->og_image->getClientOriginalExtension();
            $request->og_image->move(storage_path('app/public/admin-assets/images/og_image'), $og_image_name);
            $businessdata->og_image = $og_image_name;
        }
        $businessdata->meta_title = $request->meta_title;
        $businessdata->meta_description = $request->meta_description;
        $businessdata->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
}
