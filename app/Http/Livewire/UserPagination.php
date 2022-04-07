<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class UserPagination extends Component
{
    use WithPagination; 

    public function render()
    {
        return view('livewire.user-pagination', [
            'products' => Product::paginate(12), 
        ]);
    } 
}
