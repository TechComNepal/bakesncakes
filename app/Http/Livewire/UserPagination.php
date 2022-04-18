<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
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
