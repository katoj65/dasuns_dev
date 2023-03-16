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


Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/support-services/list',[SupportServiceController::class,'support_services_list'])->name('supportservices.list');
Route::get('/service-provider/list',[ServiceProviderController::class,'service_provider_list'])->name('serviceprovider.list');
Route::get('/instructions/list',[HomeController::class,'how_it_works'])->name('instruction.list');

Route::middleware('guest')->get('/terms',[TermsController::class,'index'])->name('terms');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile-create-pssu',[ProfileController::class,'create_pssu_profile'])->name('create_profile.pssu');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile',[ProfileController::class,'index'])->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile-create-institution',[ProfileController::class,'create_institution_profile'])->name('profile.create_institution');

Route::middleware(['auth:sanctum', 'verified'])->post('/profile-create-pssp',[PSSPController::class,'store_profile'])->name('profile.create-pssp');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/team',[UserController::class,'show_admins'])->name('admins');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssp-create-reference',[ProfileController::class,'create_PSSP_reference'])->name('profile.create_pssp_reference');

Route::middleware(['auth:sanctum', 'verified'])->post('/pssp-create-security-documents',[ProfileController::class,'create_PSSP_identification_document'])->name('create-PSSP-security-documents');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-pssp-reference',[ProfileController::class,'delete_PSSP_reference'])->name('delete_ppsp_reference');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-pssp-identification-document',[ProfileController::class,'delete_PSSP_identification_document'])->name('delete_pssp_identification_document');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-pssp-services',[ProfileController::class,'delete_PSSP_services'])->name('delete_pssp_services');

Route::middleware(['auth:sanctum', 'verified'])->post('/test',function () {
    return 'mmdjndm';
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

Route::middleware(['auth:sanctum', 'verified'])->post('/store-pssp-experience',[ProfileController::class,'store_pssp_experience'])->name('store.pssp_experience');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete_pssp_experience',[ProfileController::class,'delete_PSSP_work_experience'])->name('delete.pssp_experience');

//jobs
Route::middleware('guest')->get('/jobs/register',[JobController::class,'register'])->name('jobs.register');

Route::middleware(['auth:sanctum', 'verified'])->post('/delete-organisation-contact-person',[ProfileController::class,'delete_organisation_contact_person'])->name('delete.organisation_contact_person');

Route::middleware(['auth:sanctum', 'verified'])->post('/add-organisation-contact-person',[ProfileController::class,'add_organisation_contact_person'])->name('add.organisation_contact_person');

Route::middleware(['auth:sanctum', 'verified'])->get('/application-preview/{id}',[VettingController::class,'preview_application'])->name('application_preview');

Route::middleware(['auth:sanctum', 'verified'])->post('/store-interview',[VettingController::class,'create_interview_schedule'])->name('store-interview');

Route::middleware(['auth:sanctum', 'verified'])->get('/interview/{id}',[ReceptionController::class,'show_interview'])->name('interview');

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


Route::middleware(['auth:sanctum', 'verified'])->post('/search-response',[SearchController::class,'store'])->name('store.search');

Route::middleware(['auth:sanctum', 'verified'])->get('/search/{any}',[SearchController::class,'index'])->name('search.results');

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

Route::middleware(['auth:sanctum', 'verified'])->post('/aoopintment-update',[AppointmentController::class,'update'])->name('update.appointment');

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
