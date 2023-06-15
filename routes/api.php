<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\MailController;
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

$controller_path = 'App\Http\Controllers';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// gforce
// my routes
Route::post('/submitBranch', $controller_path . '\gforce\BranchCon@submitBranch')->name('submitBranch');
Route::post('/updateBranch', $controller_path . '\gforce\BranchCon@updateBranch')->name('updateBranch');
Route::post('/deletePackage', $controller_path . '\gforce\PackageCon@deletePackage')->name('deletePackage');
Route::post('/signup', $controller_path . '\gforce\UserCon@signup')->name('signup');
Route::post('/signin', $controller_path . '\gforce\UserCon@signin')->name('signin');
Route::get('/getBranch', $controller_path . '\gforce\BranchCon@getBranch')->name('getBranch');
Route::post('/getWorkShopByBranch', $controller_path . '\Api\ProjectClass@getWorkShopByBranch')->name('getWorkShopByBranch');
Route::post('/getClassByBranch', $controller_path . '\Api\ProjectClass@getClassByBranch')->name('getClassByBranch');
Route::get('/getClasses', $controller_path . '\Api\ProjectClass@getClasses')->name('getClasses');
Route::get('/getOpenClasses', $controller_path . '\Api\ProjectClass@getOpenClasses')->name('getOpenClasses');
Route::get('/getWorkshops', $controller_path . '\Api\ProjectClass@getWorkshops')->name('getWorkshops');
Route::get('/getBlogs', $controller_path . '\Blog\Blog@getBlogs')->name('getBlogs');
Route::get('/getBlogsCat', $controller_path . '\Blog\Blog@getBlogsCat')->name('getBlogsCat');
Route::post('/deleteBranch', $controller_path . '\gforce\BranchCon@deleteBranch')->name('deleteBranch');
Route::get('/getSingleBlogs/{id}', $controller_path . '\Blog\Blog@getSingleBlogs')->name('getSingleBlogs');
Route::post('/getAllBlogsSingle', $controller_path . '\Api\Blog@getAllBlogsSingle')->name('getAllBlogsSingle');


Route::post('/getProfile', $controller_path . '\gforce\UserCon@getProfile')->name('getProfile');
Route::post('/savePayment', $controller_path . '\Ecommerce\Payment@savePayment')->name('savePayment');
Route::post('/getWorkShopSingle', $controller_path . '\Api\ProjectClass@getWorkShopSingle')->name('getWorkShopSingle');
Route::get('/getAttendance', $controller_path . '\Api\Attendance@getAttendance')->name('getAttendance');
Route::get('/getAllBookings/{id}', $controller_path . '\gforce\Payment@getAllBookings')->name('getAllBookings');
Route::post('/markAttendance', $controller_path . '\Api\Attendance@markAttendance')->name('markAttendance');
Route::get('/getAttendanceSingle/{id}', $controller_path . '\Api\Attendance@getAttendanceSingle')->name('getAttendanceSingle');

Route::post('/getClassesByBranchByDate', $controller_path .'\Api\ProjectClass@getClassesByBranchByDate')->name('getClassesByBranchByDate');
Route::post('/getOpenClassSingle', $controller_path .'\Api\ProjectClass@getOpenClassSingle')->name('getOpenClassSingle');

Route::get('/getJobCategory', $controller_path .'\Api\Job@getJobCategory')->name('getJobCategory');
Route::get('/getJobs', $controller_path .'\Api\Job@getJobs')->name('getJobs');
Route::post('/submitCareerForm', $controller_path .'\Api\Job@submitCareerForm')->name('submitCareerForm');

Route::get('/getSettingData', $controller_path . '\Api\Setting@getSettingData')->name('getSettingData');

Route::get('/getOtherData', $controller_path . '\Setting\setting@getOtherData')->name('getOtherData');

Route::post('/updateUser', $controller_path . '\gforce\UserCon@updateUser')->name('updateUser');

Route::post('/handleEmailSubmit', $controller_path . '\gforce\UserCon@handleEmailSubmit')->name('handleEmailSubmit');

Route::post('/handleOtpSubmit', $controller_path . '\gforce\UserCon@handleOtpSubmit')->name('handleOtpSubmit');

Route::post('/handleNewPSubmit', $controller_path . '\gforce\UserCon@handleNewPSubmit')->name('handleNewPSubmit');

Route::post('/submitnewsletter', $controller_path . '\gforce\UserCon@submitnewsletter')->name('submitnewsletter');

Route::post('/getPopData', $controller_path . '\Api\ProjectClass@getPopData')->name('getPopData');

Route::post('/getEnrolledWorkshop', $controller_path .'\Api\ProjectClass@getEnrolledWorkshop')->name('getEnrolledWorkshop');
Route::post('/getEnrolledClasses', $controller_path .'\Api\ProjectClass@getEnrolledClasses')->name('getEnrolledClasses');
Route::get('/getFounderData', $controller_path .'\TheForcePage\TheForce@getFounderData')->name('getFounderData');

Route::post('/getSingleVideoData', $controller_path .'\Api\ProjectClass@getSingleVideoData')->name('getSingleVideoData');


Route::get('/getArtistData', $controller_path .'\TheForcePage\TheForce@getArtistData')->name('getArtistData');
Route::get('/getRunnerData', $controller_path .'\TheForcePage\TheForce@getRunnerData')->name('getRunnerData');
Route::get('/getChoreographersData', $controller_path .'\TheForcePage\TheForce@getChoreographersData')->name('getChoreographersData');

Route::get('/getOnlineSchoolData', $controller_path .'\Api\ProjectClass@getOnlineSchoolData')->name('getOnlineSchoolData');
Route::get('/getOnlineSchool', $controller_path .'\Api\ProjectClass@getOnlineSchool')->name('getOnlineSchool');

