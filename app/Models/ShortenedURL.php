<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShortenedURL extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'shortened_urls';
    protected $dates = ['deleted_at'];
    protected $fillable = ['original_url', 'short_url', 'user_id', 'active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}