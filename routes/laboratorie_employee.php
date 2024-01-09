<?php

use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| laboratorie_employee Routes
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
        // laboratorie_employee route dashboard
        Route::get('/dashboard/laboratorie_employee', function () {
            return view('Dashboard.dashboard_LaboratorieEmployee.dashboard');
        })->middleware(['auth:laboratorie_employee'])->name('dashboard.laboratorie_employee');
        //end laboratorie_employee route dashboard

        // Route::middleware('auth:laboratorie_employee')->group(function(){
        //      // route invoice ray
        //     Route::resource ('invoices_ray_employee', InvoiceController::class);
        //     Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
        //     Route::get('view_rays/{id}', [InvoiceController::class,'viewRays'])->name('view_rays');
        //     //end route invoice ray
        // });




        require __DIR__ . '/auth.php';
    });


