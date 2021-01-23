<?php

namespace App\Http\Controllers;

use Session;
use App\Facility;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;

class FacilityController extends Controller
{

    public function index()
    {
        return view('facility.index')->with('facilities', Facility::all());
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'string|min:3|required'
        ]);

        Facility::create($data);

        Session::flash('success', 'Facility ' . AppHelper::DataAdded);
        return redirect()->route('room_facility.index');
    }

    public function update(Request $request)
    {
        $room_facility = Facility::findOrFail($request->id);

        $data = $this->validate($request, [
            'name' => 'string|min:3|required'
        ]);
        $room_facility->update($data);

        Session::flash('success', 'Facility ' . AppHelper::DataUpdated);
        return redirect()->route('room_facility.index');

    }


    public function destroy(Facility $room_facility)
    {
        $room_facility->delete();
        Session::flash('error', 'Facility ' . AppHelper::DataDeleted);
        return redirect()->route('room_facility.index');
    }
}
