<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShoppingListController;
use App\Models\Item;
use App\Models\ShoppingList;
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

Route::get('/', function () {
    return view('items');
});

Route::get('/history', function () {
    $categories = Item::select('category')->get();
    return view('history', compact('categories'));
});

Route::post('/history/create', [ItemController::class, 'create'])->name('historyItem.create');

Route::get('/statistics', function () {
    $shoppingLists = ShoppingList::all();
    $items = Item::all();
    return view('statistics', compact('shoppingLists','items'));
});

Route::post('/create', [ShoppingListController::class, 'create'])->name('shoppingList.create');
