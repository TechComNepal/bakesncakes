<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Vendor extends Component
{
    use WithPagination;
    public $pagination_limit = 6;
    public $filter = 1;
    public function setPaginationLimit($limit)
    {
        $this->pagination_limit = $limit;
        $this->resetPage();
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }
    public function render()
    {
        $vendor_users=User::with('media')->role('vendor');
        // $vendor_users=User::with('media')->role('vendor')->whereHas('products', function ($query) {
        //     $query->withAvg('ratings', 'rating');
        // })->get()->dd();
     
        $filter = $this->filter;
        if ($filter == 1) {
            $vendors = $vendor_users;
        } elseif ($filter == 2) {
            $vendors = User::with('media')->withCount('products')->orderByDesc('products_count')->role('vendor');
        } else {
            $vendors = $vendor_users;
        }
        $vendors=$vendors->paginate($this->pagination_limit ?? 6);

        $vendors_count=User::role('vendor')->count();
        return view('livewire.vendor', compact('vendors', 'vendors_count'));
    }
}
