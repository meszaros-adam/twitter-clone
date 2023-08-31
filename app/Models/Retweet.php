<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retweet extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "tweet_id"];

    public function getCreatedAtAttribute($value)
    {
        return  Carbon::parse($value)->format('Y/m/d H:i');
    }
}
