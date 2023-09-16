<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\SupportServices\SupportServiceController;
use App\Http\Controllers\ServiceProvider\ServiceProviderController;
use App\Http\Controllers\Terms\TermsController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Job\JobController;
use App\Http\Controllers\Vetting\VettingController;
use App\Http\Controllers\Interview\InterviewController;
use App\Http\Controllers\Reception\ReceptionController;
use App\Http\Controllers\Panelist\PanelistController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Wallet\WalletController;
use App\Http\Controllers\PSSP\PSSPController;
use App\Http\Controllers\PSSU\PSSUController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Appointment\AppointmentController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Settings\UserSettingsController;
use App\Http\Controllers\Administration\AdministrationController;
use App\Http\Controllers\Request\RequestController;
use App\Http\Controllers\Information\AboutController;
use App\Http\Controllers\Information\WhatwedoController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Messages\MessageController;
use App\Http\Controllers\Approval\ApprovalController;




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

Route::get('/', function () {
return Inertia::render('Welcome', [
'canLogin' => Route::has('login'),
'canRegister' => Route::has('register'),
'laravelVersion' => Application::VERSION,
'phpVersion' => PHP_VERSION,
]);
});




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',[HomeController::class,'index'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/create-appointment',[HomeController::class,'index'])->name('dashboard-create-appointment');


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/support-services/list',[SupportServiceController::class,'support_services_list'])->name('supportservices.list');
Route::get('/service-provider/list',[ServiceProviderController::class,'service_provider_list'])->name('serviceprovider.list');
Route::get('/instructions/list',[HomeController::class,'how_it_works'])->name('instruction.list');
Route::middleware('guest')->post('/post-contact',[PageController::class,'store_contact'])->name('store-contact');

//////

Route::middleware('guest')->get('/terms',[TermsController::class,'index'])->name('terms');
Route::middleware('guest')->get('/about-us',[AboutController::class,'index'])->name('about');
// Route::middleware('guest')->get('/what-we-do',[WhatwedoController::class,'index'])->name('whatwedo');
//
Route::middleware('guest')->get('/support-services',[PageController::class,'support_services'])->name('support-services-page');
Route::middleware('guest')->get('/support-service-providers',[PageController::class,'support_services_providers'])->name('support-service-provider-page');
Route::middleware('guest')->get('/what-we-do',[PageController::class,'how_it_works'])->name('instructions');
Route::middleware('guest')->get('/contact',[PageController::class,'contact'])->name('contact');
Route::middleware('guest')->get('/about',[PageController::class,'about'])->name('about');
/////

Route::middleware(['auth:sanctum', 'verified'])->post('/profile-create-pssu',[ProfileController::class,'create_pssu_profile'])->name('create_profile.pssu');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile',[ProfileController::class,'index'])->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile-create-institution',[ProfileController::class,'create_institution_profile'])->name('profile.create_institution');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile-create-pssp',[PSSPController::class,'store_profile'])->name('profile.create-pssp');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/team',[UserController::class,'show_admins'])->name('admins');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssp-create-reference',[PSSPController::class,'store_reference'])->name('profile.create_pssp_reference');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssp-create-security-documents',[PSSPController::class,'store_identification_document'])->name('create-PSSP-security-documents');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-pssp-reference',[ProfileController::class,'delete_PSSP_reference'])->name('delete_ppsp_reference');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-pssp-identification-document',[ProfileController::class,'delete_PSSP_identification_document'])->name('delete_pssp_identification_document');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-pssp-services',[ProfileController::class,'delete_PSSP_services'])->name('delete_pssp_services');

Route::middleware(['auth:sanctum', 'verified'])->get('/test',function () {
$col=collect([1,2,3,4,5]);
return $col->search(2);


    })->name('test12');


Route::middleware(['auth:sanctum', 'verified'])->post('/user-update-account',[UserController::class,'update'])->name('user_update_account');

Route::middleware(['auth:sanctum', 'verified'])->post('/add_pss_service',[ProfileController::class,'create_PSSP_service'])->name('profile.add_ssp_service');

Route::middleware(['auth:sanctum', 'verified'])->get('/employees',[EmployeeController::class,'index'])->name('employee');

