<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $table = 'posts';
    protected $primaryKey = 'post_id';

    protected $fillable = [
        'user_id',
        'post_author',
        'post_date',
        'post_content',
        'post_title'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'user_id');
    }
}
