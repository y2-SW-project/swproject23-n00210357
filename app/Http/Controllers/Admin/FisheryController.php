<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\fishery;
use App\Models\fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the fisheries table/model across the laravel website
class FisheryController extends Controller
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
        $fisheries = fishery::with('user')->get();
        $fisheries = fishery::all();
        //authenticates the fisheries to their latest update in pages of 5
        //$fisheries = fishery::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $fisheries = Fishery::paginate(6);

        //brings the user to the index page along with the linked in fisheries
        return view('admin.fisheries.index')->with('fisheries', $fisheries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the fisheries create page
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //sends the user to the create page
        $fish = fish::all();
        return view('admin.fisheries.create')->with('fish', $fish);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//when called it stores the given data for fisheries into the database fishery table
public function store(Request $request)
{
    //checks if given data is valid before sending to database
    $request->validate([
        'location' => 'required|max:120',
        'dock' => 'required|max:120',
        'photo' => 'required',
    ]);

    $photo = $request->file('photo');
    $extension = $photo->getClientOriginalExtension();
    // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
    $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
    $path = $photo->storeAs('public/images/fisheries', $filename);

    //uses the new data to create a new train in the train table
    Fishery::create([
        'uuid' => Str::uuid(),
        'location' => $request->location,
        'dock' => $request->dock,
        'photo' => $filename,
    ]);

    //brings the user to the index page
    $fisheries = Fishery::paginate(6);
    return view('admin.fisheries.index')->with('fisheries', $fisheries);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     // brings the user to their show page when called
     public function show(Fishery $fishery)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         $fisheries = fishery::get();
         //checks that the fisheries are the property of the user otheir wise it calls a 403 error

         //opens up the show page for the user
         $fishs = fish::all();
         return view('admin.fisheries.show')->with('fishery', $fishery)->with('fishs', $fishs);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected fisheries
    public function edit(Fishery $fishery)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //opens up the edit page for the user with their selected fishery
        return view('admin.fisheries.edit')->with('fishery', $fishery)->with('success', 'Fishery updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //pulls the update page with the selected fishery data already filled in and prepared to be edited
    public function update(Request $request, Fishery $fishery)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //checks if given data is valid before sending to database
    $request->validate([
        'location' => 'required|max:120',
        'dock' => 'required|max:120',
        'photo' => 'required',
    ]);

    $photo = $request->file('photo');
    $extension = $photo->getClientOriginalExtension();
    // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
    $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
    $path = $photo->storeAs('public/images/fisheries', $filename);

    //uses the new data to create a new train in the train table

    $fishery->update([
        'location' => $request->location,
        'dock' => $request->dock,
        'photo' => $filename,
    ]);

        //returns the user to show page and plays the success message Fishery updated
        return to_route('admin.fisheries.show', $fishery)->with('success', 'Fishery updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //when called with a fishery id it allows it to be deleted and sends the user back to the users index page
    public function destroy(Fishery $fishery)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $fishery->delete();

        //returns the user to index page and plays the success message Fisheru deleted
        return to_route('admin.fisheries.index')->with('success', 'Fishery deleted');
    }
}
