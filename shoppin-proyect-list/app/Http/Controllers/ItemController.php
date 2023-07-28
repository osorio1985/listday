<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('items', ["items" => $items]);
    }
    public function create(Request $request){
        //dd($request->all());

        $randomPrice = mt_rand(1, 9999) / 100;
        while ($randomPrice < 0.99) {
            $randomPrice = mt_rand(1, 9999) / 100;
        }
        
        $item = new Item();
        $item->name = $request->input('newItemName');
        $item->note = $request->input('newItemNote');
        $item->image = $request->input('newItemImage');
        $item->category = $request->input('newItemCategory');
        $item->price = $randomPrice;

        if (
            $item->name !== null && $item->name !== '' &&
            $item->category !== null && $item->category !== '' &&
            $item->price !== null && $item->price !== ''
        ) {
            try {
                $item->save();
                return back()->with("Correct", "Item added successfully");
            } catch (\Throwable $th) {
                //dd($th);
                return back()->with("Incorrect", "Error");
            }
        } else {
            return back()->with("Incorrect", "Please fill in all the required fields");
        }
    }
}
