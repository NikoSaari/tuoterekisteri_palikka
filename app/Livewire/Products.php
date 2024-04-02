<?php

namespace App\Livewire;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Product;

class Products extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.products', [
            "products" => Product::orderBy("name")->paginate(10) 
        ]);
    }
}
