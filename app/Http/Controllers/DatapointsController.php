<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Datapoint;
use App\Http\Requests\DatapointRequest;
use Illuminate\Support\Facades\Auth;

class DatapointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index($id)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch datapoints that belong to the specified tracker ID and the authenticated user's ID
        $datapoints = Datapoint::where('forenkey_tracker_id', $id)
            ->where('forenkey_user_id', $userId)
            ->get();

        return view('datapoints.index', ['datapoints' => $datapoints]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('datapoints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DatapointRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DatapointRequest $request)
    {
        $datapoint = new Datapoint;
        $datapoint->image = $request->input('image');
        $datapoint->value = $request->input('value');
        $datapoint->forenkey_tracker_id = $request->input('forenkey_tracker_id');
        $datapoint->forenkey_user_id = $request->input('forenkey_user_id');
        $datapoint->save();

        return to_route('datapoints.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $datapoint = Datapoint::findOrFail($id);
        return view('datapoints.show', ['datapoint' => $datapoint]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $datapoint = Datapoint::findOrFail($id);
        return view('datapoints.edit', ['datapoint' => $datapoint]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DatapointRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DatapointRequest $request, $id)
    {
        $datapoint = Datapoint::findOrFail($id);
        $datapoint->image = $request->input('image');
        $datapoint->value = $request->input('value');
        $datapoint->forenkey_tracker_id = $request->input('forenkey_tracker_id');
        $datapoint->forenkey_user_id = $request->input('forenkey_user_id');
        $datapoint->save();

        return to_route('datapoints.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $datapoint = Datapoint::findOrFail($id);
        $datapoint->delete();

        return to_route('datapoints.index');
    }
}
