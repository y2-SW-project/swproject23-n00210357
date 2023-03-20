<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\basket;
use App\Models\fishery;
use App\Models\fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the fishs table/model across the laravel website
class FishController extends Controller
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
        $fishs = fish::with('user')->get();
        $fishs = fish::all();
        //authenticates the fishs to their latest update in pages of 5
        //$fishs = fish::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $fishs = Fish::paginate(6);

        //brings the user to the index page along with the linked in fishs
        return view('user.fishs.index')->with('fishs', $fishs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // brings the user to their show page when called
    public function show(Fish $fish)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $fishs = fish::with('basket')->with('fishery')->get();
        //checks that the fishs are the property of the user otheir wise it calls a 403 error
        if ($fish->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the show page for the user
        return view('user.fishs.show')->with('fish', $fish);
    }
}
