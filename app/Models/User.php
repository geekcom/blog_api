<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_login',
        'user_email',
        'user_display_name',
        'user_pass'
    ];

    protected $hidden = [
        'user_pass',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function posts()
    {
        return $this->hasMany(Posts::class, 'user_id');
    }
}