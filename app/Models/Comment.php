<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public $fillable = ['text', 'user_id', 'tweet_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
