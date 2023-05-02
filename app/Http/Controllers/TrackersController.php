<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Tracker;
use App\Http\Requests\TrackerRequest;
use Illuminate\Support\Facades\Auth;

class TrackersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user_id = Auth::id();
        $records = Tracker::where('forenkey_user_id', $user_id)->get();
        return view('trackers.index', ['trackers' => $records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('trackers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TrackerRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TrackerRequest $request)
    {
        $tracker = new Tracker;
        $tracker->trackName = $request->input('trackName');
        $tracker->forenkey_user_id = Auth::id();
        $tracker->save();

        return to_route('trackers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $tracker = Tracker::findOrFail($id);
        return view('trackers.show', ['tracker' => $tracker]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $tracker = Tracker::findOrFail($id);
        return view('trackers.edit', ['tracker' => $tracker]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TrackerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TrackerRequest $request, $id)
    {
        $tracker = Tracker::findOrFail($id);
        $tracker->trackName = $request->input('trackName');
        $tracker->forenkey_user_id = $request->input('forenkey_user_id');
        $tracker->save();

        return to_route('trackers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $tracker = Tracker::findOrFail($id);
        $tracker->delete();

        return to_route('trackers.index');
    }
}
