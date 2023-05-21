<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Datapoint;
use App\Http\Requests\DatapointRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatapointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $trackerId = $request->input('tracker_id');
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch datapoints that belong to the specified tracker ID and the authenticated user's ID
        $datapoints = Datapoint::where('forenkey_tracker_id', $trackerId)
            ->where('forenkey_user_id', $userId)
            ->paginate(3)
            ->appends(['tracker_id' => $trackerId]);


        return view('datapoints.index', ['datapoints' => $datapoints, 'trackerId' => $trackerId]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $trackerId = $request->input('tracker_id');
        return view('datapoints.create', ['trackerId' => $trackerId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DatapointRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DatapointRequest $request)
    {
        // Check if a file was uploaded
        $file = $request->file('imageFile');
        $filename = $file->getClientOriginalName();

        $trackerId = $request->input('forenkey_tracker_id');
        $datapoint = new Datapoint;
        $datapoint->image = $filename;
        $datapoint->value = $request->input('value');
        $datapoint->forenkey_tracker_id = $trackerId;
        $datapoint->forenkey_user_id = Auth::id();
        if ($request->hasFile('imageFile')) {
            $file = $request->file('imageFile');
            // Generate a unique filename
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            // Save the file to the storage disk (e.g., "public" disk)
            $path = $file->storeAs('public/images', $filename);
            // Update the datapoint's image property with the file path
            $datapoint = new Datapoint;
            $datapoint->image = $path;
        }
        $datapoint->save();

        return redirect("/datapoints?tracker_id={$trackerId}");
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
        $fileName = $datapoint->image; // Assuming the file path is stored in the 'image' field
        $filePath = 'public/images/' . $fileName;
        if ($filePath) {
            Storage::delete($filePath); // Assuming you're using the default storage disk
            // Alternatively, if you're not using the Storage facade, you can directly delete the file like this:
            // unlink(storage_path('app/' . $filePath));
        }
        $datapoint->delete();
        return to_route('datapoints.index');
    }
}
