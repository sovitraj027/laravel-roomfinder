<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function Ajax(Request $request)
    {
        if ($request->wf == 'educationStore') {
            $response = $this->store($request->course, $request->institution, $request->completed_year);
        }

        if ($request->wf == 'educationDelete') {
            $response = $this->destroy($request->id);
        }

        if ($request->wf == 'educationUpdate') {
            $response = $this->update($request->id, $request->course, $request->institution, $request->completed_year);
        }
    }

    public function store($course, $institution, $completed_year)
    {
        /*if($course == "" || $institution == "" || $completed_year == ""){
            return $resp = array('success' => false, 'course' => $course);
        }*/
        $education = Education::create([
            'course' => $course,
            'institution' => $institution,
            'completed_year' => $completed_year,
            'user_id' => Auth::id()
        ]);


        /* $data = [
             'success' => true,
             'message' => 'Your AJAX processed correctly',
             'id' =>  $education->user_id
         ];

         return response()->json($data);*/
        return $resp = array('success' => true, 'message' => "student of certain grade section", 'id' => $education->user_id);
        // return $education;
    }

    public function update($id, $course, $institution, $completed_year )
    {
        $education = Education::findOrFail($id);
        $education->course = $course;
        $education->institution = $institution;
        $education->completed_year = $completed_year;
        $education->save();
        return redirect()->back();

    }


    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();
        return redirect()->back();
    }
}
