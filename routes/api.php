<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SampleDataController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\helperController;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ConsultantController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\DiscountController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Sample API route
Route::get('/profits', [SampleDataController::class, 'profits'])->name('profits');
Route::post('/register', [RegisteredUserController::class, 'apiStore']);
Route::post('/login', [AuthenticatedSessionController::class, 'apiStore']);
Route::post('/forgot_password', [PasswordResetLinkController::class, 'apiStore']);
Route::post('/verify_token', [AuthenticatedSessionController::class, 'apiVerifyToken']);
Route::get('/users', [SampleDataController::class, 'getUsers']);
Route::get('/gettoken', function(){
    return '';
});

Route::prefix('helper')->name('helper.')->group(function () {
    Route::get('company', [helperController::Class,'company'])->name('helper.company');
    Route::get('firm', [helperController::Class,'firm']);
    Route::get('language', [helperController::Class,'language']);
    Route::get('getcountry', [helperController::Class,'getcountry'])->name('helper.getcountry');
    Route::get('getstate', [helperController::Class,'getState'])->name('helper.getState');
    Route::get('getCity', [helperController::Class,'getCity'])->name('helper.getCity');
    Route::Post('auth', [helperController::Class,'auth']);
    
    Route::get('/getCategory', [helperController::Class,'getCategory'])->name('helper.getCategory');
});
Route::get('/auth', function(){ return response()->json('Unauthorized',401); })->name('auth');

Route::get('/guest', [CustomerController::class, 'gust']);
Route::prefix('index')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
    Route::get('/viewallcategory/{id?}', [IndexController::class, 'viewallcategoty']);
    Route::get('/viewallvideo/{id?}', [IndexController::class, 'viewallvideo']);
    Route::get('/viewallartical/{id?}', [IndexController::class, 'viewallartical']);
});

//Custome login
Route::get('checkCustomer', [CustomerController::class, 'checkCustomer']);
Route::post('/customer/login', [CustomerController::class, 'login']);
Route::post('/customer/verifyotp', [CustomerController::class, 'VerifyOtp']);

//Geust
Route::prefix('customer')->group(function () {
    Route::get('/filteringData', [CustomerController::class, 'filteringData']);
    //consultant
    Route::prefix('consultant')->group(function () {
        Route::get('/', [CustomerController::class, 'consultant']);
        Route::get('/consultantcatsub/{id}/{sub?}', [CustomerController::class, 'consultantcatsub']);
        Route::get('/consultantdetails/{consultant}', [CustomerController::class, 'consultantdetails']);
    });
    
    //Firm
    Route::prefix('firm')->group(function () {
        Route::get('/getfirm', [CustomerController::class, 'getfirm']);
        Route::get('/consultantfirm/{firm}', [CustomerController::class, 'consultantfirm']);
    });
    Route::prefix('offers')->group(function () { 
        Route::get('/', [CustomerController::class, 'offerindex']);
    });
});


