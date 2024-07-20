<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\User;
use App\Models\Product;


// Route::post('/cart/{id}', [HomeController::class,'cart_products']);

Route::get('/authenticationview', function(){
	return view('layout.homepage');
});
Route::get('/salesorderlist', [HomeController::class,'sales_orderlist']);
Route::get('/deleteprodcart/{id}', [HomeController::class,'delete_prodcart']);
// Route::delete('/deleteprodcart/{id}', [HomeController::class,'delete_prodcart']);
Route::post('/cart', [HomeController::class,'cart_products']);
Route::post('/qtajaxrequest', [HomeController::class,'quantity_update']);
Route::post('/placeorder', [HomeController::class,'place_order'])->name('placeorder');

Route::get('/customerlogin', [HomeController::class,'customer_login']);
Route::get('/adminlogin', [HomeController::class,'admin_login']);
Route::post('/login', [HomeController::class,'login']);
Route::get('/productsdashboard', [HomeController::class,'products_dashboard']);
Route::get('/createproduct', [HomeController::class,'create_product']);
Route::post('/productinsert', [HomeController::class,'product_insert']);
Route::get('/customerproducts', [HomeController::class,'customer_productdashboard']);
Route::get('/cartview', [HomeController::class,'cart_view']);

Route::get('/', function (User $user) {
	
	
/*  $user->name ='Tech Master';
		$user->email='techmaster@gmail.com';
		$user->user_role=1;
		$user->email_verified_at=1;
		$user->password=Hash::make('admin@123');
		$user->created_at = date('Y-m-d H:i:s');
		$user->updated_at = date('Y-m-d H:i:s');
$user->save();
 exit;
 */			
 
/* 	DB::enableQueryLog();
        User::create([
		'name'=>'Tech Master',
		'email'=>'techmaster@gmail.com',
		'user_role'=>1,
		'email_verified_at'=>1,
		'password'=>Hash::make('admin@123'),
		]);
		$query = DB::getQueryLog();
		dd($query);
 */
		$products = Product::all();
		return view('esite.home',compact('products')); 
});
