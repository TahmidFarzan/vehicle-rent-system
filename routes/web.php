<?php

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
Route::group(['middleware' => 'disablepreventback'],function(){
    
    Auth::routes();
    // Admin.
    Route::prefix('admin')->group(function(){
      // Admin login route.
        Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
        Route::post('/login/submit', 'Auth\AdminLoginController@AdminLogin')->name('admin.login.submit');
        Route::get('/logout', 'Auth\AdminLoginController@AdminLogout')->name('admin.logout');
      // Admin Password reset route.
        Route::post('password/email', 'Auth\AdminForgetPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset', 'Auth\AdminForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.reset');
        Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
      // home Slider sequence duplicate value found
         Route::get('home-slider-sequence/duplicate/found', 'Admin\HomeSliderController@DuplicateSequence')->name('admin.duplicate.home.slider.sequence');
      // Admin Replay mail for feedback
      Route::post('feedback/send/mail', 'Admin\FeedbackController@ReplayMail')->name('admin.reply.mail');
      // Admin dashboard event book request list
      Route::get('event/book/request/list', 'Admin\DashboardController@EventBookRequestList')->name('admin.event.book.request.list');
      // Admin dashboard event book request detail
      Route::get('event/book/request/detail-{id}', 'Admin\DashboardController@EventBookRequestDetail')->name('admin.event.book.request.detail');
      // Admin dashboard event book request aceept
      Route::post('event/book/request/accept', 'Admin\DashboardController@EventBookRequestAceept')->name('admin.event.book.request.accept');
      // Admin dashboard event book request reject
      Route::post('event_guest_book_request_reject', 'Admin\DashboardController@EventGuestBookRequestReject')->name('admin.event.book.request.reject'); 
       // Admin dashboard vehicle book request list
        Route::get('vehicle/book_request_list', 'Admin\DashboardController@VehicleBookRequestList')->name('admin.vehicle.book.request.list'); 
       // Admin dashboard vehicle book request reject
        Route::post('vehicle_guest_book_request_reject', 'Admin\DashboardController@VehicleBookRequestReject')->name('admin.vehicle.book.request.reject');
       // Admin vehicle rent price Route Distance found
       Route::get('distance/found', 'Admin\VehicleRentPriceController@GetDistance')->name('admin.get.distance');
    
       
    });

    // All user.
    Route::prefix('home')->group(function(){
     
     // Event vehicle count
      Route::get('event/vehicle/count', 'Guest\EventBookRentRequestController@CountVehicle')->name('all_user.event.count.vehicle');
       // Event book price
      Route::get('event/book/price/found', 'Guest\EventBookRentRequestController@GetPrice')->name('all_user.event.get.price');
      // Event vehicle instant book
      Route::get('event/vehicle/instant/book-{id}', 'Guest\EventController@InstantBook')->name('all_user.event.instant.book');
       // Vehicle price found
      Route::get('vehicle/rent/price/found', 'Guest\VehicleBookRentRequestController@GetPrice')->name('all_user.get.price');
      // Vehicle vehicle count
      Route::get('vehicle/count', 'Guest\VehicleBookRentRequestController@CountVehicle')->name('all_user.count.vehicle');

   });
   // Member.
   Route::prefix('member')->group(function(){
     
   });
   // Resources route
   Route::resources([
     // Admin resources route
        // Admin 
        'admin' => 'Admin\DashboardController',
        // Admin slider
        'admin-home_slider' => 'Admin\HomeSliderController',
        // Admin Home
        'admin-home_detail' => 'Admin\HomeDetailController',
        // Admin Contact
        'admin-contact' => 'Admin\ContactUsController',
        // Admin Feedback
        'admin-feedback' => 'Admin\FeedbackController',
        // Admin Service
        'admin-service' => 'Admin\ServiceController',
        // Admin Event
        'admin-event' => 'Admin\EventDetailController',
        // Admin Event price
        'admin-event_price' => 'Admin\EventPriceDetailController',
        // Admin book Event price
        'admin-event_book_rent' => 'Admin\EventBookRentController',
        // Admin Rent mail route
        'admin-rent_mail' => 'Admin\RentMailController',
        // Admin route route
        'admin-route' => 'Admin\RouteController',
        // Admin Vehicle price
        'admin-vehicle_rent_price' => 'Admin\VehicleRentPriceController',
        // Admin vehicle detail
        'admin-vehicle' => 'Admin\VehicleDetailController',
        // Admin vehicle book rent 
         'admin-vehicle_book_rent' => 'Admin\VehicleBookRentController',
        // Admin Admin setting 
        'admin_setting' => 'Admin\AdminSettingController',
        // Admin register user list
        'admin-register_user_list' => 'Admin\RegisterUserList',
        // Admin About Us
        'admin-about_us' => 'Admin\AboutUsController',
     

      // Reg User resources route
        // Reg user home
        'home' => 'User\HomeController',
        // Reg user user setting
       'user_setting' => 'User\UserSettingController',

    
      // User resources route
        // User Home route
        '/' => 'Guest\HomeController',
        // User Contact us route
        'contact-us' => 'Guest\ContactController',
        // User Feedback us route
        'feedback-us' => 'Guest\FeedbackController',
        // User Service route
        'service' => 'Guest\ServiceController',
        // User Event route
        'event' => 'Guest\EventController',
        // User Event rent route
        'event-rent' => 'Guest\EventBookRentRequestController',
        // User Route list route
        'route-list' => 'Guest\RouteListController',
        // User Vehicle list route
        'vehicle-list' => 'Guest\VehicleListController',
        // User Vehicle rent 
        'vehicle-rent' => 'Guest\VehicleBookRentRequestController',
        // User About Us
        'about_us' => 'Guest\AboutUsController',
     
    ]);
});
