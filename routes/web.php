<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

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

Route::get('/', function () {
    return view('index');
});


Route::get('login', function () {
    return view('login');
})->middleware("guest");


Route::get('add_product', function () {
    return view('add_product');
})->middleware("auth");


Route::get('edit_product/{id}', function ($id) {
    $product = Product::where("id", $id)->get()->first();
    if ($product) {
        return view('edit_product', [
            "product" => $product
        ]);
    }
    else {
        return redirect()->intended("/")->withErrors("Tuotetta ei ole.");
    }
})->middleware("auth");


Route::post('login', [UserController::class, "login"])->middleware("guest")->name("login");
Route::post('logout', [UserController::class, "logout"])->middleware("auth")->name("logout");

Route::post('add_product', [ProductController::class, "create"])->middleware("auth")->name("add_product");
Route::post('delete_product', [ProductController::class, "destroy"])->middleware("auth")->name("delete_product");
Route::post('edit_product', [ProductController::class, "edit"])->middleware("auth")->name("edit_product");
