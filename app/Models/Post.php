<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'schedule_type',
        'schedule_time',
        'post_status',
        'email_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