Route::prefix('customer')->middleware('Apiauth:customer')->group(function () {
    Route::get('/chatlist', [CustomerController::class, 'chatlistApp']);
    Route::post('/logout', [CustomerController::class, 'logout']);
    Route::post('/updateprofile', [CustomerController::class, 'updateprofile']);
    Route::get('/bookings', [CustomerController::class, 'bookings']);
    // Route::get('/filteringData', [CustomerController::class, 'filteringData']);
    Route::get('/getprofile', [CustomerController::class, 'getprofile']);
    //Notification
    Route::prefix('notification')->group(function () { 
        Route::get('', [CustomerController::class, 'Notification']);
        Route::post('read', [CustomerController::class, 'notificationread']);
    });
    //consultant
    Route::prefix('consultant')->group(function () {
        
        Route::get('/schedule/{type}', [CustomerController::class, 'schedule']);

        Route::get('/insurance', [CustomerController::class, 'consultantinsurance']);

        Route::get('/getoffer/offer', [CustomerController::class, 'offer']);
        Route::get('/applyoffer/{offer}', [CustomerController::class, 'Applyoffer']);
        Route::get('/get/promo', [CustomerController::class, 'Discount']);
        Route::get('/removediscount', [CustomerController::class, 'removediscount']);
        Route::get('/verifi/promo', [CustomerController::class, 'ApplyDiscount']);
        Route::post('/appointment/schedule', [CustomerController::class, 'appointment']);
        Route::post('/appointment/reschedule/{Appointment}', [CustomerController::class, 'AppointmentReschedule']);
    });
    
    //Wallet
    Route::prefix('wallet')->group(function () {
        Route::get('/wallet', [CustomerController::class, 'wallet']);
        Route::post('/addwallet', [CustomerController::class, 'addwallet']);

        Route::get('/getcard', [CustomerController::class, 'getcard']);
        Route::post('/addcard', [CustomerController::class, 'Addcard']);
        Route::post('/delete/{card}', [CustomerController::class, 'deletecard']);
    });


    
    //Booking
    Route::prefix('booking')->group(function () {
        Route::get('/', [CustomerController::class, 'booking']);
        Route::get('/bookingdetail/{Appointment}', [CustomerController::class, 'bookingdetail']);
        Route::get('/bookingcancel/{Appointment}', [CustomerController::class, 'bookingCancel']);
        Route::get('/bookingreschedule/{Appointment}', [CustomerController::class, 'bookingReschedule']);
        Route::get('/review/{Appointment}', [CustomerController::class, 'review']);
        Route::get('/appointmentJoin/{Appointment}', [CustomerController::class, 'AppointmentJoin']);
        Route::post('/upload/chat/{Appointment}', [helperController::class, 'SaveChatData']);
        Route::get('/get/chat/{Appointment}', [helperController::class, 'getchatdata']);
    });
    
    //offers
    Route::prefix('offers')->group(function () {
        Route::get('offerdetail/{offer}', [CustomerController::class, 'offerdetail']);
        Route::get('purchased/{offer}', [CustomerController::class, 'offerpurchased']);
    });
});


// Mashoora API