Route::middleware(['auth:sanctum', 'verified'])->post('/employee-create',[ProfileController::class,'search_email'])->name('employee.create');

Route::middleware(['auth:sanctum', 'verified'])->get('/employee/{id}',[EmployeeController::class,'show'])->name('employee.show');

Route::middleware(['auth:sanctum', 'verified'])->post('/admin-store-new',[ProfileController::class,'store_admin_role'])->name('store.new_admin');

Route::middleware(['auth:sanctum', 'verified'])->post('/admin-delete',[ProfileController::class,'delete_admin_role'])->name('delete.admin');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-services',[ProfileController::class,'delete_services'])->name('delete-services');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete_disabilities',[ProfileController::class,'delete_disabilities'])->name('delete_disabilities');

Route::middleware(['auth:sanctum', 'verified'])->post('/store-pssu-disabilities',[ProfileController::class,'submit_pssu_disabilities'])->name('store.pssu_disabilities');

Route::middleware(['auth:sanctum', 'verified'])->post('/store-pssp-experience',[PSSPController::class,'store_experience'])->name('store.pssp_experience');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete_pssp_experience',[ProfileController::class,'delete_PSSP_work_experience'])->name('delete.pssp_experience');

//jobs
Route::middleware('guest')->get('/careers/register',[JobController::class,'register'])->name('jobs.register');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-organisation-contact-person',[ProfileController::class,'delete_organisation_contact_person'])->name('delete.organisation_contact_person');

Route::middleware(['auth:sanctum', 'verified'])->post('/add-organisation-contact-person',[ProfileController::class,'add_organisation_contact_person'])->name('add.organisation_contact_person');

Route::middleware(['auth:sanctum', 'verified'])->get('/application-preview/{id}',[VettingController::class,'preview_application'])->name('application_preview');

Route::middleware(['auth:sanctum', 'verified'])->post('/store-interview',[VettingController::class,'create_interview_schedule'])->name('store-interview');

// Route::middleware(['auth:sanctum', 'verified'])->get('/interview/{id}',[ReceptionController::class,'show_interview'])->name('interview');


Route::middleware(['auth:sanctum', 'verified'])->post('/create-panelist-profile',[PanelistController::class,'store_profession_profile'])->name('store.profession_profile');


Route::middleware(['auth:sanctum', 'verified'])->post('/delete/',[PanelistController::class,'delete_profession_attribute'])->name('delete.profession_attributes');


Route::middleware(['auth:sanctum', 'verified'])->post('/finish',[PanelistController::class,'finish'])->name('panelist.finish');

Route::middleware(['auth:sanctum', 'verified'])->post('/update/interview',[InterviewController::class,'update'])->name('update.interview');

Route::middleware(['auth:sanctum', 'verified'])->post('/store/interview-recommendation',[InterviewController::class,'store_interview_recommendation'])->name('store.interview_recommendation');

Route::middleware(['auth:sanctum', 'verified'])->post('interview/delete',[InterviewController::class,'destroy'])->name('delete.interview');


Route::middleware(['auth:sanctum', 'verified'])->post('/store/interview-message',[InterviewController::class,'store_interview_decline_message'])->name('store.interview_message');

Route::middleware(['auth:sanctum', 'verified'])->post('/store/panelist-profession-profile',[PanelistController::class,'store_add_professions'])->name('store.panelist_profession_profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/destroy/panelist-expertise',[PanelistController::class,'destroy_expertise'])->name('destroy.panelist_expertise');

Route::middleware(['auth:sanctum', 'verified'])->post('/update/panelist-profile',[PanelistController::class,'update_profile'])->name('update_panelist_profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/store/pssp-account-approval',[InterviewController::class,'store_approve_interview'])->name('store.pssp_account_approval');


Route::middleware(['auth:sanctum', 'verified'])->post('store/interview-rejection',[InterviewController::class,'store_interview_rejection'])->name('store.interview_rejection');


// Route::middleware(['auth:sanctum', 'verified'])->post('/search-response',[SearchController::class,'store'])->name('store.search');

Route::middleware(['auth:sanctum', 'verified'])->get('/searching/{any}',[SearchController::class,'index'])->name('search.results');

