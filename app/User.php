<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // các field này có thể thay đổi giá trị bởi người dùng
    protected $fillable = [
        'full_name', 'email', 'password', 'phone', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // không hiển thị 2 field là password và remember_token trong các record
    protected $hidden = [
        'password', 'remember_token',
    ];

    // người dùng không được phép thay đổi
    protected $guarded = [
        'id'
    ];
}
