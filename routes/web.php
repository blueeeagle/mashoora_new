<?php

use App\Http\Controllers\Account\SettingsController;
use App\Http\Controllers\Auth\SocialiteLoginController;
use App\Http\Controllers\Documentation\ReferencesController;
use App\Http\Controllers\Logs\AuditLogsController;
use App\Http\Controllers\Logs\SystemLogsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConsultantCategoryController;
use App\Http\Controllers\CompanysettingsController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\FirmController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\ArticelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\helperController;
use App\Http\Controllers\LanguagesController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\ConsultantApprovalController;
use App\Http\Controllers\FirmApprovalController;
use App\Http\Controllers\OfferHistoryController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\AppointmentHistoryController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ReviewRatingController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PayInApprovalController;
use App\Http\Controllers\PayOutApprovalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Adminpaymentcontroller;
use App\Http\Controllers\DashboadController;
use App\Http\Controllers\ChatController;

use Illuminate\Support\Facades\Route;
//arun
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect('index');
// });

// $menu = theme()->getMenu();

// array_walk($menu, function ($val) {
//     if (isset($val['path'])) {
//         $route = Route::get($val['path'], [PagesController::class, 'index']);
//         // Exclude documentation from auth middleware
//         if (!Str::contains($val['path'], 'documentation')) {
//             $route->middleware('auth');

//         }
//     }
// });

Route::Post('get-user', [helperController::class, 'get_user'])->name('get-user');
Route::get('email', [helperController::class, 'email'])->name('email');

Route::get('send-email', [helperController::class, 'send_email'])->name('send-email');

// Documentations pages
Route::prefix('documentation')->group(function () {
    Route::get('getting-started/references', [ReferencesController::class, 'index']);
    Route::get('getting-started/changelog', [PagesController::class, 'index']);
});
Route::prefix('helper')->group(function () {
    Route::Post('uploadimage', [helperController::Class,'uploadimage'])->name('help.uploadimage');
    Route::Post('get/child/category', [helperController::Class,'getchild'])->name('help.getchildcategory');
});