Route::middleware(['auth:sanctum', 'verified'])->get('/search/service/{id}',[SearchController::class,'show'])->name('search.service');

Route::middleware(['auth:sanctum','verified'])->get('/wallet',[WalletController::class,'index'])->name('wallet');

Route::middleware(['auth:sanctum', 'verified'])->get('/service-provider/{id}',[PSSPController::class,'show'])->name('show.pssp');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssu/delete-disability',[PSSUController::class,'delete_disability'])->name('pssu.delete-disability');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssu/store-services',[PSSUController::class,'store_services'])->name('pssu.store-services');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssu/store-disability',[PSSUController::class,'store_disability'])->name('pssu.store_disability');

// Route::middleware(['auth:sanctum', 'verified'])->get('/employees',[EmployeeController::class,'index'])->name('employees');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete/employee',[EmployeeController::class,'destroy'])->name('destroy.employee');

Route::middleware(['auth:sanctum', 'verified'])->post('/update/employee-role',[EmployeeController::class,'update'])->name('update.employee_role');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile/update-about',[PSSPController::class,'update_about'])->name('update.profile_about');

Route::middleware(['auth:sanctum,', 'verified'])->post('/store/appointment',
[AppointmentController::class,'store'])->name('store.appointment');

Route::middleware(['auth:sanctum', 'verified'])->get('/appointment-details/{id}',[AppointmentController::class,'show'])->name('appointment.details');


Route::middleware(['auth:sanctum', 'verified'])->post('/appintment-update',[AppointmentController::class,'update'])->name('update.appointment');



Route::middleware(['auth:sanctum', 'verified'])->post('/appointment/add-services',[AppointmentController::class,'add_services'])->name('appointment.add_services');

Route::middleware(['auth:sanctum', 'verified'])->post('/appointment/destroy',[AppointmentController::class,'destroy'])->name('appointment.delete');

Route::middleware(['auth:sanctum', 'verified'])->post('/appointment/delete-services',[AppointmentController::class,'delete_service'])->name('appointment.delete_services');

Route::middleware(['auth:sanctum', 'verified'])->post('/cart/add',[AppointmentController::class,'add_cart'])->name('cart.add');

Route::middleware(['auth:sanctum', 'verified'])->get('/cart/{id}',[CartController::class,'show'])->name('cart.show');

Route::middleware(['auth:sanctum', 'verified'])->post('/appointment/add-work-days',[AppointmentController::class,'add_appointment_work_days'])->name('appointment.work_days');

Route::middleware(['auth:sanctum', 'verified'])->post('/cart/remove-item',[AppointmentController::class,'remove_from_cart'])->name('cart.remove');

Route::middleware(['auth:sanctum', 'verified'])->post('/cart/make-payment',[CartController::class,'make_payment'])->name('cart.make_payment');

Route::middleware(['auth:sanctum','verified'])->post('/reception/add-about',[ReceptionController::class,'add_reception_about'])->name('reception.create_about');

Route::middleware(['auth:sanctum', 'verified'])->post('/reception/edit',[ReceptionController::class,'update'])->name('reception.edit_user');

Route::middleware(['auth:sanctum', 'verified'])->post('/reception/delete',[ReceptionController::class,'destroy'])->name('reception.delete');

Route::middleware(['auth:sanctum', 'verified'])->post('/reception/edit-reception-profile',[ReceptionController::class,'edit_reception_profile'])->name('reception.edit_profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/employee/approve',[ReceptionController::class,'approve_employ_account'])->name('employee.approve');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssu/institution/update-contact-person',[PSSUController::class,'update_innstitution_contact_person'])->name('pssu.update_contact_person');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssu/peroanl-profile',[PSSUController::class,'update_personal_profile'])->name('pssu.update_profile');

Route::middleware(['auth:sanctum', 'verified'])->get('/settings',[UserSettingsController::class,'index'])->name('settings');

//delete account.
Route::middleware(['auth:sanctum', 'verified'])->post('/account/destroy-user-account',function () {
return('some information');
})->name('account.destroy');

//update password.
Route::middleware(['auth:sanctum', 'verified'])->post('/account/update-password',[UserSettingsController::class,'change_password'])->name('account.update_password');


