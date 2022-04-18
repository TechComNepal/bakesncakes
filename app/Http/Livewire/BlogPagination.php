<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination; 

class BlogPagination extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.blog-pagination', [
            'blogsPaginate' => Blog::paginate(10),
        ]);
    }
}
