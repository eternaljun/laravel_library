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

    Route::resource('books', 'App\Http\Controllers\library\PostController');

//Route::get('books/create', 'App\Http\Controllers\MainController@create');
//Route::post('books/edit', 'App\Http\Controllers\MainController@edit');

//Route::get('/about', function () {
//    return view('home');
//});


//
//$books = \App\Models\Book::all();
//$categories = \App\Models\Category::all();
//foreach ($books as $book){
//    echo '<b>Book</b>:<br>' .$book['name'].'<br>';
//    echo '<b>Category:</b><br>';
//    foreach ($book->categories as $category){
//        echo $category['category'].'<br>';
//
//    }
//    echo '--------------------------<br>';
//}
//echo '--------------------------<br>';
//echo '--------------------------<br>';
//echo '--------------------------<br>';
//echo '--------------------------<br>';
//$books = \App\Models\Book::all();
//foreach ($books as $book){
//    echo '<b>Book</b>:<br>'.$book['name'].'<br>';
//    echo '<b>shelf:</b><br>';
//    echo $book->shelf['shelf'];
//


//    foreach ($books as $book) {
//        echo $book->shelf->shelf;
//    }
//}