//admin change employee status
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/change-employee-status',[AdministrationController::class,'change_employee_status'])->name('admin.change_employee_status');

Route::middleware(['auth:sanctum', 'verified'])->get('/appointments',[AppointmentController::class,'index'])->name('appointments');

Route::middleware(['auth:sanctum', 'verified'])->get('/requests',[RequestController::class,'index'])->name('requests');

Route::middleware('guest')->get('/profession-service/{id}',[PageController::class,'show_all_services'])->name('profession-service');

Route::middleware(['auth:sanctum', 'verified'])->get('/service-provider-appointments',[PSSPController::class,'list_appointments'])->name('list_appointments');

Route::middleware(['auth:sanctum','verified'])->post('/appointment-update-status',[PSSPController::class,'update_appointment_status'])->name('appointment-update-state');

Route::middleware(['auth:sanctum', 'verified'])->post('/wallet-deposit',[WalletController::class,'deposit_funds'])->name('wallet-deposit');

Route::middleware(['auth:sanctum', 'verified'])->get('/services-pssp',[PSSPController::class,'pssp_services_list'])->name('pssp-services');

Route::middleware(['auth:sanctum', 'verified'])->post('/request/find-services',[RequestController::class,'request_service'])->name('request-service');

Route::middleware(['auth:sanctum', 'verified'])->get('request/service/{id}/location/{any}',[RequestController::class,'request_service_provider'])->name('request-srvice-search');

Route::middleware(['auth:sanctum', 'verified'])->get('/notifications',[NotificationController::class,'index'])->name('notifications');

// Route::middleware(['auth:sanctum', 'verified'])->post('/notifications/update-status',[NotificationController::class,'update_status'])->name('notification-status-update');

Route::middleware(['auth:sanctum', 'verified'])->get('/service-providers',[ServiceProviderController::class,'index'])->name('service-providers');

Route::middleware(['auth:sanctum', 'verified'])->get('/support-services',[SupportServiceController::class,'index'])->name('support-services');

Route::middleware(['auth:sanctum', 'verified'])->get('/wallet/deposit',[WalletController::class,'deposit_funds_view'])->name('wallet.deposit');

Route::middleware(['auth:sanctum', 'verified'])->get('/wallet/withdraw',[WalletController::class,'withdraw_funds_view'])->name('wallet.withdraw');
Route::middleware(['auth:sanctum', 'verified'])->get('/wallet/history',[WalletController::class,'wallet_history'])->name('wallet.history');

Route::middleware('guest')->post('/password/forgot',[UserController::class,'forgot_password'])->name('password.forgot');

Route::middleware('guest')->get('/email/verification',[UserController::class,'password_reset'])->name('password.code');

Route::middleware('guest')->post('/new-password',[UserController::class,'create_new_password'])->name('password.new');

Route::middleware(['auth:sanctum', 'verified'])->get('/appointment/{id}',[AppointmentController::class,'showAppointment'])->name('appoitment.show');

Route::middleware(['auth:sanctum','verified'])->post('/appointemnt/update-status',[AppointmentController::class,'update_appointment_status'])->name('appoinment.update_status');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/accounts',[AdministrationController::class,'accounts'])->name('admin.accounts');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/{id}',[AdministrationController::class,'show_admins'])->name('admins.show');

Route::middleware(['auth:sanctum', 'verified'])->post('/admin/{id}/destroy',[AdministrationController::class,'destroy'])->name('admin.destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/service/providers',[AdministrationController::class,'service_providers'])->name('service.providers');

Route::middleware(['auth:sanctum', 'verified'])->get('/service-provider/{id}',[AdministrationController::class,'show_service_providers'])->name('service_provider.profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/service-provider/{id}/destroy',[AdministrationController::class,'destroy_pssp'])->name('service_provider.destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/services',[SupportServiceController::class,'index'])->name('services');

Route::middleware(['auth:sanctum', 'verified'])->post('/services/destroy',[SupportServiceController::class,'destroy'])->name('services.destroy');

Route::middleware(['auth:sanctum', 'verified'])->post('/services/store',[SupportServiceController::class,'store'])->name('services.store');

