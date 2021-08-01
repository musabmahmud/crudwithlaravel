<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\HTTP\Controllers\ColorController;
use App\HTTP\Controllers\SizeController;
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

Route::get('', function () {
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');


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

//color
Route::get('add-color',[ColorController::class,'addcolor'])->name('addcolor');
Route::get('view-color',[ColorController::class,'viewcolor'])->name('viewcolor');
Route::post('post-color',[ColorController::class,'postcolor'])->name('postcolor');

//Size
Route::get('add-size',[SizeController::class,'addsize'])->name('addsize');
Route::get('view-size',[SizeController::class,'viewsize'])->name('viewsize');
Route::post('post-size',[SizeController::class,'postsize'])->name('postsize');

require __DIR__.'/auth.php';
