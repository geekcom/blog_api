<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use SoftDeletes;

    protected $table = 'comments';
    protected $primaryKey = 'comment_id';

    protected $fillable = [
        'post_id',
        'comment_author',
        'comment_author_email',
        'comment_date',
        'comment_content'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function posts()
    {
        return $this->belongsTo(Posts::class, 'post_id');
    }
}
