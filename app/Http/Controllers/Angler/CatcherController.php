<?php

namespace App\Http\Controllers\Angler;

use App\Http\Controllers\Controller;
use App\Models\destination;
use App\Models\catcher;
use App\Models\fish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

//controlles the placement of the catchers table/model across the laravel website
class CatcherController extends Controller
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

        $catchers = catcher::with('user')->get();
        $catchers = catcher::all();
        //authenticates the catchers to their latest update in pages of 5
        //$catchers = catcher::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $catchers = Catcher::paginate(10);

        //brings the user to the index page along with the linked in catchers
        return view('admin.catchers.index')->with('catchers', $catchers);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the driverss create page
     public function create()
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //sends the user to the create page
         $fishs = fish::all();
         return view('admin.catchers.create')->with('fishs', $fishs);
     }

     //when called it stores the given data for catchers into the database catcher table
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
        $path = $photo->storeAs('public/images/catcher', $namefile);

        //uses the new data to create a new fish in the drive table
        $catcher = Catcher::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'certification' => $request->certification,
            'photo' => $namefile,
            'salary' => $request->salary
        ]);

        //brings the user to the index page
        $catcher->fish()->attach($request->fish);
        return to_route('admin.catchers.index');
    }

    /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */

      // brings the user to their show page when called
      public function show(Catcher $catcher)
     {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $catchers = catcher::with('fish')->get();
        //checks that the catchers are the property of the user otheir wise it calls a 403 error
        if ($catcher->user_id != Auth::id())
        {
            return abort(403);
        }
        $fishs = fish::with('destination')->with('catcher')->get();
        //opens up the show page for the user
        return view('admin.catchers.show')->with('catcher', $catcher);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected catcher
    public function edit(Catcher $catcher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the catcher id is not connected to the user preventing another user from opining the edit page on someone elses catcher
        if ($catcher->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the edit page for the user with their selected catcher
        return view('admin.catchers.edit')->with('catcher', $catcher)->with('success', 'Catcher updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //pulls the update page with the selected catchers data already filled in and prepared to be edited
    public function update(Request $request, Catcher $catcher)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the catcher id is not connected to the user preventing another user from editing someone elses catcher
        if ($catcher->user_id != Auth::id())
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
        $path = $photo->storeAs('public/images/catcher', $namefile);

        //updates the selected catchers value to their new values
        $catcher->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'certification' => $request->certification,
            'photo' => $namefile,
            'salary' => $request->salary
        ]);

        //returns the user to show page and plays the success message Catcher updated
        return to_route('admin.catchers.show', $catcher)->with('success', 'Catcher updated');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //when called with a catcher id it allows it to be deleted and sends the user back to the users index page
     public function destroy(Catcher $catcher)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         //call error 403 if the catcher id is not connected to the user preventing another user from deleting someone elses catcher
         if ($catcher->user_id != Auth::id())
         {
             return abort(403);
         }

         $catcher->delete();

         //returns the user to index page and plays the success message Catcher deleted
         return to_route('admin.catchers.index')->with('success', 'Catcher deleted');
     }
}
