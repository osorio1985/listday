<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\ShoppingList;
use Livewire\Component;

class History extends Component
{
    public function render()
    {
        $shoppingLists = ShoppingList::all();
        $items = Item::all();

        return view('livewire.history', compact('shoppingLists','items'));
    }
}
