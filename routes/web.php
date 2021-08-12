<?php

use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\HTTP\Controllers\ColorController;
use App\HTTP\Controllers\FrontendController;
use App\HTTP\Controllers\SizeController;
use App\HTTP\Controllers\CartController;
// use App\Models\SubCategory;

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
Route::get('',[FrontendController::class,'frontend'])->name('frontend');
Route::get('/product/{slug}',[FrontendController::class,'productDetails'])->name('productDetails');
Route::get('/get/color/size/{c_id}/{p_id}',[FrontendController::class,'getSize'])->name('getSize');
Route::get('/cart',[CartController::class,'CartPage'])->name('CartPage');
Route::post('/cart-products',[CartController::class,'CartDetails'])->name('CartDetails');
Route::get('/cart-remove/{id}',[CartController::class,'cartremove'])->name('cartremove');
Route::post('/cart-update',[CartController::class,'cartupdate'])->name('cartupdate');












Route::get('dashboard',[BackendController::class,'backend'])->middleware(['auth'])->name('backend');
Route::get('category',[CategoryController::class,'category'])->name('category');
Route::get('add-category',[CategoryController::class,'addcategory'])->name('addcategory');
Route::post('post-category',[CategoryController::class,'postcategory'])->name('postcategory');
Route::post('update-category',[CategoryController::class,'updatecategory'])->name('updatecategory');
Route::get('delete-category/{cat}',[CategoryController::class,'deletecategory'])->name('deletecategory');
Route::get('edit-category/{cat}',[CategoryController::class,'editcategory'])->name('editcategory');
Route::get('trashed-category',[CategoryController::class,'trashedcategory'])->name('trashedcategory');
Route::get('restore-category/{cat}',[CategoryController::class,'restorecategory'])->name('restorecategory');
// Route::get('permanent-category/{cat}',[CategoryController::class,'permanentcategory'])->name('permanentcategory');

// SubCategory
Route::get('sub-category',[SubCategoryController::class,'subcategory'])->name('subcategory');
Route::get('add-subcategory',[SubCategoryController::class,'addsubcategory'])->name('addsubcategory');
Route::post('post-subcategory',[SubCategoryController::class,'postsubcategory'])->name('postsubcategory');
Route::post('all-subcategory-delete',[SubCategoryController::class,'allsubcategorydelete'])->name('allsubcategorydelete');
Route::get('trashed-subcategory',[SubCategoryController::class,'trashedsubcategory'])->name('trashedsubcategory');
Route::get('delete-subcategory/{id}',[SubCategoryController::class,'deletesubcategory'])->name('deletesubcategory');

// Product
Route::get('products',[ProductController::class,'products'])->name('products');
Route::get('add-product',[ProductController::class,'addproducts'])->name('addproducts');
Route::get('api/get-subcat-list/{cat_id}',[ProductController::class,'getsubcat'])->name('getsubcat');
Route::post('post-products',[ProductController::class,'postproduct'])->name('postproduct');
Route::post('update-product',[ProductController::class,'productupdate'])->name('productupdate');
Route::get('delete-products/{pdt}',[ProductController::class,'deleteproduct'])->name('deleteproduct');
Route::get('trashed-products',[ProductController::class,'trashedproducts'])->name('trashedproducts');
Route::get('recover-product/{pdt}',[ProductController::class,'recoverproducts'])->name('recoverproducts');
Route::get('edit-products/{pdt}',[ProductController::class,'editproducts'])->name('editproducts');
Route::post('all-products-delete',[ProductController::class,'allproductsdelete'])->name('allproductsdelete');
Route::get('view-gallery/{pdt}',[ProductController::class,'galleryView'])->name('galleryView');
Route::get('delete-galleryimage/{pdt}',[ProductController::class,'deletegalleryimage'])->name('deletegalleryimage');
Route::get('update-galleryImages/{pdt}',[ProductController::class,'updategalleryImages'])->name('updategalleryImages');
Route::post('post-updategallery',[ProductController::class,'updategallery'])->name('updategallery');

//color
Route::get('add-color',[ColorController::class,'addcolor'])->name('addcolor');
Route::get('view-color',[ColorController::class,'viewcolor'])->name('viewcolor');
Route::post('post-color',[ColorController::class,'postcolor'])->name('postcolor');

//Size
Route::get('add-size',[SizeController::class,'addsize'])->name('addsize');
Route::get('view-size',[SizeController::class,'viewsize'])->name('viewsize');
Route::post('post-size',[SizeController::class,'postsize'])->name('postsize');













require __DIR__.'/auth.php';
