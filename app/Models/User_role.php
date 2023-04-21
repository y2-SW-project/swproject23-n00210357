<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder\user;
use Illuminate\Database\Seeder\role;

class User_role extends Model
{
    //grants basic protection
    protected $guarded = [];

    //links baskit to user as a foreign key
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    //links baskit to role as a foreign key
    public function role()
    {
        return $this->belongsTo(role::class);
    }
}
