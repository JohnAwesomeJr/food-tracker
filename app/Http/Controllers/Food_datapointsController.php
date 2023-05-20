<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Food_datapoint;
use App\Http\Requests\Food_datapointRequest;
use Illuminate\Http\Request;

class Food_datapointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $food_tracker_id = $request->input('food_tracker_id');
        $food_datapoints = Food_datapoint::where('food_tracker_id', $food_tracker_id)->get();
        return view('food_datapoints.index', ['food_datapoints' => $food_datapoints, 'food_tracker_id' => $food_tracker_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('food_datapoints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Food_datapointRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Food_datapointRequest $request)
    {
        $food_tracker_id = $request->input('food_tracker_id');
        $food_datapoint = new Food_datapoint;
        $food_datapoint->image_file_name = $request->input('image_file_name');
        $food_datapoint->rating = $request->input('rating');
        $food_datapoint->food_tracker_id = $request->input('food_tracker_id');
        $food_datapoint->save();
        return redirect("/food_datapoints?food_tracker_id={$food_tracker_id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $food_datapoint = Food_datapoint::findOrFail($id);
        return view('food_datapoints.show', ['food_datapoint' => $food_datapoint]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $food_datapoint = Food_datapoint::findOrFail($id);
        return view('food_datapoints.edit', ['food_datapoint' => $food_datapoint]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Food_datapointRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Food_datapointRequest $request, $id)
    {
        $food_tracker_id = $request->input('food_tracker_id');
        $food_datapoint = Food_datapoint::findOrFail($id);
        $food_datapoint->image_file_name = $request->input('image_file_name');
        $food_datapoint->rating = $request->input('rating');
        $food_datapoint->food_tracker_id = $request->input('food_tracker_id');
        $food_datapoint->save();
        return redirect("/food_datapoints?food_tracker_id={$food_tracker_id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $food_datapoint = Food_datapoint::findOrFail($id);
        $food_tracker_id = $food_datapoint->food_tracker_id;
        $food_datapoint->delete();
        return redirect()->route('food_datapoints.index', ['food_tracker_id' => $food_tracker_id]);
        return to_route('food_datapoints.index');
    }
}
