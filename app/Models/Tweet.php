<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'user_id'];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return  Carbon::parse($value)->format('Y/m/d H:i');
    }
}
