<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\fishery;
use App\Models\fish;
use App\Models\basket;
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
        $user->authorizeRoles('admin');
        $fishs = fish::with('user')->get();
        $fishs = fish::all();
        //authenticates the fishs to their latest update in pages of 5
        //$fishs = fish::where('user_id', Auth::id())->latest('updated_at')->paginate(5);


        $fishs = Fish::paginate(6);

        //brings the user to the index page along with the linked in fishs
        return view('admin.fishs.index')->with('fishs', $fishs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the fishs create page
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //sends the user to the create page
        $fisheries = fishery::all();
        return view('admin.fishs.create')->with('fisheries', $fisheries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

//when called it stores the given data for fishs into the database fish table
public function store(Request $request)
{
    //checks if given data is valid before sending to database
    $request->validate([
        'fishType' => 'required|max:120',
        'description' => 'required',
        'image' => 'required',
        'price' => 'required|between:0,9999.99',
        'fisheries' => 'required|integer',
    ]);

    $image = $request->file('image');
    $extension = $image->getClientOriginalExtension();
    // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
    $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
    $path = $image->storeAs('public/images/fish', $filename);

    //uses the new data to create a new train in the train table
    Fish::create([
        'uuid' => Str::uuid(),
        'user_id' => Auth::id(),
        'fishType' => $request->fishType,
        'description' => $request->description,
        'image' => $filename,
        'price' => $request->price,
        'fishery_id' => $request->fisheries
    ]);

    //brings the user to the index page
    $fishs = Fish::paginate(6);
    return view('admin.fishs.index')->with('fishs', $fishs);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //sends the user the the edit page with their selected fish
    public function edit(Fish $fish)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the fish id is not connected to the user preventing another user from opining the edit page on someone elses fish
        if ($fish->user_id != Auth::id())
        {
            return abort(403);
        }

        //opens up the edit page for the user with their selected fish
        $fisheries = fishery::all();
        return view('admin.fishs.edit')->with('fish', $fish)->with('success', 'Fish updated')->with('fisheries',$fisheries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //pulls the update page with the selected fishs data already filled in and prepared to be edited
    public function update(Request $request, Fish $fish)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the fish id is not connected to the user preventing another user from editing someone elses fish
        if ($fish->user_id != Auth::id())
        {
            return abort(403);
        }

        //inserts the current values of the selected page onto the page
        $request->validate([
            'fishType' => 'required|max:120',
            'description' => 'required',
            'image' => 'file|image',
            'price' => 'required|between:0,9999.99',
            'fishery_id' => 'required|integer',
        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        // the filename needs to be unique, I use title and add the date to guarantee a unique filename, ISBN would be better here.
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.'. $extension;
        $path = $image->storeAs('public/images/fish', $filename);

        //updates the selected fishs value to their new values
        $fish->update([
            'fishType' => $request->fishType,
            'description' => $request->description,
            'image' => $filename,
            'price' => $request->price,
            'fishery_id' => $request->fishery_id
        ]);

        //returns the user to show page and plays the success message Fish updated
        $fisheries = fishery::all();
        return to_route('admin.fishs.show', $fish)->with('success', 'Fish updated')->with('fisheries',$fisheries);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //when called with a fish id it allows it to be deleted and sends the user back to the users index page
    public function destroy(Fish $fish)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        //call error 403 if the fish id is not connected to the user preventing another user from deleting someone elses fish
        if ($fish->user_id != Auth::id())
        {
            return abort(403);
        }

        $fish->delete();

        //returns the user to index page and plays the success message Fish deleted
        return to_route('admin.fishs.index')->with('success', 'Fish deleted');
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     //when called sends the user to the fishs create page
     public function add(Fish $fish)
     {
         $user = Auth::user();
         $user->authorizeRoles('admin');

         basket::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'fish_id' => 9
        ]);
 
         //returns the user to index page and plays the success message Fish deleted
         return to_route('admin.fishs.index')->with('success', 'Fish deleted');
     }
}
