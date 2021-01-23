<?php

namespace App\Http\Controllers;

use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function Ajax(Request $request)
    {
        if ($request->wf == 'workStore') {
            $response = $this->store($request->position, $request->company, $request->year);
        }

        if ($request->wf == 'workDelete') {
            $response = $this->destroy($request->id);
        }

        if ($request->wf == 'workUpdate') {
            $response = $this->update($request->id, $request->position, $request->company, $request->year);
        }
    }

    public function store($position, $company, $year)
    {
        $work = Work::create([
            'position' => $position,
            'company' => $company,
            'year' => $year,
            'user_id' => Auth::id()
        ]);

       // return $resp = array('success' => true, 'message' => "student of certain grade section", 'id' => $work->user_id);
         return $work;
    }

    public function update($id, $position, $company, $year )
    {
        $work = Work::findOrFail($id);
        $work->position = $position;
        $work->company = $company;
        $work->year = $year;
        $work->save();
        return redirect()->back();

    }


    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return redirect()->back();
    }
}
