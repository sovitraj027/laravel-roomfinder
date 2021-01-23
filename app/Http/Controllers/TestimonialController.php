<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->admin) {
            $testimonials = Testimonial::all();
        } else {
            $testimonials = Testimonial::where('user_id', $user->id)->get();
        }
        return view('testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->admin) {
            return redirect('/home');
        }
        return view('testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest();

        $user = Auth::user();
        $testimonial = new Testimonial();
        $testimonial->title = $request->title;
        $testimonial->description = $request->description;
        $testimonial->user_id = $user->id;
        $testimonial->save();

        return redirect('testimonial')->with('success', 'Testimonial ' . AppHelper::DataAdded);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $user = Auth::user();
        if ($user->admin) {
            return redirect('/home');
        }
        return view('testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $this->validateRequest();

        $user = Auth::user();
        $testimonial->title = $request->title;
        $testimonial->description = $request->description;
        $testimonial->user_id = $user->id;
        $testimonial->save();

        return redirect('testimonial')->with('success', 'Testimonial ' . AppHelper::DataUpdated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->approved) {
            Session::flash('success', 'Approved testimonials cannot be deleted !');
            return redirect()->back();
        }
        $testimonial->delete();
        return redirect('testimonial')->with('error', 'Testimonial ' . AppHelper::DataDeleted);
    }

    public function approve(Testimonial $testimonial)
    {
        $testimonial->approved = 1;
        $testimonial->save();
        return redirect('testimonial')->with('success', 'Testimonials Approved Successfully!');
    }

    public function disapprove(Testimonial $testimonial)
    {
        $testimonial->approved = 0;
        $testimonial->save();

        return redirect('testimonial')->with('success', 'Testimonials Disapproved Successfully!');
    }

    public function validateRequest()
    {
        return request()->validate([
            'user_id' => 'unique:testimonials',
            'title' => 'required|min:4|string',
            'description' => 'required|min:10|string',
        ]);
    }
}