Route::middleware(['auth:sanctum', 'verified'])->get('/users/active/admin',[AdministrationController::class,'active_users'])->name('users.active');

Route::middleware(['auth:sanctum', 'verified'])->get('/interview/{id}',[InterviewController::class,'show'])->name('interview');

Route::middleware(['auth:sanctum', 'verified'])->get('/interviews',[InterviewController::class,'index'])->name('interviews');

Route::middleware(['auth:sanctum', 'verified'])->get('/wallet/admin',[WalletController::class,'admin_wallet'])->name('wallet.admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/sections',[PageController::class,'sections'])->name('sections');

Route::middleware(['auth:sanctum', 'verified'])->post('/section/store',[PageController::class,'store_section'])->name('section.store');

Route::middleware(['auth:sanctum', 'verified'])->post('/section/update',[PageController::class,'update_section'])->name('section.update');

Route::middleware(['auth:sanctum', 'verified'])->post('/section/destroy',[PageController::class,'destroy_section'])->name('section.destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/users/service-providers',[PSSPController::class,'index'])->name('user.service-providers');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{id}/service-provider',[PSSPController::class,'show'])->name('profile.pssp');

Route::middleware(['auth:sanctum', 'verified'])->post('/appointment/pay',[AppointmentController::class,'make_payment'])->name('appointment.pay');

Route::middleware(['auth:sanctum', 'verified'])->post('/appointment/cancel',[AppointmentController::class,'cancel_appointment'])->name('appointment.cancel');

Route::middleware(['auth:sanctum', 'verified'])->get('/messages',[MessageController::class,'index'])->name('messages');

Route::middleware(['auth:sanctum', 'verified'])->post('/search/store',[SearchController::class,'store'])->name('search.store');

Route::middleware(['auth:sanctum', 'verified'])->get('/search/{any}',[SearchController::class,'index'])->name('search.found');

Route::middleware(['auth:sanctum', 'verified'])->get('search/{id}/{any}',[SearchController::class,'advanced_search'])->name('search.advanced');

Route::middleware(['auth:sanctum', 'verified'])->get('/request/{id}',[RequestController::class,'show'])->name('request.show');

Route::middleware(['auth:sanctum', 'verified'])->put('/appointment/update',[AppointmentController::class,'update_appointment_status_as_request'])->name('appointment.update');

Route::middleware(['auth:sanctum','verified'])->get('/tasks',[AppointmentController::class, 'tasks_view'])->name('tasks');

Route::middleware(['auth:sanctum', 'verified'])->put('/appointment/pssp-pssu-confirm',[AppointmentController::class,'user_provider_confirmation'])->name('appointment.pssp_pssu_confirm');


Route::middleware(['auth:sanctum', 'verified'])->put('/profile/update/institution',[ProfileController::class,'update_institution_profile'])->name('profile.edit_institution');

Route::middleware(['auth:sanctum', 'verified'])->put('/profile/update-contact-person',[ProfileController::class,'update_contact_person'])->name('profile.update_contact_person');

Route::middleware(['auth:sanctum', 'verified'])->put('/profile/update-pssp',[ProfileController::class,'update_pssp_profile'])->name('profile.update_pssp');

Route::middleware(['auth:sanctum', 'verified'])->put('/profile/update-pssu-personal',[ProfileController::class,'update_pssu_personal'])->name('profile.update-pssu-personal');

Route::middleware(['auth:sanctum', 'verified'])->get('/approvals',[ApprovalController::class,'index'])->name('approvals');

Route::middleware(['auth:sanctum', 'verified'])->put('/approval/status-approve',[ApprovalController::class,'update'])->name('approval.status_approve');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile/admin/complete',[ProfileController::class,'store'])->name('profile.complete_profile');


Route::middleware(['auth:sanctum', 'verified'])->put('/profile/update-biodata',[ProfileController::class,'update'])->name('profile.update_biodata');

Route::middleware(['auth:sanctum', 'verified'])->put('profile/update/empolyee',[ProfileController::class,'update_employee_profile'])->name('profile.update_employee');

Route::middleware(['auth:sanctum', 'verified'])->get('/service-users',[PSSUController::class,'index'])->name('service.users');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{id}/user',[PSSUController::class,'show'])->name('user.profile');
