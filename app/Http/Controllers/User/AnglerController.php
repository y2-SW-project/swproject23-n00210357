<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\fishery;
use App\Models\fish;
use App\Models\Role;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        $role = Role::all();

        //brings the user to the index page along with the linked in anglers
        return view('admin.anglers.index')->with('anglers', $anglers)->with('role', $role);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // brings the user to their show page when called
    public function show(User $angler)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //$fisheries = angler::get();
        //checks that the fisheries are the property of the user otheir wise it calls a 403 error

        //opens up the show page for the user
        $fish = fish::all();
        $role = Role::all();
        return view('admin.anglers.show')->with('angler', $angler)->with('fish', $fish)->with('role', $role);
    }
}
