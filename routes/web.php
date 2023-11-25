<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NlpController;
use App\Http\Controllers\QrcodeController;
// use App\Http\Controllers\Report;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\Transaction;
use App\Models\Qrcodemodel;

// use App\Models\Staff;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [Transaction::class, 'transaction'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // store attendance
    Route::post('/store-attendance',[AttendanceController::class, 'storedAttendance'])->name('store.attendance');

    // inventory
    Route::get('/available-stocks',[TableController::class,'availableStocks'])->name('inventory.available.stocks');
    // show product sold
    Route::get('/show-product-sold',[TableController::class,'purchasedProduct'])->name('inventory.product.sold');
    Route::get('/process-product-sold/{id}',[TableController::class,'processProduct'])->name('inventory.process.sold');
    // show product rejected
    Route::get('/show-product-rejected',[TableController::class,'rejectedProduct'])->name('inventory.product.rejected');
    // show product rejected
    Route::get('/show-product-outofstocks',[TableController::class,'outofstocksProduct'])->name('inventory.product.outofstocks');
    // show product page
    Route::get('/show-product-page',[InventoryController::class,'showProductPage'])->name('show.product.page');
    // add bulk product or single
    Route::post('/manage-products',[InventoryController::class,'manageProducts'])->name('bulk.manage.stocks');
    // create invoice
    Route::post('/create-invoices',[InvoiceController::class,'createInvoices'])->name('bulk.create.invoice');

    // reports
    Route::get('/create-reports',[ReportController::class, 'report'])->name('reports.create');
    Route::post('/generate-reports',[ReportController::class, 'generate'])->name('generate.reports');
    Route::get('/display-reports',[ReportController::class, 'display'])->name('display.reports');
    Route::post('/generated',[ReportController::class, 'generated'])->name('generated');

    // transaction 
    // Route::get('/transaction',[Transaction::class,'transaction'])->name('transaction');

    // employee
    Route::get('/employee',[EmployeeController::class,'employeeTable'])->name('employee.table');
    Route::post('/add-employee',[StaffController::class,'employeeTableAdd'])->name('employee.table.add');
    Route::get('/edit-employee',[StaffController::class,'employeeTableEdit'])->name('employee.table.edit');
    Route::post('/update-employee',[StaffController::class,'employeeTableUpdate'])->name('employee.table.update');
    Route::get('/remove-employee',[StaffController::class,'employeeTableRemove'])->name('employee.table.remove');
    Route::get('/get-attendance',[AttendanceController::class,'employeeTableAttendance'])->name('employee.table.attendance');

    // nlp server route
    Route::post('/nlp',[NlpController::class,'process'])->name('nlp.process');

});

// attendance
Route::get('/scan', [AttendanceController::class, 'showScanPage'])->name('scan.attendance');
Route::post('/scan', [AttendanceController::class, 'processScan'])->name('process-scan');
Route::post('/upload', [AttendanceController::class, 'uploadQR'])->name('upload-qr');
Route::get('/attendance', [AttendanceController::class, 'viewAttendance']);

//qrcodes updates
Route::get('/generateqrcodes/{id}',[QrcodeController::class,'processQrcodes'])->name('qrcodes.process.generate');
Route::get('/updateqrcodes/{id}',[QrcodeController::class,'updateQrcodes'])->name('qrcodes.process.update');

// verification success page
Route::get('/success',[SuccessController::class,'verificationSuccess'])->name('verification.success');

require __DIR__.'/auth.php';
