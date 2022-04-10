<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index()
    {
        return view('site.compares.index');
    }
    
    public function addToCompare(Request $request)
    {
        if ($request->session()->has('compare')) {
            $compare = $request->session()->get('compare', collect([]));
            if (!$compare->contains($request->id)) {
                if (count($compare) == 3) {
                    $compare->forget(0);
                    $compare->push($request->id);
                } else {
                    $compare->push($request->id);
                }
            }
        } else {
            $compare=collect([$request->id]);
            $request->session()->put('compare', $compare);
        }
        return view('site._layouts._partials._new_partials.compare');
    }

    public function reset($id, Request $request)
    {
        $compare = $request->session()->get('compare', collect([]));
        $key=$compare->search($id);
        // $key = session('compare')->search($id);
        $compare->forget($key);

        // $request->session()->forget('compare');
        return back();
    }
}
