<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\VentasController;


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

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Servicios
    Route::resource('servicios', ServiciosController::class);
    Route::get('servicios/ajax/list/{estado?}', [ServiciosController::class, 'list']);
    Route::post('servicios/etapas/store', [ServiciosController::class, 'etapas_tore'])->name('servicios.etapas.store');
    Route::post('servicios/entregado/{id}', [ServiciosController::class, 'entregado'])->name('servicios.entregado');
    Route::get('servicios/{id}/proforma/edit', [ServiciosController::class, 'proforma_edit'])->name('servicios.proforma.edit');
    Route::post('servicios/{id}/proforma/update', [ServiciosController::class, 'proforma_update'])->name('servicios.proforma.update');
    Route::get('servicios/{id}/proforma/reset', [ServiciosController::class, 'proforma_reset'])->name('servicios.proforma.reset');
    Route::get('servicios/{id}/proforma/print', [ServiciosController::class, 'proforma_print'])->name('servicios.proforma.print');
    Route::post('servicios/{id}/remove/image', [ServiciosController::class, 'remove_image'])->name('servicios.remove.image');

    Route::resource('ventas', VentasController::class);
    Route::get('ventas/ajax/list', [VentasController::class, 'list']);
    Route::get('ventas/{id}/proforma/generate', [VentasController::class, 'proforma_generate'])->name('ventas.proforma.generate');
});
