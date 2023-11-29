<?php

use Illuminate\Support\Facades\Route;

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

// User Authentication
Route::get("/register", [App\Http\Controllers\UserAuthentication::class, "Register"]);
Route::get("/signin", [App\Http\Controllers\UserAuthentication::class, "Signin"]);
Route::get("/update", [App\Http\Controllers\UserAuthentication::class, "Update"]);
Route::get("/signout", [App\Http\Controllers\UserAuthentication::class, "Signout"]);

// Pages
// Base
Route::get("/", function()
{
	return view("index");
});

// Others
Route::get("/login", function()
{
	return view("pages/login");
});
Route::get("/profile", function()
{
	return view("pages/profile");
});
Route::get("/catalogs", [App\Http\Controllers\Products::class, "Index"]);
Route::get("/product/{productId}/details", [App\Http\Controllers\Products::class, "Details"]);
Route::get("/cart", [App\Http\Controllers\Cart::class, "Index"]);
Route::get("/cart/addcart/{productId}/{amounts}/{param}", [App\Http\Controllers\Cart::class, "addCart"]);
Route::get("/payment/{subTotalPrice}/{amounts}/{deliverPrice}/{totalPrice}/{uniqueCode}/{courier}", [App\Http\Controllers\Payment::class, "Index"]);
Route::get("/payment/payproducts/{totalPrice}/{uniqueCode}/{courier}", [App\Http\Controllers\Payment::class, "payProducts"]);
Route::get("/payment/success", function()
{
	return view("pages/paymentsuccess");
});
Route::get("/aboutus", function()
{
	return view("pages/aboutus");
});

// Features
Route::get("/recommendation", function()
{
	return view("pages/features/recommendation");
});
Route::get("/manual", function()
{
	return view("pages/features/manual");
});
Route::get("/monitor", function()
{
	return view("pages/features/monitor");
});
Route::get("/aimessage", function()
{
	return view("pages/features/aimessage");
});
Route::post("sendChatAI", [App\Http\Controllers\ChatAI::class, "sendChat"]);