Route::middleware('auth')->group(function () {
    //Dashboad
    Route::get('/', [DashboadController::class, 'index']);
    Route::prefix('dashboad/data')->group(function () {
        Route::post('customer', [DashboadController::class, 'customer_filter'])->name('dashboad.customer');
        Route::post('consultant', [DashboadController::class, 'consultant_filter'])->name('dashboad.consultant');
    });
    // Account pages
    Route::prefix('account')->group(function () {
        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::put('settings/email', [SettingsController::class, 'changeEmail'])->name('settings.changeEmail');
        Route::put('settings/password', [SettingsController::class, 'changePassword'])->name('settings.changePassword');
    });

    // Logs pages
    Route::prefix('log')->name('log.')->group(function () {
        Route::resource('system', SystemLogsController::class)->only(['index', 'destroy']);
        Route::resource('audit', AuditLogsController::class)->only(['index', 'destroy']);
    });

    //Master Page
    Route::prefix('master')->name('master.')->group(function () {

        Route::resource('currency', CurrencyController::Class)->only(['index','edit', 'destroy']);
        Route::post('currency/datatable', [CurrencyController::Class,'datatable'])->name('currency.datatable');
        Route::Post('currency/update/{currency}', [CurrencyController::Class,'update'])->name('currency.update');
        Route::Post('currency/status/{currency}', [CurrencyController::Class,'status'])->name('currency.status');
        
        Route::resource('country', CountryController::Class)->only(['index','edit', 'destroy']);
        Route::Post('country/datatable', [CountryController::Class,'datatable'])->name('country.datatable');
        Route::Post('country/getstate', [CountryController::Class,'getState'])->name('country.getState');
        Route::Post('country/getCity', [CountryController::Class,'getCity'])->name('country.getCity');
        Route::Post('country/has_state/{country}', [CountryController::Class,'has_state'])->name('country.has_state');
        Route::Post('country/status/{country}', [CountryController::Class,'status'])->name('country.status');
        Route::Post('country/update/{country}', [CountryController::Class,'update'])->name('country.update');
        
        Route::resource('state', StateController::Class)->only(['index', 'destroy','create','store','edit']);
        Route::Post('state/datatable', [StateController::Class,'datatables'])->name('state.datatable');
        Route::Post('state/status/{state}', [StateController::Class,'status'])->name('state.status');
        Route::Post('state/update/{state}', [StateController::Class,'update'])->name('state.update');

        Route::resource('city', CityController::Class)->only(['index', 'destroy','create','store','edit']);
        Route::post('city/datatable', [CityController::Class,'datatables'])->name('city.datatable');
        Route::Post('city/status/{city}', [CityController::Class,'status'])->name('city.status');
        Route::Post('city/update/{city}', [CityController::Class,'update'])->name('city.update');

        Route::resource('documents', DocumentController::Class)->only(['index','create','destroy','store','edit']);
        Route::Post('documents/datatable', [DocumentController::Class,'datatable'])->name('documents.datatable');
        Route::Post('documents/status/{document}', [DocumentController::Class,'status'])->name('documents.status');
        Route::Post('documents/update/{Document}', [DocumentController::Class,'update'])->name('documents.update');

        Route::resource('category', CategoryController::Class)->only(['index','create','store','edit','destroy']);
        Route::Post('category/datatabletest', [CategoryController::Class,'datatable'])->name('category.datatable');
        Route::Post('category/status/{category}', [CategoryController::Class,'status'])->name('category.status');
        Route::Post('category/display_in_home/{category}', [CategoryController::Class,'display_in_home'])->name('category.display_in_home');
        Route::Post('category/update/{id}', [CategoryController::Class,'update'])->name('category.update');
        Route::Post('category/getchild/{category}', [CategoryController::Class,'getchild'])->name('category.getchild');

        Route::resource('specialization', ConsultantCategoryController::Class)->only(['index','create','store','edit','destroy']);
        Route::Post('specialization/datatable', [ConsultantCategoryController::Class,'datatable'])->name('consultantcategory.datatable');
        Route::Post('specialization/status/{Consultantcategory}', [ConsultantCategoryController::Class,'status'])->name('consultantcategory.status');
        Route::Post('specialization/update/{consultantcategory}', [ConsultantCategoryController::Class,'update'])->name('consultantcategory.update');
        
        //language
         Route::resource('language', LanguagesController::Class)->only(['index','create','destroy','store','edit']);
         Route::Post('language/datatable', [LanguagesController::Class,'datatable'])->name('language.datatable');
         Route::Post('language/status/{language}', [LanguagesController::Class,'status'])->name('language.status');
         Route::Post('language/update/{language}', [LanguagesController::Class,'update'])->name('language.update');

         //Tax
         Route::resource('tax', TaxController::Class)->only(['index','create','destroy','store','edit']);
         Route::Post('tax/datatable', [TaxController::Class,'datatable'])->name('tax.datatable');
         Route::Post('tax/status/{tax}', [TaxController::Class,'status'])->name('tax.status');
         Route::Post('tax/update/{tax}', [TaxController::Class,'update'])->name('tax.update');
    });
    //setting
    Route::prefix('setting')->name('setting.')->group(function () {
        Route::resource('companysettings', CompanysettingsController::Class)->only(['index']);
        Route::Post('companysettings/update/{config}', [CompanysettingsController::Class,'update'])->name('companysettings.update');
        Route::Post('companysettings/datatable', [CompanysettingsController::Class,'datatable'])->name('companysettings.datatable');
        Route::Post('companysettings/detailsupdate', [CompanysettingsController::Class,'detailsupdate'])->name('companysettings.detailsupdate');
        Route::Post('companysettings/addressupdate', [CompanysettingsController::Class,'addressupdate'])->name('companysettings.addressupdate');
        Route::Post('companysettings/settingupdate', [CompanysettingsController::Class,'settingupdate'])->name('companysettings.settingupdate');
        Route::Post('companysettings/contactupdate', [CompanysettingsController::Class,'contactupdate'])->name('companysettings.contactupdate');
    });
    
    //notification
    Route::prefix('notification')->name('notification.')->group(function () {
        Route::get('notification-setting', [NotificationController::Class,'index'])->name('notification-setting');
        Route::Post('notification-store', [NotificationController::Class,'store'])->name('notification.store');
        Route::Post('template-store', [NotificationController::Class,'template_store'])->name('notification.template-store');
        Route::get('variables/{value}', [NotificationController::Class,'variables'])->name('variables');
        Route::get('template/{value}', [NotificationController::Class,'template'])->name('template');
    });
    
    //Others
    Route::prefix('other')->name('other.')->group(function () {
        Route::resource('article', ArticelController::Class)->only(['create','store','index','edit','destroy']);
        Route::Post('article/status/{articel}', [ArticelController::Class,'status'])->name('articel.status');
        Route::Post('article/update/{articel}', [ArticelController::Class,'update'])->name('articel.update');
        Route::Post('article/datatable',[ArticelController::Class,'datatable'])->name('articel.datatable');
        Route::Post('article/search',[ArticelController::Class,'search'])->name('article.search');
        Route::Post('article/consultant/search',[ArticelController::Class,'consultantSearch'])->name('article.consultantSearch');
        Route::Post('article/user/search',[ArticelController::Class,'userSearch'])->name('article.userSearch');
         // video
         Route::resource('video', VideoController::Class)->only(['create','store','index','edit','destroy']);
         Route::Post('video/status/{video}', [VideoController::Class,'status'])->name('video.status');
         Route::Post('video/update/{video}', [VideoController::Class,'update'])->name('video.update');
         Route::Post('video/datatable',[VideoController::Class,'datatable'])->name('video.datatable');
         Route::Post('video/search',[VideoController::Class,'search'])->name('video.search');
         Route::Post('video/consultant/search',[VideoController::Class,'consultantSearch'])->name('video.consultantSearch');
         Route::Post('video/user/search',[VideoController::Class,'userSearch'])->name('video.userSearch');
         
         //discount
         Route::resource('discount', DiscountController::Class)->only(['create','store','index','edit','destroy']);
         Route::Post('discount/status/{discount}', [DiscountController::Class,'status'])->name('discount.status');
         Route::Post('discount/update/{discount}', [DiscountController::Class,'update'])->name('discount.update');
         Route::Post('discount/datatable',[DiscountController::Class,'datatable'])->name('discount.datatable');
         Route::Post('discount/search',[DiscountController::Class,'search'])->name('discount.search');
         Route::Post('discount/consultant', [DiscountController::Class,'getConsultant'])->name('discount.getConsultant');

         //offers
         Route::resource('offer', OfferController::Class)->only(['create','store','index','edit','destroy']);
         Route::Post('offer/status/{offer}', [OfferController::Class,'status'])->name('offer.status');
         Route::Post('offer/update/{offer}', [OfferController::Class,'update'])->name('offer.update');
         Route::Post('offer/datatable',[OfferController::Class,'datatable'])->name('offer.datatable');
         Route::Post('offer/search',[OfferController::Class,'search'])->name('offer.search');
         Route::Post('offer/getCategory',[OfferController::Class,'getCategory'])->name('offer.getCategory');
            Route::Post('offer/consultant/category',[OfferController::Class,'consultantcategory'])->name('offer.consultantcategory');
         Route::Post('offer/getconsultant',[OfferController::Class,'getconsultant'])->name('offer.getconsultant');
         // communication

         Route::resource('communication', CommunicationController::Class)->only(['create','store','index','destroy']);
         Route::Post('communication/status/{offer}', [CommunicationController::Class,'status'])->name('communication.status');
         Route::Post('communication/send_to_datatable',[CommunicationController::Class,'sendTO_Datatable'])->name('communication.sendTO_Datatable');
         Route::Post('communication/datatable',[CommunicationController::Class,'datatables'])->name('communication.datatable');
         Route::Post('communication/search',[CommunicationController::Class,'search'])->name('communication.search');
         Route::Get('communication/view/{communication}',[CommunicationController::Class,'view'])->name('communication.view');
    });
    //Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('user', UsersController::Class)->only(['index','create','edit','store','destroy']);
        Route::Post('user/datatable',[UsersController::Class,'datatable'])->name('user.datatable');
        Route::Post('user/update/{user}', [UsersController::Class,'update'])->name('user.update');
        Route::Post('user/status/{user}', [UsersController::Class,'status'])->name('user.status');
    });
    //User
    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('firms', FirmController::Class)->only(['index','create','store','destroy','edit']);
        Route::Post('firms/status/{firms}', [FirmController::Class,'status'])->name('firms.status');
        Route::Post('firms/bankstatus/{firms}', [FirmController::Class,'bankstatus'])->name('firms.bankstatus');
        Route::Post('firms/loginstatus/{firms}', [FirmController::Class,'loginstatus'])->name('firms.loginstatus');
        Route::Post('firms/datatable',[FirmController::Class,'datatable'])->name('firms.datatable');
        Route::Post('firms/update/{firm}', [FirmController::Class,'update'])->name('firms.update');
        
        Route::resource('insurance', InsuranceController::Class)->only(['create','store','index','edit','destroy']);
        Route::Post('insurance/status/{insurance}', [InsuranceController::Class,'status'])->name('insurance.status');
        Route::Post('insurance/datatable', [InsuranceController::Class,'datatable'])->name('insurance.datatable');
        Route::Post('insurance/update/{insurance}', [InsuranceController::Class,'update'])->name('insurance.update');

        Route::resource('customer', CustomerController::Class)->only(['create','store','index','destroy','edit']);
        Route::Post('customer/datatable',[CustomerController::Class,'datatable'])->name('customer.datatable');
        Route::Post('customer/status/{customer}', [CustomerController::Class,'status'])->name('customer.status');
        Route::Post('customer/datatable', [CustomerController::Class,'datatable'])->name('customer.datatable');
        Route::Post('customer/update/{customer}', [CustomerController::Class,'update'])->name('customer.update');
        Route::Post('customer/datatableDashboard',[CustomerController::Class,'datatableDashboard'])->name('customer.datatableDashboard');
        Route::get('customer/view/{customer}', [CustomerController::Class,'view'])->name('customer.view');
        Route::Post('customer/transactiondatatable',[CustomerController::Class,'transactiondatatable'])->name('customer.transactiondatatable');
        Route::Post('customer/user-update/{customer}', [CustomerController::Class,'user_update'])->name('customer.user-update');
        Route::Post('customer/appointmentdatatable',[CustomerController::Class,'appointmentdatatable'])->name('customer.appointmentdatatable');

    });
    //Consultants
    Route::prefix('consultant')->name('consultant.')->group(function () {
        Route::resource('consultant', ConsultantController::Class)->only(['create','index','edit','destroy']);
        Route::Post('consultant/status/{consultant}', [ConsultantController::Class,'status'])->name('consultant.status');
        Route::get('consultant/view/{consultant}', [ConsultantController::Class,'view'])->name('consultant.view');
        Route::Post('consultant/datatable',[ConsultantController::Class,'datatable'])->name('consultant.datatable');
        Route::Post('consultant/wallet',[WalletController::Class,'datatable'])->name('consultant.wallet.index');
        Route::Post('consultant/get/subCat/spec/',[ConsultantController::Class,'subCategory'])->name('consultant.getSubCategory');
        Route::Post('consultant/update/{consultant}', [ConsultantController::Class,'update'])->name('consultant.update');
        Route::Post('consultant/modelcategory/', [ConsultantController::Class,'modelcategory'])->name('modelcategory');
        Route::Post('consultant/transactiondatatable/', [ConsultantController::Class,'transactiondatatable'])->name('consultant.transactiondatatable');
        Route::Post('consultant/appointmentdatatable',[ConsultantController::Class,'appointmentdatatable'])->name('consultant.appointmentdatatable');

    });
    //schedule
    Route::prefix('activities')->name('activities.')->group(function () {
        Route::resource('schedules', ScheduleController::Class)->only(['create','index','edit','store']);
        Route::post('schedules/get/{consultant}', [ScheduleController::Class,'getAllschedule'])->name('schedules.getAllschedule');
        Route::post('schedules/{schedules}/editget', [ScheduleController::Class,'editget'])->name('schedules.editget');
        Route::DELETE('schedules/destroy/{schedule}', [ScheduleController::Class,'destroy'])->name('schedules.destroy');
        Route::post('schedules/copy/{schedule}', [ScheduleController::Class,'copyschedule'])->name('schedules.copy');
        Route::Post('customer/update/{schedules}', [ScheduleController::Class,'update'])->name('schedules.update');
        Route::get('schedules/create/{consultant}', [ScheduleController::Class,'create2'])->name('schedules.create2');
        Route::Post('schedules/datatable',[ScheduleController::Class,'datatable'])->name('schedules.datatable');
        Route::Post('schedules/getscheduleDatatable',[ScheduleController::Class,'getscheduleDatatable'])->name('schedules.getscheduleDatatable');
       
        
        Route::get('schedules/getappdetails', [ScheduleController::Class,'getappdetails'])->name('schedules.getappdetails');
        // appointment status
        Route::Post('schedules/appointment/status', [ScheduleController::Class,'appStatus'])->name('schedules.appStatus');
        // calendar
        Route::resource('calendar', CalendarController::Class)->only(['create','index','edit','store']);
        Route::Post('calendar/datatable',[CalendarController::Class,'datatable'])->name('calendar.datatable');
        Route::get('calendar/appointment/{consultant}', [CalendarController::Class,'appointmentIndex'])->name('schedules.appointmentIndex');
        // Config
        Route::resource('config', ConfigController::Class)->only(['create','store','index','edit','destroy']);
        Route::Post('config/status/{config}', [ConfigController::Class,'status'])->name('config.status');
        Route::Post('config/update/{config}', [ConfigController::Class,'update'])->name('config.update');
        Route::Post('config/datatableForHome',[ConfigController::Class,'datatableForHome'])->name('config.datatableForHome');
        Route::Post('config/datatableForAllCategory',[ConfigController::Class,'datatableForAllCategory'])->name('config.datatableForAllCategory');
        Route::Post('config/datatableForCategory',[ConfigController::Class,'datatableForCategory'])->name('config.datatableForCategory');
        Route::Post('config/consultant', [ConfigController::Class,'getConsultant'])->name('config.getConsultant');
        
       

    });
    //approval
    Route::prefix('approval')->name('approval.')->group(function () {
        Route::resource('consultant', ConsultantApprovalController::Class)->only(['index','create','store','destroy','edit']);
        Route::Post('consultant/datatable',[ConsultantApprovalController::Class,'datatables'])->name('consultant.datatable');
        Route::Post('consultant/status/', [ConsultantApprovalController::Class,'status'])->name('consultant.status');
      
        Route::resource('firm', FirmApprovalController::Class)->only(['index','create','store','destroy','edit']);
        Route::Post('firm/datatable',[FirmApprovalController::Class,'datatables'])->name('firm.datatable');
        Route::Post('firm/status/', [FirmApprovalController::Class,'status'])->name('firm.status');
        
        Route::resource('pay_in', PayInApprovalController::Class)->only(['index']);
        Route::Post('pay_in/datatable',[PayInApprovalController::Class,'datatables'])->name('pay_in.datatable');
        Route::Post('pay_in/status/', [PayInApprovalController::Class,'status'])->name('pay_in.status');
        Route::get('pay_in/view', [PayInApprovalController::Class,'view'])->name('pay_in.view');

        Route::post('pay_in/offerDatatable',[PayInApprovalController::Class,'offerDatatable'])->name('pay_in.offerDatatable');
        Route::Post('pay_in/offstatus/', [PayInApprovalController::Class,'offstatus'])->name('pay_in.offstatus');
        
        Route::resource('pay_out', PayOutApprovalController::Class)->only(['index']);
        Route::Post('pay_out/datatable',[PayOutApprovalController::Class,'datatables'])->name('pay_out.datatable');
        Route::Post('pay_out/status/', [PayOutApprovalController::Class,'status'])->name('pay_out.status');


    });

    Route::Post('consultant/otp', [ConsultantController::Class,'generateotp'])->name('consultant.generateotp');
    Route::Post('consultant/save', [ConsultantController::Class,'save'])->name('consultant.save');
    Route::Post('consultant/get', [ConsultantController::Class,'getdata'])->name('consultant.get');
    Route::Post('consultant/verify', [ConsultantController::Class,'verify'])->name('consultant.verifyotp');
    Route::Post('consultant/update', [ConsultantController::Class,'update'])->name('consultant.update');
    
    //history
  
    Route::get('offer', [OfferHistoryController::Class,'index'])->name('history.offer');
    Route::Post('offer/datatable/{id?}/{type?}',[OfferHistoryController::Class,'datatable'])->name('history.offer.datatable');
        
    Route::get('purchase',[PurchaseHistoryController::Class,'index'])->name('history.purchase');
    Route::Post('purchase/datatable',[PurchaseHistoryController::Class,'datatable'])->name('history.purchase.datatable');


    Route::get('appointment/history',[AppointmentController::Class,'index'])->name('appointment.history');
    Route::Post('appointment/datatable',[AppointmentController::Class,'datatable'])->name('appointment.history.datatable');
    Route::Post('appointment/status/', [AppointmentController::Class,'status'])->name('appointment.status');
    Route::get('appointment/view',[AppointmentController::Class,'view'])->name('appointment.history.view');
    
    
    Route::get('reviews', [ReviewRatingController::Class,'index'])->name('review');
    Route::post('reviews/delete/review', [ReviewRatingController::Class,'delete'])->name('review.delete');
    Route::Post('review/datatable/{consultant?}',[ReviewRatingController::Class,'datatable'])->name('review.datatable');
    Route::Post('review/datatable/{customer}',[ReviewRatingController::Class,'datatable_customer'])->name('review.datatable_customer');

    Route::get('admin/wallet', [Adminpaymentcontroller::Class,'index'])->name('admin.wallet');
    Route::Post('admin/wallet/datatable/',[Adminpaymentcontroller::Class,'datatable'])->name('admin.wallet.datatable');
    
    Route::get('revenue', [Adminpaymentcontroller::Class,'revenue'])->name('revenue');
    Route::post('chartrevenue', [Adminpaymentcontroller::Class,'chartrevenue'])->name('chartrevenue');
    
    Route::get('appChart', [Adminpaymentcontroller::Class,'appChart'])->name('appChart');
    Route::post('appChartdata', [Adminpaymentcontroller::Class,'appChartdata'])->name('appChartdata');
    
    Route::get('chat/messager', [ChatController::Class,'index'])->name('chat.messager');
    Route::get('chat/getcustomer', [ChatController::Class,'getcustomer'])->name('chat.getcustomer');
    Route::get('chat/getconsultant', [ChatController::Class,'getconsultant'])->name('chat.getconsultant');
});

Route::resource('users', UsersController::class);

/**
 * Socialite login using Google service
 * https://laravel.com/docs/8.x/socialite
 */
Route::get('/auth/redirect/{provider}', [SocialiteLoginController::class, 'redirect']);

require __DIR__.'/auth.php';
