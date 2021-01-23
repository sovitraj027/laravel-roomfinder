<?php

namespace App\Http\Controllers;

use App\City;
use App\Room;
use App\Place;
use App\Category;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    public function index()
    {
        $excluding_ids = DB::table('rooms')
            ->join('applicants', 'rooms.id', '=', 'applicants.room_id')
            ->where('status', 'hired')
            ->orWhere('status', '')->pluck('applicants.room_id');


        return view('welcome')
            ->with('cities', City::all(['name', 'id']))
            ->with('places', Place::all(['name', 'id']))
            ->with('categories', Category::all())
            ->with('first_testimonial', Testimonial::where('approved', 1)->orderBy('created_at', 'desc')
                ->first())
            ->with('second_testimonial', Testimonial::where('approved', 1)->orderBy('created_at', 'desc')
                ->skip(1)->take(1)->get()->first())
            ->with('third_testimonial', Testimonial::where('approved', 1)->orderBy('created_at', 'desc')
                ->skip(2)->take(1)->get()->first())
            ->with('mostViewedRooms', Room::whereNotIn('id', $excluding_ids->toArray())->orderBy('views', 'desc')
                ->take(3)->get())
            ->with('recentRooms', Room::whereNotIn('id', $excluding_ids->toArray())->orderBy('created_at', 'desc')
                ->take(3)->get());
    }

    //room based on the category
    public function category_room($category_id)
    {
        // $category_rooms = Room::where('category_id', $category_id)->get();
        // dd($category_rooms);
        return view('frontend.category_room', [
            'category_rooms' => Room::where('category_id', $category_id)->get()
        ]);
    }

    public function category_room_show(Room $room)
    {
        // dd($room);
        return view('frontend.category_room_show', compact('room'));
    }

    public function search_room()
    {
        $rooms = Room::where([
            'city_id' => request()->city_id,
            'place_id' => request()->place_id
        ])->get();

        return view('frontend.search_room',compact('rooms'));
    }
}
