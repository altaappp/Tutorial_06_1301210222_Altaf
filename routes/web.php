<?php

use Illuminate\Support\Facades\Route;

Route::get('/lat1', 'App\Http\Controllers\Lat1Controller@index');
Route::get('/lat1/m2', 	'App\Http\Controllers\Lat1Controller@method2');

use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/products', [ProductController::class, 'store'])->name('products.store');

Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

use Illuminate\Support\Facades\Auth;

Route::match(['get', 'post'], '/login', function () {
    if (Auth::check()) {
        return redirect('/products');
    } else {
        if (request()->isMethod('post')) {
            if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                return redirect('/products');
            } else {
                return redirect('/login')->with('msg', 'Invalid email or password.');
            }
        } else {
            return view('login');
        }
    }
})->name('login');

Route::get('/logout', function (){
    Auth::logout();
    return redirect('/login');
});

use App\Http\Controllers\SiteController;

Route::get('/create-user', [SiteController::class, 'createUser'])->name('user.create');
