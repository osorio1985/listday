<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemFilter extends Component
{
    public $filterItem = '';

    public function render()
    {
        $items = Item::query()
            ->where('name', 'like', '%' . $this->filterItem . '%')
            ->orWhere('category', 'like', '%' . $this->filterItem . '%')
            ->get();
        return view('livewire.item-filter', compact('items'));
    }
}
