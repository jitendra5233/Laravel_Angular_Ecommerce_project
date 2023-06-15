<?php



use Illuminate\Support\Facades\Route;
  
  
use App\Http\Controllers\SendMailController;

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



$controller_path = 'App\Http\Controllers';



// Main Page Route



Route::get('/', function () {

    return redirect('/auth/login');

});



Route::get('/dashbord', [

    'uses'          =>  $controller_path . '\dashboard\Analytics@index',

    'middleware'    => 'checkLogin',

])->name('dashboard-analytics');



// layout

Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');

Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');

Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');

Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');

Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');



// pages

Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');

Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');

Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');

Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');



// authentication

Route::get('/auth/login',[

    'uses'          => $controller_path . '\authentications\LoginBasic@index',

    // 'middleware'    => 'checkstatus',

])->name('auth-login-basic');



Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');

Route::get('/auth/forgot-password', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');



// cards

Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');



// User Interface

Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');

Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');

Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');

Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');

Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');

Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');

Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');

Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');

Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');

Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');

Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');

Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');

Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');

Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');

Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');

Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');

Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');

Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');

Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');



// extended ui

Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');

Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');



// icons

Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');



// form elements

Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');

Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');



// form layouts

Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');

Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');



// tables

Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');





//Harman Old Routes 

Route::post('/post-login', $controller_path . '\authentications\LoginBasic@postLogin')->name('post-login');
Route::get('/logout', $controller_path . '\authentications\LoginBasic@logout')->name('logout');
Route::get('/role-new', ['uses' => $controller_path . '\Account\Role@index','middleware' => 'checkLogin'])->name('role-new');
Route::get('/role-all', $controller_path . '\Account\Role@AllRoleView')->name('role-all');
Route::post('/submit-role', $controller_path . '\Account\Role@Submitrole')->name('submit-role');
Route::get('/user-new', ['uses' => $controller_path . '\Account\User@index','middleware' => 'checkLogin'])->name('user-new');
Route::get('/user-all',['uses' =>  $controller_path . '\Account\User@AllUserView' ,'middleware' => 'checkLogin'])->name('user-all');
Route::post('/submit-user',  $controller_path . '\Account\User@Submituser')->name('submit-user');
Route::get('/View-Role/{id}',['uses' => $controller_path . '\Account\Role@viewRole' ,'middleware' => 'checkLogin'])->name('View-Role');
Route::post('/update-role',['uses' => $controller_path . '\Account\Role@updateRole' ,'middleware' => 'checkLogin'])->name('update-role');
Route::post('/updatehomepage', $controller_path . '\Setting\setting@UpdateHome')->name('setting');
Route::get('/front_book', $controller_path . '\Setting\setting@front_book')->name('front_book');
Route::get('/open_location', $controller_path . '\Setting\setting@open_location')->name('open_location');


// J Old Routes

Route::get('/profile', $controller_path . '\Profile\Profile@index')->name('profile');
Route::post('/updateprofile',['uses' => $controller_path . '\Profile\Profile@updateprofile' ,'middleware' => 'checkLogin'])->name('updateprofile');
Route::post('/updatepassword',['uses' => $controller_path . '\Profile\Profile@updatepassword' ,'middleware' => 'checkLogin'])->name('updatepassword');
Route::get('/setting', $controller_path . '\Setting\setting@index')->name('setting');
Route::post('/addupdatesetting',['uses' => $controller_path . '\Setting\setting@addupdatesetting' ,'middleware' => 'checkLogin'])->name('addupdatesetting');
Route::get('/Edituser/{id}',['uses' => $controller_path . '\Account\User@Edituser' ,'middleware' => 'checkLogin'])->name('Edituser');
Route::post('/updateuser',['uses' => $controller_path . '\Account\User@updateuser' ,'middleware' => 'checkLogin'])->name('updateuser');
Route::post('/Deleteuser',['uses' => $controller_path . '\Account\User@Deleteuser' ,'middleware' => 'checkLogin'])->name('Deleteuser');
Route::post('/Deleteproject',['uses' => $controller_path . '\Project\Project@Deleteproject' ,'middleware' => 'checkLogin'])->name('Deleteproject');
Route::post('/submit-search', $controller_path . '\Search\Search@index')->name('submit-search');
Route::get('/GetUser_single_data/{id}',['uses' => $controller_path . '\Account\User@GetUser_single_data' ,'middleware' => 'checkLogin'])->name('GetUser_single_data');
Route::post('/Sendmail', $controller_path . '\authentications\ForgotPasswordBasic@Sendmail')->name('Sendmail');
Route::get('/ChnagePassword', $controller_path . '\authentications\ForgotPasswordBasic@ChnagePassword')->name('ChnagePassword');
Route::post('/UpdatePassword', $controller_path . '\authentications\ForgotPasswordBasic@UpdatePassword')->name('UpdatePassword');
Route::post('/ChnageupdatePassword', $controller_path . '\authentications\ForgotPasswordBasic@ChnageupdatePassword')->name('ChnageupdatePassword');
Route::get('send/mail', [SendMailController::class, 'send_mail'])->name('send_mail');
Route::get('/organization-calendar',['uses' => $controller_path . '\Holiday\Holiday@organization_calendar' ,'middleware' => 'checkLogin'])->name('organization-calendar');
Route::get('/organization', ['uses' => $controller_path . '\Account\Role@index','middleware' => 'checkLogin'])->name('organization');
Route::post('/update-organization_cal',['uses' => $controller_path . '\Holiday\Holiday@updateOrganizationcal' ,'middleware' => 'checkLogin'])->name('update-organization_cal');
Route::get('/pages-privacy', $controller_path . '\Setting\setting@privacy')->name('privacy');
Route::get('/pages-term_condetion', $controller_path . '\Setting\setting@term_condetion')->name('term_condetion');
Route::get('/pages-who_we_are', $controller_path . '\Setting\setting@who_we_are')->name('who_we_are');
Route::post('/updateprivacy', $controller_path . '\Setting\setting@updateprivacy')->name('updateprivacy');
Route::post('/updateterm', $controller_path . '\Setting\setting@updateterm')->name('updateterm');
Route::post('/updatewho', $controller_path . '\Setting\setting@updatewho')->name('updatewho');



// gforce
// my routes
Route::get('/addBranch', $controller_path . '\gforce\BranchCon@addBranch')->name('addBranch');
Route::get('/allBranch', $controller_path . '\gforce\BranchCon@allBranch')->name('allBranch');
Route::get('/addPackage', $controller_path . '\gforce\PackageCon@addPackage')->name('addPackage');
Route::get('/editPackage/{id}', $controller_path . '\gforce\PackageCon@editPackage')->name('editPackage');
Route::get('/allPackage', $controller_path . '\gforce\PackageCon@allPackage')->name('allPackage');
Route::post('/submitPackage', $controller_path . '\gforce\PackageCon@submitPackage')->name('submitPackage');
Route::post('/submitPackage', $controller_path . '\gforce\PackageCon@submitPackage')->name('submitPackage');
Route::post('/updatePackage', $controller_path . '\gforce\PackageCon@updatePackage')->name('updatePackage');
Route::get('/viewPackage/{id}', $controller_path . '\gforce\PackageCon@viewPackage')->name('viewPackage');
Route::get('/qrcode', $controller_path . '\gforce\QrCodeController@index')->name('viewPackage');
Route::get('/editBranch/{id}', $controller_path . '\gforce\BranchCon@editBranch')->name('editBranch');
Route::get('/viewBranch/{id}', $controller_path . '\gforce\BranchCon@viewBranch')->name('viewBranch');

// Jitendra Routes
//Project Class Module Routes 
Route::get('/projectClassAll',['uses' =>  $controller_path . '\ProjectClass\ProjectClass@projectAllClassView' ,'middleware' => 'checkLogin'])->name('projectClassAll');
Route::get('/projectClassAdd',['uses' =>  $controller_path . '\ProjectClass\ProjectClass@projectClassAdd'  ,'middleware' => 'checkLogin'])->name('projectClassAdd');
Route::post('/submit-ProjectClass',  $controller_path . '\ProjectClass\ProjectClass@projectClassSubmit')->name('submit-ProjectClass');
Route::get('/editClassProject/{id}',['uses' => $controller_path . '\ProjectClass\ProjectClass@editClassProject' ,'middleware' => 'checkLogin'])->name('editClassProject');
Route::post('/updateClassProject',['uses' => $controller_path . '\ProjectClass\ProjectClass@updateClassProject' ,'middleware' => 'checkLogin'])->name('updateClassProject');
Route::post('/deleteProjectClass',['uses' => $controller_path . '\ProjectClass\ProjectClass@deleteProjectClass' ,'middleware' => 'checkLogin'])->name('deleteProjectClass');
Route::get('/projectClassView/{id}',['uses' => $controller_path . '\ProjectClass\ProjectClass@projectClassView' ,'middleware' => 'checkLogin'])->name('projectClassView');

//Student Module Routes
Route::get('/allStudentsView',['uses' => $controller_path . '\Student\Student@index' ,'middleware' => 'checkLogin'])->name('allStudentsView');
Route::get('/getSingleStudent/{id}',['uses' => $controller_path . '\Student\Student@getSingleStudent' ,'middleware' => 'checkLogin'])->name('getSingleStudent');
Route::post('/submitenrollclass',['uses' => $controller_path . '\Student\Student@submitenrollclass' ,'middleware' => 'checkLogin'])->name('submitenrollclass');


//Open Class Module Routes
Route::get('/allOpenClassesView',['uses' => $controller_path . '\OpenClass\OpenClass@index' ,'middleware' => 'checkLogin'])->name('allOpenClassesView');
Route::get('/openClassAdd',['uses' =>  $controller_path . '\OpenClass\OpenClass@openClassAdd'  ,'middleware' => 'checkLogin'])->name('openClassAdd');
Route::post('/submit-OpenClass',  $controller_path . '\OpenClass\OpenClass@openClassSubmit')->name('submit-OpenClass');
Route::get('/editOpenClass/{id}',['uses' => $controller_path . '\OpenClass\OpenClass@editOpenClass' ,'middleware' => 'checkLogin'])->name('editOpenClass');
Route::post('/updateOpenClass',['uses' => $controller_path . '\OpenClass\OpenClass@updateOpenClass' ,'middleware' => 'checkLogin'])->name('updateOpenClass');
Route::post('/deleteOpenClass',['uses' => $controller_path . '\OpenClass\OpenClass@deleteOpenClass' ,'middleware' => 'checkLogin'])->name('deleteOpenClass');
Route::get('/openClassView/{id}',['uses' => $controller_path . '\OpenClass\OpenClass@openClassView' ,'middleware' => 'checkLogin'])->name('openClassView');

//Workshop Modules Routes
Route::get('/allWorkshopView',['uses' => $controller_path . '\Workshop\Workshop@index' ,'middleware' => 'checkLogin'])->name('allWorkshopView');
Route::get('/workshopAdd',['uses' =>  $controller_path . '\Workshop\Workshop@create'  ,'middleware' => 'checkLogin'])->name('workshopAdd');
Route::post('/submit-Workshop',  $controller_path . '\Workshop\Workshop@store')->name('submit-Workshop');
Route::get('/editWorkshop/{id}',['uses' => $controller_path . '\Workshop\Workshop@edit' ,'middleware' => 'checkLogin'])->name('editWorkshop');
Route::post('/deleteWorkshop',['uses' => $controller_path . '\Workshop\Workshop@destroy' ,'middleware' => 'checkLogin'])->name('deleteWorkshop');
Route::post('/updateWorkshop',['uses' => $controller_path . '\Workshop\Workshop@update' ,'middleware' => 'checkLogin'])->name('updateWorkshop');
Route::get('/workshopView/{id}',['uses' => $controller_path . '\Workshop\Workshop@workshopView' ,'middleware' => 'checkLogin'])->name('workshopView');

//Trainer Module Routes
Route::get('/allTrainerView',['uses' => $controller_path . '\Trainer\Trainer@index' ,'middleware' => 'checkLogin'])->name('allTrainerView');
Route::get('/trainerAdd',['uses' =>  $controller_path . '\Trainer\Trainer@create'  ,'middleware' => 'checkLogin'])->name('trainerAdd');
Route::post('/submit-Trainer',  $controller_path . '\Trainer\Trainer@store')->name('submit-Trainer');
Route::get('/editTrainer/{id}',['uses' => $controller_path . '\Trainer\Trainer@edit' ,'middleware' => 'checkLogin'])->name('editTrainer');
Route::post('/updateTrainer',['uses' => $controller_path . '\Trainer\Trainer@update' ,'middleware' => 'checkLogin'])->name('updateTrainer');
Route::post('/deleteTrainer',['uses' => $controller_path . '\Trainer\Trainer@destroy' ,'middleware' => 'checkLogin'])->name('deleteTrainer');
Route::get('/trainerView/{id}',['uses' => $controller_path . '\Trainer\Trainer@trainerView' ,'middleware' => 'checkLogin'])->name('trainerView');

//Blog Module Routes

Route::get('/blog-blogcategory', ['uses' => $controller_path . '\Blog\Blog@blogcategory','middleware' => 'checkLogin'])->name('blog-blogcategory');
Route::get('/blog-newblog', ['uses' => $controller_path . '\Blog\Blog@index','middleware' => 'checkLogin'])->name('blog-newblog');
Route::get('/blog-allblogs', ['uses' => $controller_path . '\Blog\Blog@allblogview','middleware' => 'checkLogin'])->name('blog-allblogs');
Route::post('/addnewblog',['uses' => $controller_path . '\Blog\Blog@addnewblog' ,'middleware' => 'checkLogin'])->name('addnewblog');
Route::post('/Deleteblog',['uses' => $controller_path . '\Blog\Blog@Deleteblog' ,'middleware' => 'checkLogin'])->name('Deleteblog');
Route::post('/updateblog',['uses' => $controller_path . '\Blog\Blog@updateblog' ,'middleware' => 'checkLogin'])->name('updateblog');
Route::get('/Editblog/{id}',['uses' => $controller_path . '\Blog\Blog@Editblog' ,'middleware' => 'checkLogin'])->name('Editblog');
Route::get('/blogView/{id}',['uses' => $controller_path . '\Blog\Blog@blogView' ,'middleware' => 'checkLogin'])->name('blogView');

//Booking Enquries Module Routes
Route::get('/allBookingView',['uses' => $controller_path . '\Enquiry\Booking@index' ,'middleware' => 'checkLogin'])->name('allBookingView');
Route::get('/getSingleBooking/{id}',['uses' => $controller_path . '\Enquiry\Booking@getSingleBooking' ,'middleware' => 'checkLogin'])->name('getSingleBooking');

//Conatct Us Enquries Module Routes
Route::get('/allContactusView',['uses' => $controller_path . '\Enquiry\Contact@index' ,'middleware' => 'checkLogin'])->name('allContactusView');
Route::get('/getSingleContact/{id}',['uses' => $controller_path . '\Enquiry\Contact@getSingleContact' ,'middleware' => 'checkLogin'])->name('getSingleContact');
Route::post('/DeleteContact',['uses' => $controller_path . '\Enquiry\Contact@DeleteContact' ,'middleware' => 'checkLogin'])->name('DeleteContact');


//Carrer  Module Routes
Route::get('/allCarrerView',['uses' => $controller_path . '\Enquiry\Carrer@index' ,'middleware' => 'checkLogin'])->name('allCarrerView');
Route::get('/getSingleCarrer/{id}',['uses' => $controller_path . '\Enquiry\Carrer@getSingleCarrer' ,'middleware' => 'checkLogin'])->name('getSingleCarrer');
Route::post('/DeleteCareer',['uses' => $controller_path . '\Enquiry\Carrer@DeleteCareer' ,'middleware' => 'checkLogin'])->name('DeleteCareer');

//Class Schedule Module
Route::get('/classSchedule',['uses' => $controller_path . '\ClassSchedule\ClassSchedule@index' ,'middleware' => 'checkLogin'])->name('classSchedule');
Route::get('/openClassScheduleView/{id}',['uses' => $controller_path . '\OpenClass\OpenClass@openClassScheduleView' ,'middleware' => 'checkLogin'])->name('openClassScheduleView');
Route::get('/projectClassScheduleView/{id}',['uses' => $controller_path . '\ProjectClass\ProjectClass@projectClassScheduleView' ,'middleware' => 'checkLogin'])->name('projectClassScheduleView');
Route::get('/workshopScheduleView/{id}',['uses' => $controller_path . '\Workshop\Workshop@workshopScheduleView' ,'middleware' => 'checkLogin'])->name('workshopScheduleView');

//Job Position Module

Route::get('/jobposition-newjobposition', ['uses' => $controller_path . '\JobPositions\JobPostion@index','middleware' => 'checkLogin'])->name('jobposition-newjobposition');
Route::get('/jobposition-alljobposition', ['uses' => $controller_path . '\JobPositions\JobPostion@allpoistionview','middleware' => 'checkLogin'])->name('jobposition-alljobposition');
Route::post('/addnewjobposition',['uses' => $controller_path . '\JobPositions\JobPostion@addnewjobposition' ,'middleware' => 'checkLogin'])->name('addnewjobposition');
Route::post('/DeleteJob',['uses' => $controller_path . '\JobPositions\JobPostion@DeleteJob' ,'middleware' => 'checkLogin'])->name('DeleteJob');
Route::post('/updatejob',['uses' => $controller_path . '\JobPositions\JobPostion@updatejob' ,'middleware' => 'checkLogin'])->name('updatejob');
Route::get('/EditJob/{id}',['uses' => $controller_path . '\JobPositions\JobPostion@EditJob' ,'middleware' => 'checkLogin'])->name('EditJob');
Route::get('/JobView/{id}',['uses' => $controller_path . '\JobPositions\JobPostion@JobView' ,'middleware' => 'checkLogin'])->name('JobView');
Route::get('/jobposition-jobpositioncategory', ['uses' => $controller_path . '\JobPositions\JobPostion@jobpositioncategory','middleware' => 'checkLogin'])->name('jobposition-jobpositioncategory');
Route::get('/allPayments', ['uses' => $controller_path . '\Payment\Payment@index','middleware' => 'checkLogin'])->name('allPayments');
Route::get('/PaymentView/{id}',['uses' => $controller_path . '\Payment\Payment@PaymentView' ,'middleware' => 'checkLogin'])->name('PaymentView');

Route::get('/allAttendence', ['uses' => $controller_path . '\Attendence\Attendence@index','middleware' => 'checkLogin'])->name('allAttendence');
Route::get('/AttendenceView/{id}',['uses' => $controller_path . '\Attendence\Attendence@AttendenceView' ,'middleware' => 'checkLogin'])->name('AttendenceView');
Route::get('/school', ['uses' => $controller_path . '\School\School@index','middleware' => 'checkLogin'])->name('school');
Route::get('/schoolcategory', ['uses' => $controller_path . '\School\School@schoolcategory','middleware' => 'checkLogin'])->name('schoolcategory');
Route::get('/add-school', ['uses' => $controller_path . '\School\School@addSchool','middleware' => 'checkLogin'])->name('add-school');
Route::post('/addnewSchool',['uses' => $controller_path . '\School\School@addnewSchool' ,'middleware' => 'checkLogin'])->name('addnewSchool');
Route::post('/DeleteSchool',['uses' => $controller_path . '\School\School@DeleteSchool' ,'middleware' => 'checkLogin'])->name('DeleteSchool');
Route::get('/EditSchool/{id}',['uses' => $controller_path . '\School\School@EditSchool' ,'middleware' => 'checkLogin'])->name('EditSchool');
Route::post('/updateschoolVideo',['uses' => $controller_path . '\School\School@updateschoolVideo' ,'middleware' => 'checkLogin'])->name('updateschoolVideo');
Route::get('/SchoolView/{id}',['uses' => $controller_path . '\School\School@SchoolView' ,'middleware' => 'checkLogin'])->name('SchoolView');
Route::post('/getdatewiseData', $controller_path . '\Workshop\Workshop@getdatewiseData')->name('getdatewiseData');
Route::post('/gettrainerbybranchid', $controller_path . '\ProjectClass\ProjectClass@gettrainerbybranchid')->name('gettrainerbybranchid');
Route::post('/gettrainerbybranchidfromopenclass', $controller_path . '\OpenClass\OpenClass@gettrainerbybranchid')->name('gettrainerbybranchidfromopenclass');
Route::post('/gettrainerbybranchidfromworkshop', $controller_path . '\Workshop\Workshop@gettrainerbybranchid')->name('gettrainerbybranchidfromworkshop');
Route::post('/gettrainerbybranchidfromworkshop', $controller_path . '\Workshop\Workshop@gettrainerbybranchid')->name('gettrainerbybranchidfromworkshop');
Route::get('/achievement', ['uses' => $controller_path . '\Achivement\Achivement@index','middleware' => 'checkLogin'])->name('achievement');
Route::get('/add_achievement', ['uses' => $controller_path . '\Achivement\Achivement@addAchievement','middleware' => 'checkLogin'])->name('add_achievement');
Route::post('/addAchievement',['uses' => $controller_path . '\Achivement\Achivement@addNewAchievement' ,'middleware' => 'checkLogin'])->name('addAchievement');
Route::get('/editAchievement/{id}',['uses' => $controller_path . '\Achivement\Achivement@editAchievement' ,'middleware' => 'checkLogin'])->name('editAchievement');
Route::post('/updateAchievement',['uses' => $controller_path . '\Achivement\Achivement@updateAchievement' ,'middleware' => 'checkLogin'])->name('updateAchievement');
Route::get('/AchievementView/{id}',['uses' => $controller_path . '\Achivement\Achivement@AchievementView' ,'middleware' => 'checkLogin'])->name('AchievementView');
Route::post('/updatehomepageameneties',['uses' => $controller_path . '\Setting\setting@updatehomepageameneties' ,'middleware' => 'checkLogin'])->name('updatehomepageameneties');
Route::get('/pages-school_banner', $controller_path . '\OnlineSchool\OnlineSchool@index')->name('pages-school_banner');
Route::post('/updateOnlineSchool', $controller_path . '\OnlineSchool\OnlineSchool@updateOnlineSchool')->name('updateOnlineSchool');
Route::get('/pages-founding_director', $controller_path . '\TheForcePage\TheForce@index')->name('pages-founding_director');
Route::post('/updateFounder', $controller_path . '\TheForcePage\TheForce@updateFounder')->name('updateFounder');
Route::get('/pages-performing_artist', $controller_path . '\TheForcePage\TheForce@getPerformingArtist')->name('pages-performing_artist');
Route::post('/updateArtist', $controller_path . '\TheForcePage\TheForce@updateArtist')->name('updateArtist');
Route::get('/pages-show_runner', $controller_path . '\TheForcePage\TheForce@getShowRunner')->name('pages-show_runner');
Route::post('/updateRunner', $controller_path . '\TheForcePage\TheForce@updateRunner')->name('updateRunner');
Route::get('/pages-choreographers', $controller_path . '\TheForcePage\TheForce@getChoreographers')->name('pages-choreographers');
Route::post('/updateChoreographer', $controller_path . '\TheForcePage\TheForce@updateChoreographer')->name('updateChoreographer');
Route::post('/getPrice',['uses' => $controller_path . '\Student\Student@getPrice' ,'middleware' => 'checkLogin'])->name('getPrice');

//NewsLetter  Module Routes
Route::get('/allNewsView', $controller_path . '\gforce\BranchCon@allNewsView')->name('allNewsView');
Route::post('/DeleteNews',['uses' => $controller_path . '\gforce\BranchCon@DeleteNews' ,'middleware' => 'checkLogin'])->name('DeleteNews');

Route::get('/export-ContactCSv',['uses' => $controller_path . '\Enquiry\Contact@exportContactCSV' ,'middleware' => 'checkLogin'])->name('export-ContactCSv');




//Make Ecommerce Prokect Routes Here..
Route::get('/getAllProduct',['uses' => $controller_path . '\Ecommerce\Product@index' ,'middleware' => 'checkLogin'])->name('getAllProduct');
Route::get('/addProduct',['uses' => $controller_path . '\Ecommerce\Product@addProduct' ,'middleware' => 'checkLogin'])->name('addProduct');
Route::post('/addNewProduct',['uses' => $controller_path . '\Ecommerce\Product@addNewProduct' ,'middleware' => 'checkLogin'])->name('addNewProduct');

