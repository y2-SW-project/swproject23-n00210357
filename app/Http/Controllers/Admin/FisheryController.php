<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\baket;
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


        $fisheries = Fishery::paginate(10);

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
         $fishs = fish::all();
         return view('admin.fisheries.create')->with('fishs', $fishs);
     }

     //when called it stores the given data for fisheries into the database fishery table
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //checks if given data is valid before sending to database
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'certification' => 'required',
            //'image' => 'required',
            'photo' => 'file|image',
            'salary' => 'required|between:0,9999.99',
            'fish' =>['required' , 'exists:fishs,id']
        ]);

        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        // the name $namefile needs to be unique, I use title and add the date to guarantee a unique name$namefile, ISBN would be better here.
        $namefile = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
        $path = $photo->storeAs('public/images/fishery', $namefile);

        //uses the new data to create a new fish in the fishery table
        $fishery = Fishery::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'certification' => $request->certification,
            'photo' => $namefile,
            'salary' => $request->salary
        ]);

        //brings the user to the index page
        $fishery->fish()->attach($request->fish);
        return to_route('admin.fisheries.index');
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

        $fisheries = fishery::with('fish')->get();
        //checks that the fisheries are the property of the user otheir wise it calls a 403 error
        if ($fishery->user_id != Auth::id())
        {
            return abort(403);
        }
        $fishs = fish::with('baket')->with('fishery')->get();
        //opens up the show page for the user
        return view('admin.fisheries.show')->with('fishery', $fishery);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected fishery
    public function edit(Fishery $fishery)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the fishery id is not connected to the user preventing another user from opining the edit page on someone elses fishery
        if ($fishery->user_id != Auth::id())
        {
            return abort(403);
        }

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

    //pulls the update page with the selected fisheries data already filled in and prepared to be edited
    public function update(Request $request, Fishery $fishery)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the fishery id is not connected to the user preventing another user from editing someone elses fishery
        if ($fishery->user_id != Auth::id())
        {
            return abort(403);
        }

        //checks if given data is valid before sending to database
        $request->validate([
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'certification' => 'required',
            'photo' => 'file|image',
            'salary' => 'required|between:0,9999.99'
        ]);

        $photo = $request->file('photo');
        $extension = $photo->getClientOriginalExtension();
        // the name $namefile needs to be unique, I use title and add the date to guarantee a unique name$namefile, ISBN would be better here.
        $namefile = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
        $path = $photo->storeAs('public/images/fishery', $namefile);

        //updates the selected fisheries value to their new values
        $fishery->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'certification' => $request->certification,
            'photo' => $namefile,
            'salary' => $request->salary
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

         //call error 403 if the fishery id is not connected to the user preventing another user from deleting someone elses fishery
         if ($fishery->user_id != Auth::id())
         {
             return abort(403);
         }

         $fishery->delete();

         //returns the user to index page and plays the success message Fishery deleted
         return to_route('admin.fisheries.index')->with('success', 'Fishery deleted');
     }
}
