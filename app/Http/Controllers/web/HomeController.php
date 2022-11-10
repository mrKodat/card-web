<?php



namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Businesscard;
use App\Models\Businesscontact;
use App\Models\Timings;
use App\Models\AppointmentSlots;
use App\Models\Service;
use App\Models\User;
use App\Models\Testimonial;
use App\Models\Plans;
use JeroenDesloovere\VCard\VCard;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use App\Helpers\helper;

class HomeController extends Controller

{

    public function landing(Request $request)
    {
        $planlist = Plans::get();

        return view('web.landing.landing', compact('planlist'));
    }

    public function index(Request $request)
    {
        $basicinfo = Businesscard::where('slug', $request->slug)->first();
        if (empty($basicinfo)) {
            abort(404);
        }
        $contactinfo = Businesscontact::where('business_id', $basicinfo->id)->where('type', 1)->get();
        $socialinfo = Businesscontact::where('business_id', $basicinfo->id)->where('type', 2)->get();
        $timeinfo = Timings::where('business_id', $basicinfo->id)->get();
        $appointments = AppointmentSlots::where('business_id', $basicinfo->id)->get();
        $services = Service::where('business_id', $basicinfo->id)->get();
        $testimonials = Testimonial::where('business_id', $basicinfo->id)->get();

        return view('web.theme' . $basicinfo->themes_id . '.index', compact('basicinfo', 'contactinfo', 'socialinfo', 'timeinfo', 'appointments', 'services', 'testimonials'));
    }

    public function savecard(Request $request)
    {
        $basicinfo = Businesscard::where('slug', $request->slug)->first();
        $userinfo = User::where('id', $basicinfo->vendor_id)->first();
        $contactinfo = Businesscontact::where('business_id', $basicinfo->id)->where('type', 1)->where('title','Address')->first();
        $vcard = new VCard();

        // define variables
        $name = $basicinfo->title;

        // add personal data
        $vcard->addName($name,'', '', '' , '');

        // add work data
        $vcard->addCompany($basicinfo->sub_title);
        $vcard->addJobtitle($basicinfo->designation);
        $vcard->addRole('');
        $vcard->addEmail($userinfo->email);
        $vcard->addPhoneNumber($userinfo->mobile);
        $vcard->addAddress(@$contactinfo->contact_info);
        $vcard->addURL(url()->previous());

        $vcard->addPhoto($basicinfo->profile_image == '' ? helper::image_path('default-profile.jpg') : helper::image_path($basicinfo->profile_image));
       
        // return vcard as a string
        $content= $vcard->getOutput();


        $response = new Response();
        $response->setContent($content);
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/x-vcard');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . Str::slug($name,'-') . '.vcf"');
        $response->headers->set('Content-Length', mb_strlen($content, 'utf-8'));

        // return vcard as a download
        return $response;
    }
}
