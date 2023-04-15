<?php
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();
Route::resource('/proveedores', App\Http\Controllers\ProveedoreController::class)->middleware('auth');
Route::resource('/marcas', App\Http\Controllers\MarcaController::class)->middleware('auth');
Route::resource('/productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('/tipos', App\Http\Controllers\TipoController::class)->middleware('auth');
Route::resource('/colores', App\Http\Controllers\ColoreController::class)->middleware('auth');
Route::resource('/inventarios', App\Http\Controllers\InventarioController::class)->middleware('auth');
Route::resource('/locations', App\Http\Controllers\LocationController::class)->middleware('auth');
Route::resource('/units', App\Http\Controllers\UnitController::class)->middleware('auth');
Route::resource('/requeriments', App\Http\Controllers\RequerimentController::class)->middleware('auth');
Route::resource('/trades', App\Http\Controllers\TradeController::class)->middleware('auth');
Route::resource('/addproducts', App\Http\Controllers\AddproductController::class)->middleware('auth');
Route::resource('/pedidos', App\Http\Controllers\PedidoController::class)->middleware('auth');
Route::resource('/addproductopedidos', App\Http\Controllers\AddproductopedidoController::class)->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/gnomenclatura', [App\Http\Controllers\ColoreController::class, 'generar_nomenclaturas'])->name('colore.nomenclaturas');
Route::get('/addproducts/add/{requeriments_id}',[ App\Http\Controllers\AddproductController::class,'add'])->name('addproducts.add')->middleware('auth');
Route::get('/addproducts/{addproducts_id}/delete',[ App\Http\Controllers\AddproductController::class,'destroy'])->name('addproducts.delete')->middleware('auth');
Route::get('/addproducts/{addproducts_id}/transfer',[ App\Http\Controllers\AddproductController::class,'transfer'])->name('addproducts.transfer')->middleware('auth');
Route::get('/inventarios/almacen/{locations_id}',[ App\Http\Controllers\InventarioController::class,'inventarios'])->name('inventario.inventarios')->middleware('auth');
Route::get('/listreq', [App\Http\Controllers\RequerimentController::class,'listreq'])->name('requeriments.listreq')->middleware('auth');
Route::get('/addproduct/list/{requeriments_id}', [App\Http\Controllers\AddproductController::class,'list'])->name('addproducts.list')->middleware('auth');
Route::patch('/addproduct/transfer/{addproduct}',[ App\Http\Controllers\AddproductController::class,'update_transfer'])->name('addproducts.update_transfer')->middleware('auth');
Route::get('/requeriments/check/{requeriment}',[ App\Http\Controllers\RequerimentController::class,'check'])->name('requeriment.check')->middleware('auth');
Route::get('/addproducts/{addproducts_id}/cancel',[ App\Http\Controllers\AddproductController::class,'cancel'])->name('addproducts.cancel')->middleware('auth');
Route::patch('/addproduct/cancel/{addproduct}',[ App\Http\Controllers\AddproductController::class,'cancel_transfer'])->name('addproducts.cancel_transfer')->middleware('auth');
Route::get('/addproducts/{addproducts_id}/delete',[ App\Http\Controllers\AddproductController::class,'destroy'])->name('addproducts.delete')->middleware('auth');
Route::get('/addproductopedidos/add/{id}',[ App\Http\Controllers\AddproductopedidoController::class,'addproductos'])->name('addproductopedido.addproductos')->middleware('auth');
Route::get('/addproductopedidos/{id}/delete',[ App\Http\Controllers\AddproductopedidoController::class,'destroy'])->name('addproductopedido.delete')->middleware('auth');

//Route Hooks - Do not delete//
	Route::view('users', 'livewire.users.index')->middleware('auth');
	Route::view('roles', 'livewire.roles.index')->middleware('auth');
	Route::view('permissions', 'livewire.permissions.index')->middleware('auth');

	Route::view('addventaproducts', 'livewire.addventaproducts.index')->middleware('auth');
	Route::view('addventaproducts/{id}', 'livewire.addventaproducts.index')->name('addventaproducts.venta')->middleware('auth');
    //Route::get('/addproducts/add/{id}',[ App\Http\Controllers\AddproductopedidoController::class,'add'])->name('addproductopedido.addproduct')->middleware('auth');

	Route::view('sales', 'livewire.sales.index')->middleware('auth');
	Route::view('sales/{id}', 'livewire.sales.sale-info')->middleware('auth');
	Route::view('reporteventas', 'livewire.reporteventas.reporte-ventas')->name('reporteventas.index')->middleware('auth');

    
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('pedidos/reporte', [App\Http\Controllers\PedidoController::class,'export'])->name('pedidos.report')->middleware('auth');
Route::get('/app/reporte/{id}', [App\Http\Controllers\AddproductopedidoController::class, 'export'])->name('addproductopedido.report')->middleware('auth');
