<?php

use App\Http\Controllers\doctor_dashboard\InvoiceController;
use App\Http\Controllers\doctor_dashboard\DiagnosticController;
use App\Http\Controllers\doctor_dashboard\LaboratorieController;
use App\Http\Controllers\doctor_dashboard\PatientDetailsController;
use App\Http\Controllers\doctor_dashboard\RayController;
use App\Http\Livewire\Chat\Creatchat;
use App\Http\Livewire\Chat\Main;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| doctor Routes
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

        // doctor route dashboard//////////////////////////////////////////////
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })->middleware(['auth:doctor', 'verified'])->name('dashboard.admin');
        //end doctor route dashboard//////////////////////////////////////////////////


        // ########################################################################################
        Route::middleware('auth:doctor')->group(function () {
            // namepace
            Route::prefix('doctor')->group(function () {

                // invoices route
                Route::resource('invoices', InvoiceController::class);
                // end invoices route

                // completed_invoices
                Route::get('completed_invoices', [InvoiceController::class, 'completedInvoices'])->name('completedInvoices');
                //end invoices route
                // review_invoices route
                Route::get('review_invoices', [InvoiceController::class, 'reviewInvoices'])->name('reviewInvoices');
                //end invoices route

                // review_invoices route
                Route::post('add_review', [DiagnosticController::class, 'addReview'])->name('add_review');
                // end invoices route

                // Diagnostics route
                Route::resource('Diagnostics', DiagnosticController::class);
                //end Diagnostics route

                //rays route
                Route::resource('rays', RayController::class);
                //end rays rout
                //rays route
                Route::resource('Laboratories', LaboratorieController::class);
                Route::get('show_laboratorie/{id}', [InvoiceController::class, 'showLaboratorie'])->name('show.laboratorie');
                //end rays rout

                // rays route
                Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('patient_details');
                //end rays route
                //chat route
                Route::get('list/patients', Creatchat::class)->name('list.patients');
                Route::get('chat/patients', Main::class)->name('chat.patients');
                // end chat route
            });

            Route::get('404', function () {
                return view('Dashboard.404');
            })->name('404');
        });
        require __DIR__ . '/auth.php';
    }
);
