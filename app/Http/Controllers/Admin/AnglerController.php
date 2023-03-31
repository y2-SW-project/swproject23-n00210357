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
class AnglerController extends Controller
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
        $user->authorizeRoles('admin');

        $anglers = User::paginate(6);
        //brings the user to the index page along with the linked in anglers
        return view('admin.anglers.index')->with('anglers', $anglers);
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
        $user->authorizeRoles('admin');

        $fishs = fish::with('fishery')->get();
        //checks that the fishs are the property of the user otheir wise it calls a 403 error
        if ($fish->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the show page for the user
        return view('admin.fishs.show')->with('fish', $fish);
    }
}
