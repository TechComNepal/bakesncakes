<?php

namespace App\Http\Controllers\Site;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __invoke(Request $request)
    {
        $product = Product::find($request->product_id);

        $existing_rating=Rating::where('user_id', Auth::id())->where('rateable_id', $product->id)->first();
        if ($existing_rating) {
            $existing_rating->rating=$request->rating;
            $existing_rating->review=$request->review;
            $existing_rating->update();
            return redirect()->route('site.page.singleProductShow', $product->id)->with('success', 'Review Update success.');
        } else {
            return $product->rate($request->rating, $request->review)
            ? redirect()->route('site.page.singleProductShow', $product->id)->with('success', 'Review success.')
            : redirect()->back()->with('error', 'Something went wrong. Please try again later.')->withInput();
        }
    }

    public function deleteReview($id)
    {
        $data = Rating::findOrFail($id);
        $data->delete();
        return $data?
             response()->json([ 'status' => 'success', 'message' => 'Review Successfully Deleted.'])
            : response()->json([ 'status' => 'error', 'message' => 'There was some issue with the server. Please try again.']);
    }

    
    public function showReview(Request $request)
    {
        if ($request->ajax()) {
            $count=$request['count'];
            $data = Rating::where('rateable_id', $request->id)
            ->orderBy('created_at', 'desc')
          ->limit($count)
          ->get();
        
            $output = '';
            $last_id = '';
                                                                              
            if (!$data->isEmpty()) {
                $output .= ' <div class="ps-product__tabreview" id="product-review">';
                foreach ($data as $row) {
                    $output .= ' <div class="ps-review--product">
                                                <div class="ps-review__row">
                                                    <div class="ps-review__avatar"><img src="'.$row->user->getFirstOrDefaultMediaUrl('avatars', 'avatar') .'"
                                                            alt="alt" /></div>
                                                    <div class="ps-review__info">
                                                        <div class="ps-review__name">
                                                            '. $row->user->name .' </div>
                                                        <div class="ps-review__date">
                                                            '.$row->created_at->isoFormat('MMM Do YYYY') .'
                                                        </div>
                                                    </div>
                                                    <div class="rating">';
                    for ($i = 0; $i < $row->rating; $i++) {
                        $output .= '<i class="fa fa-star checked"> </i>';
                    }
                    for ($j = $row->rating; $j < 5; $j++) {
                        $output .= '<i class="fa fa-star"> </i>';
                    }
                    $output .= ' </div>
                                                    <div class="ps-review__desc">
                                                        <p>'. $row->review.'</p>
                                                    </div>';
                    if (Auth::check()) {
                        if (auth()->user()->id == $row->user_id) {
                            $output .= '  <span>
                                                                <a href="javascript:void(0)" id="delete-review"
                                                                    data-id="'. $row->id.'"
                                                                    class="btn btn-danger btn-sm" data-bs-toggle="tooltip"
                                                                    title="Delete Review">Delete
                                                                </a>
                                                            </span>';
                        }
                    }
                    $output .= ' </div>
                                            </div>';
                }
                if ($count<=$data->count()+1) {
                    $output .= '<div class="row mt-2">
                                            <div class="col-12 col-lg-4">
                                            </div>                       
                                             <div class="col-3 text-center">
                                                <button class="btn ps-btn ps-btn--warning" id="view-more">View
                                                    More</button>
                                            </div> 
                                             ';
                } else {
                    $output .= '<div class="row mt-2">
                                            <div class="col-12 col-lg-4">
                                            </div>                       
                                             <div class="col-3 text-center">
                                                <button class="btn ps-btn ps-btn--warning" >No
                                                    More Reviews</button>
                                            </div> 
                                             ';
                }
            } else {
                $output .= '
       <div class="ps-review--product">
                                                <p>No Reviews Yet!!! </p>
                                            </div>
       ';
            }
                 
            echo $output;
        }
    }
}
