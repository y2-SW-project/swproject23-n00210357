<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fish extends Model
{
    //allows the use of factory
    use HasFactory;

    //grants basic protection
    protected $guarded = [];

    //gets key / uuid
    public function getRouteKeyName()
    {
        //returns the uuid at the top of the page as appose to the fishs id
        return 'uuid';
    }

    //links fish to destination as a foreign key
    public function destination()
    {
        return $this->belongsTo(destination::class);
    }

    //links fish to user as a foreign key
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    //links fish to driver as a foreign key
    public function driver()
    {
        return $this->belongsToMany(driver::class)->withTimestamps();
    }
}