Route::post('/getpayments', $controller_path .'\Api\ProjectClass@getpayments')->name('getpayments');


//Jitendra Routes
Route::post('/changeProjectClassStatus', $controller_path . '\Api\ProjectClass@changeProjectClassStatus')->name('changeProjectClassStatus');
Route::post('/changeOpenClassStatus', $controller_path . '\Api\ProjectClass@changeOpenClassStatus')->name('changeOpenClassStatus');
Route::post('/changeWorkshopStatus', $controller_path . '\Api\ProjectClass@changeWorkshopStatus')->name('changeWorkshopStatus');
Route::post('/changeWorkshopStatus', $controller_path . '\Api\ProjectClass@changeWorkshopStatus')->name('changeWorkshopStatus');
Route::post('/changeblogstatus', $controller_path . '\Api\User@changeblogstatus')->name('changeblogstatus');
Route::post('/sendcontactmail', $controller_path . '\Api\User@sendcontactmail')->name('sendcontactmail');
Route::post('/sendcareermail',[MailController::class,'sendMail']);
Route::post('/changeuserstatus', $controller_path . '\Api\User@Index')->name('changeuserstatus');
Route::post('/changeTrainerStatus', $controller_path . '\Api\ProjectClass@changeTrainerStatus')->name('changeTrainerStatus');
Route::post('/addblogcategory', $controller_path . '\Api\Blog@addblogcategory')->name('addblogcategory');
Route::post('/Deleteblogcategory', $controller_path . '\Api\Blog@Deleteblogcategory')->name('Deleteblogcategory');
Route::post('/changepositionstatus', $controller_path . '\Api\User@changepositionstatus')->name('changepositionstatus');
Route::post('/addjobcategory', $controller_path . '\Api\User@addjobcategory')->name('addjobcategory');
Route::post('/Deletejobcategory', $controller_path . '\Api\User@Deletejobcategory')->name('Deletejobcategory');
Route::post('/add-schoolcategory', $controller_path . '\Api\User@addschoolcategory')->name('add-schoolcategory');
Route::post('/Deleteschoolcategory', $controller_path . '\Api\User@Deleteschoolcategory')->name('Deleteschoolcategory');
Route::post('/changevideostatus', $controller_path . '\Api\User@changevideostatus')->name('changevideostatus');
Route::post('/deleteEnrollclass', $controller_path . '\Api\User@deleteEnrollclass')->name('deleteEnrollclass');
Route::post('/deleteAchievement', $controller_path . '\Api\User@deleteAchievement')->name('deleteAchievement');
Route::post('/Updatejobcategory', $controller_path . '\Api\User@Updatejobcategory')->name('Updatejobcategory');
Route::post('/Updateschoolcategory', $controller_path . '\Api\User@Updateschoolcategory')->name('Updateschoolcategory');
Route::post('/Updateblogcategory', $controller_path . '\Api\Blog@Updateblogcategory')->name('Updateblogcategory');
Route::get('/getAchievement', $controller_path . '\Achivement\Achivement@getAchievement')->name('getAchievement');
Route::post('/submitNewsletterEmail', $controller_path . '\gforce\BranchCon@submitNewsletterEmail')->name('submitNewsletterEmail');



//Ecommerce Projects Api
Route::post('/changeProductStatus', $controller_path . '\Api\ProjectClass@changeProductStatus')->name('changeProductStatus');
Route::post('/get-all-products', $controller_path . '\Ecommerce\Product@GetAllProducts')->name('get-all-products');
Route::post('/get-single-products', $controller_path . '\Api\Blog@GetSingleProduct')->name('get-single-products');
Route::post('/AddProducttoCart', $controller_path . '\Api\Product@AddProducttoCart')->name('AddProducttoCart');
Route::post('/DeleteCartProduct', $controller_path . '\Api\Product@DeleteCartProduct')->name('DeleteCartProduct');
Route::post('/GetallCartProduct', $controller_path . '\Api\Product@GetallCartProduct')->name('GetallCartProduct');
Route::post('/SubmitUser', $controller_path . '\Ecommerce\User@SubmitUser')->name('SubmitUser');
Route::post('/Login', $controller_path . '\Ecommerce\User@Login')->name('Login');
Route::post('/GetProfile', $controller_path . '\Ecommerce\User@GetProfile')->name('GetProfile');
Route::post('/UpdateProfile', $controller_path . '\Ecommerce\User@UpdateProfile')->name('UpdateProfile');
Route::post('/ForgetPassword', $controller_path . '\Ecommerce\User@ForgetPassword')->name('ForgetPassword');
Route::post('/UpdatePassword', $controller_path . '\Ecommerce\User@UpdatePassword')->name('UpdatePassword');
Route::post('/ValidateOtp', $controller_path . '\Ecommerce\User@ValidateOtp')->name('ValidateOtp');
Route::get('/getSettingData', $controller_path . '\Api\Setting@getSettingData')->name('getSettingData');
Route::get('/GetAllTeam', $controller_path . '\Api\Setting@GetAllTeam')->name('GetAllTeam');
Route::get('/GetHomeBlog', $controller_path . '\Api\Blog@GetHomeBlog')->name('GetHomeBlog');
Route::post('/AddRemoveWishlist', $controller_path . '\Ecommerce\Wishlist@AddRemoveWishlist')->name('AddRemoveWishlist');
Route::post('/GetWishlistData', $controller_path . '\Ecommerce\Wishlist@GetWishlistData')->name('GetWishlistData');
Route::post('/payment', $controller_path . '\PaymentController@processPayment')->name('payment');

























