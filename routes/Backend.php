<?php

use App\Events\MyEvent;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\appointments\AppointmentController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::get('/Dashboard_Admin', [DashboardController::class, 'index']);
        // user route dashboard/////////////////////////////////////////////////
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard.user');
        //end user route dashboard/////////////////////////////////////////////

        // admin route dashboard//////////////////////////////////////////////
        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin', 'verified'])->name('dashboard.admin');
        //end admin route dashboard//////////////////////////////////////////////////


        //end doctor route dashboard//////////////////////////////////////////////////
        // ########################################################################################
        Route::middleware('auth:admin')->group(function(){
            ############################ section route

        Route::resource('Sections',SectionController::class);

         ########################### end section route
          ############################ doctor route

        Route::resource('Doctors',DoctorController::class);
        Route::post('update_password',[DoctorController::class,'update_password'])->name('update_password');
        Route::post('update_status',[DoctorController::class,'update_status'])->name('update_status');

        ########################### end doctor route
        ############################ section route

        Route::resource('service',SingleServiceController::class);

        ########################### end section route
        //############################# GroupServices route ##########################################

        Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');

        //############################# end GroupServices route ######################################
        //############################# insurance route ##########################################

        Route::resource('insurance', InsuranceController::class);

        //############################# end insurance route ######################################
          //############################# Ambulance route ##########################################

          Route::resource('Ambulance', AmbulanceController::class);

          //############################# end Ambulance route ######################################
           //############################# Patients route ##########################################

        Route::resource('Patients', PatientController::class);

        //############################# end Patients route ######################################
        //############################# single_invoices route ##########################################

        Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');

        Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');

         //############################# end single_invoices route ######################################
           //############################# Receipt route ##########################################

        Route::resource('Receipt', ReceiptAccountController::class);

        //############################# end Receipt route ######################################
          //############################# Receipt route ##########################################

          Route::resource('Payment', PaymentAccountController::class);

          //############################# end Receipt route ######################################

          //############################# group_invoices route ##########################################

         Route::view('group_invoices','livewire.group_invoices.index')->name('group_invoices');

         Route::view('Print_group_invoices','livewire.group_invoices.print')->name('Print_group_invoices');
          //############################# end group_invoices route ######################################

        //   ray employee route
        Route::resource('ray_employee',RayEmployeeController::class);
        //  end ray employee route

        //   laboratorie_employe route
        Route::resource('laboratorie_employee', LaboratorieEmployeeController::class);
        //   laboratorie_employe route

        Route::get('appointments', [AppointmentController::class,'index'])->name('appointments.index');
        Route::put('appointments/approval/{id}', [AppointmentController::class,'approval'])->name('appointments.approval');
        Route::get('appointments/approval', [AppointmentController::class,'index2'])->name('appointments.index2');
        Route::delete('appointments/destroy/{id}',[AppointmentController::class,'destroy'])->name('appointments.destroy');




        });
        require __DIR__ . '/auth.php';

});
