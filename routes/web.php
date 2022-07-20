<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\SocialLoginController;
use App\Models\Product;
use App\Models\ProductStock;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



require __DIR__.'/auth.php';

// Socialite Routes
Route::get('/login/social/redirect/{provider}', [SocialLoginController::class, 'redirect'])->name('socialRedirect');
Route::get('/login/social/callback/{provider}', [SocialLoginController::class, 'callback'])->name('socialCallback');

// admin dashboard route
Route::get('/shop', [AdminController::class, 'adminDashboard'])->name('shop');

// user routes
Route::get('/shop/users', [AdminController::class, 'users'])->name('allUsers');
Route::get('/shop/user/add', [AdminController::class, 'addUser'])->name('addUser');
Route::post('/shop/user/create', [AdminController::class, 'createUser'])->name('createUser');
Route::get('/shop/user/edit/{user}', [AdminController::class, 'editUser'])->name('editUser');
Route::post('/shop/user/update/{user}', [AdminController::class, 'updateUser'])->name('updateUser');
Route::get('/shop/user/view/{user}', [AdminController::class, 'viewUser'])->name('viewUser');
Route::get('/shop/user/trash', [AdminController::class, 'viewSoftDeletedUsers'])->name('trashedUsers');
Route::post('/shop/user/delete/{user}', [AdminController::class, 'softDeleteUser'])->name('deleteUser');
Route::post('/shop/user/restore/{id}', [AdminController::class, 'restoreUser'])->name('restoreUser');
Route::post('/shop/user/permanent-delete/{id}', [AdminController::class, 'permanentDeleteUser'])->name('permanentDeleteUser');

// product routes
Route::get('/shop/products', [ProductController::class, 'allProducts'])->name('allProducts');
Route::get('/shop/products/draft', [ProductController::class, 'draftedProducts'])->name('draftedProducts');
Route::get('/shop/product/add', [ProductController::class, 'createProduct'])->name('createProduct');
Route::post('/shop/product/create', [ProductController::class, 'storeProduct'])->name('storeProduct');
Route::get('/shop/product/edit/{product}', [ProductController::class, 'editProduct'])->name('editProduct');
Route::post('/shop/product/update/{product}', [ProductController::class, 'updateProduct'])->name('updateProduct');
Route::get('/shop/product/view/{product}', [ProductController::class, 'viewProduct'])->name('viewProduct');
Route::get('/shop/product/trash', [ProductController::class, 'trashedProducts'])->name('trashedProducts');
Route::post('/shop/product/delete/{product}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
Route::post('/shop/product/restore/{id}', [ProductController::class, 'restoreProduct'])->name('restoreProduct');
Route::post('/shop/product/permanent-delete/{id}', [ProductController::class, 'permanentDeleteProduct'])->name('permanentDeleteProduct');

// product category routes
Route::get('/shop/product-categories', [ProductCategoryController::class, 'allCategories'])->name('allProductCategories');
Route::get('/shop/product-category/add', [ProductCategoryController::class, 'createCategory'])->name('createProductCategory');
Route::post('/shop/product-category/create', [ProductCategoryController::class, 'storeCategory'])->name('storeProductCategory');
Route::get('/shop/product-category/edit/{category}', [ProductCategoryController::class, 'editCategory'])->name('editProductCategory');
Route::post('/shop/product-category/update/{category}', [ProductCategoryController::class, 'updateCategory'])->name('updateProductCategory');

// product tag routes
Route::get('/shop/product-tags', [ProductTagController::class, 'allTags'])->name('allProductTags');
Route::get('/shop/product-tag/add', [ProductTagController::class, 'createTag'])->name('createProductTag');
Route::post('/shop/product-tag/create', [ProductTagController::class, 'storeTag'])->name('storeProductTag');
Route::get('/shop/product-tag/edit/{tag}', [ProductTagController::class, 'editTag'])->name('editProductTag');
Route::post('/shop/product-tag/update/{tag}', [ProductTagController::class, 'updateTag'])->name('updateProductTag');

Route::post('/shop/product-general-stock/add/{product_id}', [ProductStockController::class, 'storeGeneralStock'])->name('storeGeneralStock');
Route::post('/shop/product-color-stock/add/{product_id}', [ProductStockController::class, 'storeColorStock'])->name('storeColorStock');
Route::post('/shop/product-size-stock/add/{product_id}', [ProductStockController::class, 'storeSizeStock'])->name('storeSizeStock');
Route::post('/shop/product-color-size-stock/add/{product_id}', [ProductStockController::class, 'storeColorSizeStock'])->name('storeColorSizeStock');
//Route::get('/shop/product-stock/{product_id}', [ProductStockController::class, 'productStock'])->name('productStock');

Route::post('/shop/product-images/{product_id}', [ProductImageController::class, 'storeProductImage'])->name('storeProductImage');
Route::post('/shop/product-image/delete/{image}', [ProductImageController::class, 'deleteProductImage'])->name('deleteProductImage');

Route::get('/test/{product_id}', [ProductStockController::class, 'test']);