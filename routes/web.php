<?php

use App\Http\Controllers\Admin\CartController as AdminCartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController as ControllersMenuController;
use App\Http\Controllers\ProductController as ControllersProductController;

Route::get('admin/users/login', [
    LoginController::class,
    'index'
])->name('login');

Route::post('admin/users/login/store', [
    LoginController::class,
    'store'
]);

Route::post('admin/users/logout', [
    LoginController::class,
    'logout'
]);

Route::get('/admin/users/register', [
    LoginController::class,
    'register'
]);

Route::post('admin/users/register/store', [
    LoginController::class,
    'upRegister'
]);

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [
            \App\Http\Controllers\Admin\MainController::class,
            'index'
        ])->name('admin');

        Route::get('main', [
            \App\Http\Controllers\Admin\MainController::class,
            'index'
        ]);

        // menu
        Route::prefix('menus')->group(function () {
            Route::get('add', [
                MenuController::class,
                'create'
            ]);

            Route::post('add', [
                MenuController::class,
                'store'
            ]);

            Route::get('list', [
                MenuController::class,
                'index'
            ]);

            Route::DELETE('destroy', [
                MenuController::class,
                'destroy'
            ]);

            Route::get('edit/{menu}', [
                MenuController::class,
                'show'
            ]);

            Route::post('edit/{menu}', [
                MenuController::class,
                'update'
            ]);
        });

        // product
        Route::prefix('products')->group(function () {
            Route::get('add', [
                ProductController::class,
                'create'
            ]);

            Route::post('add', [
                ProductController::class,
                'store'
            ]);

            Route::get('list', [
                ProductController::class,
                'index'
            ]);

            Route::get('edit/{product}', [
                ProductController::class,
                'show'
            ]);

            Route::post('edit/{product}', [
                ProductController::class,
                'update'
            ]);

            Route::DELETE('destroy', [
                ProductController::class,
                'destroy'
            ]);
        });

        // slider
        Route::prefix('sliders')->group(function () {
            Route::get('add', [
                SliderController::class,
                'create'
            ]);

            Route::post('add', [
                SliderController::class,
                'store'
            ]);

            Route::get('list', [
                SliderController::class,
                'index'
            ]);

            Route::get('edit/{slider}', [
                SliderController::class,
                'show'
            ]);

            Route::post('edit/{slider}', [
                SliderController::class,
                'update'
            ]);

            Route::DELETE('destroy', [
                SliderController::class,
                'destroy'
            ]);
        });

        // users
        Route::prefix('users')->group(function () {
            Route::get('list', [
                LoginController::class,
                'list'
            ]);

            Route::get('edit/{id}', [
                LoginController::class,
                'edit'
            ]);

            Route::post('edit/{id}', [
                LoginController::class,
                'update'
            ]);
        });

        Route::post('upload/services', [
            UploadController::class,
            'store'
        ]);

        // order
        Route::prefix('customers')->group(function () {
            Route::get('/', [
                AdminCartController::class,
                'index'
            ]);

            Route::get('view/{customer}', [
                AdminCartController::class,
                'show'
            ]);
        });
    });
});

Route::get('/', [
    MainController::class,
    'index'
]);

Route::post('/services/load-product', [
    MainController::class,
    'loadProduct'
]);

Route::get('danh-muc/{id}-{slug}.html', [
    ControllersMenuController::class,
    'index'
]);

Route::post('search', [
    ControllersMenuController::class,
    'search'
]);

Route::get('san-pham/{id}-{slug}.html', [
    ControllersProductController::class,
    'index'
]);

Route::post('add-cart', [
    CartController::class,
    'index'
]);

Route::get('carts', [
    CartController::class,
    'show'
]);

Route::get('orders', [
    CartController::class,
    'showSearch'
]);

Route::post('searchOrders', [
    CartController::class,
    'check'
]);

Route::get('search-orders/view/{id}', [
    CartController::class,
    'showDetail'
]);

Route::post('update-cart', [
    CartController::class,
    'update'
]);

Route::get('carts/delete/{id}', [
    CartController::class,
    'remove'
]);

Route::post('carts', [
    CartController::class,
    'addCart'
]);
