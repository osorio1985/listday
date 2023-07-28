<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    public function index()
    {
        $shoppingLists = ShoppingList::all();

        return view('history', ["shoppingLists" => $shoppingLists]);
    }
    public function create(Request $request)
    {
        $listName = $request->input('listName');
        $data = $request->except(['listName', 'saveList']);

        $shoppingListItems = [];

        foreach ($data as $key => $value) {
            if (strpos($key, 'addItem') === 0) {
                $id = explode(",", $key);
                $item_id = $id[1];

                $pieces = $data['addItemCount,' . $item_id];

                $shoppingList = new ShoppingList();
                $shoppingList->item_id = $item_id;
                $shoppingList->name = $listName;
                $shoppingList->pieces = $pieces;

                if (
                    $shoppingList->name !== null && $shoppingList->name !== '' &&
                    $shoppingList->pieces !== null && $shoppingList->pieces !== '' &&
                    $shoppingList->item_id !== null && $shoppingList->item_id !== ''
                ) {
                    $shoppingListItems[] = $shoppingList;
                } else {
                    return back()->with("Incorrect", "Please fill in all the required fields");
                }
            }
        }
        try {
            foreach ($shoppingListItems as $item) {
                if ($item->pieces > 0) {
                    ShoppingList::firstOrCreate([
                        'item_id' => $item->item_id,
                        'name' => $item->name,
                        'pieces' => $item->pieces
                    ]);
                }
            }
            return back()->with("Correct", "Your shopping list is made");
        } catch (\Throwable $th) {
            dd($th);
            return back()->with("Incorrect", "Error");
        }
    }
}
