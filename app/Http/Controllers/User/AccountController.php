<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\fishery;
use App\Models\fish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the fishs table/model across the laravel website
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // The part of the controller that sends the user and their select data to the index page
    
     public function index()
     {
         $user = Auth::user();
         $user->authorizeRoles('user');
 
         //$fisheries = angler::get();
         //checks that the fisheries are the property of the user otheir wise it calls a 403 error
 
         //opens up the show page for the user
         $fish = fish::all();
         return view('user.account.index')->with('user', $user)->with('fish', $fish);
     }
}
