<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Food_tracker;
use App\Http\Requests\Food_trackerRequest;
use App\Models\Food_datapoint;
use Illuminate\Support\Facades\Storage;

class Food_trackersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $food_trackers = Food_tracker::all();
        return view('food_trackers.index', ['food_trackers' => $food_trackers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('food_trackers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Food_trackerRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Food_trackerRequest $request)
    {
        $food_tracker = new Food_tracker;
        $food_tracker->name = $request->input('name');
        $food_tracker->save();

        return to_route('food_trackers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $food_tracker = Food_tracker::findOrFail($id);
        return view('food_trackers.show', ['food_tracker' => $food_tracker]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $food_tracker = Food_tracker::findOrFail($id);
        return view('food_trackers.edit', ['food_tracker' => $food_tracker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Food_trackerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Food_trackerRequest $request, $id)
    {
        $food_tracker = Food_tracker::findOrFail($id);
        $food_tracker->name = $request->input('name');
        $food_tracker->save();

        return to_route('food_trackers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function destroy($id)
    // {
    //     $food_tracker = Food_tracker::findOrFail($id);
    //     $food_tracker->delete();

    //     return to_route('food_trackers.index');
    // }

    public function destroy($id)
    {
        $foodTracker = food_tracker::findOrFail($id);

        // Retrieve the list of image file paths associated with the food_datapoints
        $imageFileNames = Food_datapoint::where('food_tracker_id', $foodTracker->id)
            ->pluck('image_file_name')
            ->toArray();

        // Delete the images
        foreach ($imageFileNames as $imageFileName) {
            if ($imageFileName != "old.jpg") {
                Storage::delete('public/images/' . $imageFileName);
            }
        }

        // Delete the food_tracker
        $foodTracker->delete();

        return to_route('food_trackers.index');
    }
}