Route::post('/consultant/login', [ConsultantController::class, 'login']);
Route::post('/consultant/verifyotp', [ConsultantController::class, 'VerifyOtp']);
Route::prefix('consultant')->middleware('Apiauth:consultant')->group(function () {
    Route::get('/logout', [ConsultantController::class, 'logout']);
    Route::get('/chatlist', [ConsultantController::class, 'chatlistApp']);
    Route::get('/get/consultant', [ConsultantController::class, 'getconsultant']);
    //Notification
    Route::prefix('notification')->group(function () { 
        Route::get('', [ConsultantController::class, 'Notification']);
        Route::post('read', [CustomerController::class, 'notificationread']);
    });
    //profile update
    Route::prefix('profile')->group(function () {
        Route::post('/storeProfile', [ConsultantController::class, 'storeProfile']);
        Route::post('/bankupdate', [ConsultantController::class, 'bankupdate']);
        Route::post('/update/phone', [ConsultantController::class, 'updateuserphone']);
        Route::get('/documents', [ConsultantController::class, 'getdocuments']);
        Route::get('/speclizatioi', [ConsultantController::class, 'getspeclization']);
        Route::get('/insurance', [ConsultantController::class, 'getinsurance']);
    });

    //Bokking
    Route::prefix('booking')->group(function () {
        Route::get('/today', [ConsultantController::class, 'todaybooking']);
        Route::get('/booking', [ConsultantController::class, 'booking']);
        Route::get('/bookingdetail/{Appointment}', [ConsultantController::class, 'bookingdetail']);
        Route::get('/bookingaccept/{Appointment}', [ConsultantController::class, 'bookingaccept']);
        Route::get('/bookingcancel/{Appointment}', [ConsultantController::class, 'bookingcancel']);
        Route::get('/bookingcompleted/{Appointment}', [ConsultantController::class, 'bookingcompleted']);
        Route::get('/bookingnoshow/{Appointment}', [ConsultantController::class, 'NoShowByCustomer']);
        Route::get('/bookingreject/{Appointment}', [ConsultantController::class, 'bookingReject']);
        Route::POST('/upload/chat/{Appointment}', [helperController::class, 'SaveChatData']);
        Route::get('/get/chat/{Appointment}', [helperController::class, 'getchatdata']);
    });
    //schedule
    Route::prefix('schedule')->group(function () {
        Route::get('/indexschedule', [ConsultantController::class, 'indexschedule']);
        Route::get('/getfromdate', [ConsultantController::class, 'getfromdate']);
        Route::post('/saveschedule', [ConsultantController::class, 'saveschedule']);
        Route::post('/saveschedulecopy/{schedule}', [ConsultantController::class, 'saveschedulecopy']);
        Route::delete('/deleteschedule/{schedule}', [ConsultantController::class, 'deleteschedule']);
    });
    //wallet
    Route::prefix('wallet')->group(function () {
        Route::get('/wallet', [ConsultantController::class, 'wallet']);
        Route::post('/addwallet', [ConsultantController::class, 'addwallet']);

        Route::get('/getcard', [ConsultantController::class, 'getcard']);
        Route::post('/addcard', [ConsultantController::class, 'Addcard']);
        Route::delete('/delete/{card}', [ConsultantController::class, 'deletecard']);
    });

    //offers
    Route::resource('offers', OfferController::class)->only(['index','create','destroy','store','edit']);
    Route::get('/offers/subcategory', [OfferController::class, 'offerSubCategory']);
    Route::post('/offers/update/{offer}', [OfferController::class, 'update']);

    //Artical
    Route::resource('articles', ArticleController::class)->only(['index','create','destroy','store','edit']);
    Route::post('/articles/update/{article}', [ArticleController::class, 'update']);

    //Discount
    Route::resource('discounts', DiscountController::class)->only(['index','create','destroy','store','edit']);
    Route::post('/discounts/update/{discount}', [DiscountController::class, 'update']);

    //Pay_Out
    Route::prefix('pay/out')->group(function () {
        Route::get('/', [ConsultantController::class, 'payoutindex']);
        Route::post('/request', [ConsultantController::class, 'payoutrequest']);
    });
    
    //Agora Token
    Route::prefix('agora')->group(function () {
        Route::get('/token/{Appointment}', [ConsultantController::class, 'startsession']);
        Route::get('/recreate/{Appointment}', [ConsultantController::class, 'recreatesession']);
    });

});


// for Consultant API
// Article
Route::get('getArticles', [ArticleController::Class,'getArticle']);
Route::post('article/save', [ArticleController::Class,'store']);
Route::post('article/update', [ArticleController::Class,'update']);
Route::post('article/delete', [ArticleController::Class,'destroy']);


// offer
Route::get('getOffer', [OfferController::Class,'getOffer']);
Route::get('offer/offerSubCategory', [OfferController::Class,'offerSubCategory']);
// Route::get('offer/edit', [OfferController::Class,'edit']);
Route::post('offer/save', [OfferController::Class,'store']);
Route::post('offer/update', [OfferController::Class,'update']);
Route::post('offer/delete', [OfferController::Class,'destroy']);

// discount
Route::get('getDiscount', [DiscountController::Class,'getDiscount']);
Route::get('discount/available', [DiscountController::Class,'available']);
Route::post('discount/save', [DiscountController::Class,'store']);
Route::post('discount/update', [DiscountController::Class,'update']);
Route::post('discount/delete', [DiscountController::Class,'destroy']);

Route::post('benefitspayment', [CustomerController::Class,'Benefitspayment']);

Route::post('paymentsuccess', [helperController::Class,'paymentsuccess'])->name('benefits.paymentsuccess');
Route::post('paymentfail', [helperController::Class,'paymentfail'])->name('benefits.paymentfail');


