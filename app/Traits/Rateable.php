<?php


namespace App\Traits;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait Rateable
{
    public function rateOnce($value)
    {
        $rating = Rating::query()
            ->where('rateable_type', '=', get_class($this))
            ->where('rateable_id', '=', $this->id)
            ->where('customer_id', '=', Auth::guard('customer')->user()->id)
            ->first();

        if ($rating) {
            $rating->rating = $value;
            $rating->save();
        } else {
            $this->rate($value);
        }
    }


    public function rate($value, $review)
    {
        $rating = new Rating();
        $rating->rating = $value;
        $rating->user_id = Auth::user()->id;
        $rating->name = Auth::user()->name;
        $rating->email = Auth::user()->email;
        $rating->review = $review;

        return $this->ratings()->save($rating);
    }


    public function ratings(): MorphMany
    {
        return $this->morphMany('willvincent\Rateable\Rating', 'rateable');
    }


    public function timesRated(): int
    {
        return $this->ratings()->count();
    }


    public function usersRated(): int
    {
        return $this->ratings()->groupBy('customer_id')->pluck('customer_id')->count();
    }


    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }


    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }


    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }


    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }


    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }


    // Getters


    public function getUserAverageRatingAttribute()
    {
        return $this->userAverageRating();
    }


    public function userAverageRating()
    {
        return $this->ratings()->where('customer_id', Auth::guard('customer')->user()->id)->avg('rating');
    }


    public function getUserSumRatingAttribute()
    {
        return $this->userSumRating();
    }


    public function userSumRating()
    {
        return $this->ratings()->where('customer_id', Auth::guard('customer')->user()->id)->sum('rating');
    }
}
