<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;
    //public $searchTerm ='';
    public $search = 'xc';

    public function mount()
    {
        $this->search = '';
    }

    public function render()
    {
        /*  return view('livewire.filter', [
        'featured_products' => Product::where(function($sub_query) {
        $sub_query->where('name', 'like', '%' .$this->searchTerm.'%')
        /* ->orWhere('category', 'like', '%' .$this->searchTerm . '%') ;
        })->paginate(5)
        ]); */

        if (empty($this->search)) {

            return view('livewire.filter' /* ?? 'livewire.vendor' */, [
                'featured_products' => Product::where('name', $this->search)->get(),
                /*  'featured_vendors' => User::where('name', $this->search)->get(), */
            ]);
        } else {
            return view('livewire.filter' /* ?? 'livewire.vendor' */, [
                'featured_products' => Product::search('name', $this->search)->paginate(5),
                /* 'featured_vendors' => User::hasRole('vendor')->search('name', $this->search)->paginate(5), */
            ]);
        }
    }
}
