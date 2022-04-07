<?php

namespace App\Http\Controllers\Site;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        return view('site.wishlists.index', [
            'wishlists' => Wishlist::where('user_id', Auth::user()->id)->paginate(9)
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
            if ($wishlist == null) {
                $wishlist = new Wishlist;
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $request->id;
                $wishlist->save();
            }
            return view('site._layouts._partials._new_partials.wishlist');
        }
        return 0;
    }

    public function remove(Request $request)
    {
        $wishlist = Wishlist::findOrFail($request->id);
        if ($wishlist!=null) {
            if (Wishlist::destroy($request->id)) {
                return view('site._layouts._partials._new_partials.wishlist');
            }
        }
        return false;
    }
}
