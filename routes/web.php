<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AppointmentsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PlansController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\BusinessController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\admin\SystemAddonsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
    // Auth
    Route::get('/', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('register', [UserController::class, 'userregister']);
    Route::get('verification', [UserController::class, 'verification']);
    Route::post('systemverification', [UserController::class, 'systemverification']);
    Route::get('otp-verification', [UserController::class, 'otpverification']);
    Route::get('resendotp', [UserController::class, 'resendotp']);
    Route::get('forgotpassword', [UserController::class, 'forgotpassword']);
    Route::get('logout', [UserController::class, 'logout']);
    Route::post('checklogin', [UserController::class, 'checklogin']);
    Route::post('store', [UserController::class, 'register']);
    Route::post('otpverify', [UserController::class, 'otpverify']);
    Route::post('sendpassword', [UserController::class, 'sendpassword']);
    Route::get('apps', [SystemAddonsController::class, 'index'])->name('systemaddons');
    Route::get('createsystem-addons', [SystemAddonsController::class, 'createsystemaddons']);
    Route::post('systemaddons/store', [SystemAddonsController::class, 'store']);
    Route::group(['middleware' => 'Authenticate'], function () {
        // Dashboard
        Route::get('dashboard', [AdminController::class, 'index']);
        Route::get('admin_login', [UserController::class, 'admin_login']);
        // Users
        Route::prefix('users')->group(function () {
            Route::middleware(['middleware' => 'admin'])->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('users');
                Route::get('add', [UserController::class, 'addusers']);
                Route::post('store', [UserController::class, 'storeuser']);
                Route::get('edit-{id}', [UserController::class, 'getuser']);
                Route::post('changestatus', [UserController::class, 'changestatus']);
                Route::get('resetpassword-{id}', [UserController::class, 'resetpassword']);
                Route::post('reset-{id}', [UserController::class, 'reset']);
                Route::get('vendor_login-{id}', [UserController::class, 'vendor_login']);
            });
            Route::post('update-{id}', [UserController::class, 'updateuser']);
            Route::post('changepassword', [UserController::class, 'changepassword']);
        });
        // Settings
        Route::get('settings', [SettingsController::class, 'index']);
        Route::post('basicinfo/store', [SettingsController::class, 'store']);
        // Pricing Plan
        Route::prefix('plans')->group(function () {
            Route::get('/', [PlansController::class, 'index']);
            Route::get('selectplan-{id}', [PlansController::class, 'selectplan'])->middleware('vendor');
            Route::post('buyplan', [PlansController::class, 'buyplan'])->middleware('vendor');
            Route::group(['middleware' => 'admin'], function () {
                Route::post('changestatus', [PlansController::class, 'changestatus']);
                Route::get('add', [PlansController::class, 'addplans'])->middleware('admin');
                Route::post('store', [PlansController::class, 'store']);
                Route::get('edit-{id}', [PlansController::class, 'getplan']);
                Route::post('update-{id}', [PlansController::class, 'updateplan']);
            });
        });
        // Payments
        Route::get('payments', [PaymentController::class, 'index'])->middleware('admin');
        Route::post('paymentmethod', [PaymentController::class, 'paymentmethod'])->middleware('admin');
        // Transaction
        Route::get('transaction', [PaymentController::class, 'transaction']);
        // Business
        Route::group(['prefix' => 'business'], function () {
            Route::group(['middleware' => 'vendor'], function () {
                Route::get('/', [BusinessController::class, 'index']);
                Route::post('business_add', [BusinessController::class, 'business_add']);
                Route::get('business_edit-{id}', [BusinessController::class, 'business_edit']);
                Route::post('business_delete', [BusinessController::class, 'business_delete']);
                Route::post('store_basic_info-{id}', [BusinessController::class, 'store_basic_info']);
                Route::post('store_contact_info-{id}', [BusinessController::class, 'store_contact_info']);
                Route::get('delete_contact_field-{id}', [BusinessController::class, 'delete_contact_field']);
                Route::post('store_business_hours', [BusinessController::class, 'store_business_hours']);
                Route::post('store_appointments_slot-{id}', [BusinessController::class, 'store_appointments_slot']);
                Route::get('delete_appointments_slot-{id}', [BusinessController::class, 'delete_appointments_slot']);
                Route::post('store_services-{id}', [BusinessController::class, 'store_services']);
                Route::get('delete_services-{id}', [BusinessController::class, 'delete_services']);
                Route::post('store_testimonials-{id}', [BusinessController::class, 'store_testimonials']);
                Route::get('delete_testimonials-{id}', [BusinessController::class, 'delete_testimonials']);
                Route::post('store_social_links-{id}', [BusinessController::class, 'store_social_links']);
                Route::post('store_reorder_section-{id}', [BusinessController::class, 'store_reorder_section']);
                Route::post('store_seo-{id}', [BusinessController::class, 'store_seo']);
            });
        });
        // Appointments
        Route::get('appointments', [AppointmentsController::class, 'index'])->middleware('vendor');
        Route::post('appointments/changestatus', [AppointmentsController::class, 'changestatus'])->middleware('vendor');
    });
});
// Web
//Route::get('/', [HomeController::class, 'landing']);
Route::get('/', function () {return view('wp.index');});
Route::get('{slug}', [HomeController::class, 'index']);
Route::post('{slug}/store_appointments-{id}', [AppointmentsController::class, 'store_appointments']);
Route::get('{slug}/savecard', [HomeController::class, 'savecard']);


