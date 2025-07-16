<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DiningHallController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\Kitchen\KitchenController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Biller\PaymentBoxController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Tool\ToolController;
use App\Http\Controllers\Biller\AttentionController;
use App\Http\Controllers\Biller\SummaryController;

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

Route::get('/', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

// Route::view('login', 'auth.login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::view('inicio', 'inicio')->name('inicio')->middleware('auth');
// Route::view('admin', 'admin')->name('admin')->middleware('auth');

Route::prefix('admin')->group(function () {

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('panel', [HomeController::class, 'index'])->name('home');
        Route::get('products/list_delete', [ProductController::class, 'listDelete'])->name('products.deleted');
        Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::resource('products', ProductController::class);

        Route::get('categories/list_delete', [CategoryController::class, 'listDelete'])->name('categories.deleted');
        Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::resource('categories', CategoryController::class);

        Route::resource('providers', ProviderController::class);

        Route::resource('salas', RoomController::class)->parameters(['salas'=>'room'])->names('room');
        Route::resource('tables', TableController::class);
        
        Route::get('user/register', [RegisterController::class, 'create'])->name('formRegistro');
        Route::post('user/register', [RegisterController::class, 'store'])->name('register.store');
        Route::get('user/editPassword/{id}', [RegisterController::class, 'editPassword'])->name('formEdit');
        Route::post('user/updatePassword/{id}', [RegisterController::class, 'updatePassword'])->name('register.update');
        Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    });
    
    Route::middleware(['auth', 'role:1,2,3'])->group(function(){
        Route::resource('customers', CustomerController::class);
        Route::get('caja', [PaymentBoxController::class, 'index'])->name('pay.index');
        Route::get('caja/pago/{order}', [PaymentBoxController::class, 'show'])->name('pay.show');
        Route::post('caja/pago/enviar', [PaymentBoxController::class, 'store'])->name('pay.store');
        Route::get('caja/generado/{order}', [PaymentBoxController::class, 'generatedReceipt'])->name('pay.generated');

        Route::get('attentions/{type}', [AttentionController::class, 'index'])->name('attentions.index');
        Route::get('summary', [SummaryController::class, 'index'])->name('summary.index');
        Route::post('summary/search', [SummaryController::class, 'search'])->name('summary.search');  
        Route::post('summary/action', [SummaryController::class, 'summary'])->name('summary'); 
    });
    
    // Route::get('salas', [RoomController::class, 'index'])->name('room.index');
    // Route::get('salas/create', [RoomController::class, 'create'])->name('room.create');
    // Route::post('salas', [RoomController::class, 'store'])->name('room.store');
    // Route::get('salas/{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
    // Route::post('salas/{room}', [RoomController::class, 'update'])->name('room.update');
    Route::middleware(['auth', 'role:1'])->group(function(){
        Route::resource('vouchers', VoucherController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('payment_methods', PaymentMethodController::class);
    });
});

Route::middleware(['auth', 'role:1,2,5'])->group(function(){
    Route::get('salon', [DiningHallController::class, 'hall'])->name('hall')->withoutMiddleware('role:1,2,5');

    Route::post('check', [DiningHallController::class, 'check']);
    Route::post('add_order', [DiningHallController::class, 'addOrder']);
    Route::post('modify_amount', [DiningHallController::class, 'modifyAmount']);
    Route::post('delete_order', [DiningHallController::class, 'deleteOrder']);
    Route::post('add_note', [DiningHallController::class, 'addNote']);
    Route::post('send_kitchen', [DiningHallController::class, 'sendToKitchen']);
    Route::post('qr_debt', [DiningHallController::class, 'qrDebt']);
    Route::get('see_debt/{code}/{type}', [DiningHallController::class, 'seeDebt']);
    // Route::get('pdf_debt/{code}', [DiningHallController::class, 'pdfDebt']);
    Route::post('finalize_order', [DiningHallController::class, 'finalizeOrder'])->name('finalizeOrder');
});

Route::middleware(['auth', 'role:1,2,4'])->group(function(){
    Route::post('dish_ready', [KitchenController::class, 'dishReady']);
    Route::get('kitchen', [KitchenController::class, 'index'])->name('kitchen.index');
});

/***************************  TOOLS  *****************************/
Route::get('tool/search', [ToolController::class, 'search']);
Route::post('tool/register_customer', [ToolController::class, 'registerCustomer']);


// Route::post('venta', [ToolController::class, 'venta'])->middleware(['auth', 'activ']);

// Route::resource('appointments', App\Http\Controllers\AppointmentController::class)->middleware('admin');
// Route::resource('services', App\Http\Controllers\ServiceController::class)->middleware('admin');
// Route::resource('providers', App\Http\Controllers\ProviderController::class)->middleware('admin');
// Route::resource('products', App\Http\Controllers\ProductController::class)->middleware('admin');
// Route::resource('customers', App\Http\Controllers\CustomerController::class)->middleware('admin');
// Route::resource('categories', App\Http\Controllers\CategoryController::class)->middleware('admin');
// Route::resource('users', App\Http\Controllers\UserController::class)->middleware('admin');
// Route::resource('attentions', App\Http\Controllers\AttentionController::class)->middleware('admin');


// Route::get('resumenes/create/{fecha?}', [ResumeneController::class, 'create'])->name('resumenes.create');
// Route::get('resumenes', [ResumeneController::class, 'index'])->name('resumenes.index');
// Route::post('resumenes/search', [ResumeneController::class, 'search'])->name('resumenes.search');
// Route::post('resumen/accion', [ResumeneController::class, 'resumen'])->name('resumenes'); 

// // Route::view('peluqueria', 'yovis.index');

// Route::get('peluqueria', [AtencionController::class, 'index'])->name('peluqueria');

// Route::post('/save', [AtencionController::class, 'saveSale']);
// Route::get('/show_document/{id}', [AtencionController::class, 'showDocument']);
// Route::get('/comprobante/{venta}', [AtencionController::class, 'comprobante']);
// Route::get('/imprimir/{venta}', [AtencionController::class, 'imprimirPdf'])->name('venta.pdfNota')
