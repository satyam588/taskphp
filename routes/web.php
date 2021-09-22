<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoLogin;
use App\Http\Controllers\Post;

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

Route::get('/login', function () {
    return view('login');
});

Route::post('/do-login', [ DoLogin::class, 'index' ] );

Route::get('/dashboard', function ( Request $request ) {

    if( !empty( $request->session()->get('token') ) ) {
        return view('dashboard');
    }else {
        $request->session()->flash('error', 'Please Login here to access account!');
        return redirect('login');
    }
});

Route::get('/post', function( Request $request ) {

    if( !empty( $request->session()->get('token') ) ) {
        return view('post');
    }else {
        $request->session()->flash('error', 'Please Login here to access account!');
        return redirect('login');
    }
});

Route::get('/datatable', [ Post::class, 'datatable' ]);


Route::get('/logout', function ( Request $request ) {
    $request->session()->forget('token');
    $request->session()->flash('success', 'Logged out Success!');
    return redirect('login');
});
