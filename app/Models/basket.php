<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basket extends Model
{
    use HasFactory;

    //grants basic protection
    protected $guarded = [];

    //gets key / uuid
    public function getRouteKeyName()
    {
        //returns the uuid at the top of the page as appose to the fishs id
        return 'uuid';
    }

    //links baskit to fishs as a foreign key
    public function fishs()
    {
        return $this->hasMany((fish::class));
    }

    //links baskit to user as a foreign key
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
