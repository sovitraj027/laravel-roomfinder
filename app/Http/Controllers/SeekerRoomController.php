<?php

namespace App\Http\Controllers;

use App\City;
use App\Place;
use App\Room;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeekerRoomController extends Controller
{
    public function index()
    {
        $excluding_ids = DB::table('rooms')
            ->join('applicants', 'rooms.id', '=', 'applicants.room_id')
            ->where('status', 'hired')
            ->orWhere('status', '')->pluck('applicants.room_id');

        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $categories = Category::all();
        $rooms = Room::with('city')->with('place')->with('category')
            ->whereNotIn('id', $excluding_ids->toArray())
            ->select(['id', 'title', 'price', 'city_id', 'place_id', 'category_id', 'created_at'])
            ->paginate(10);
        return view('room_seeker.all_room', compact('rooms', 'categories', 'cities', 'places'));
    }

    public function allRoomAjax(Request $request)
    {
        /*if ($request->cityId == 0) {
            $rooms = Room::with('city')->with('place')->with('category')
                ->where('category_id', $request->categoryId)
                ->get(['id', 'title', 'price', 'city_id', 'place_id', 'category_id', 'created_at']);
            return $resp = array(
                'success' => true,
                'message' => "Rooms",
                'data' => $rooms
            );
        }*/

        /* if ($request->cityId != 0 && $request->categoryId != 0) {
             $query = Room::with('city')->with('place')->with('category')
                 ->where('city_id', $request->cityId)
                 ->where('category_id', $request->categoryId);
             if ($request->placeId != 0) {
                 $query->where('place_id', $request->placeId);
             }
             $rooms = $query->get(['id', 'title', 'price', 'city_id', 'place_id', 'category_id', 'created_at']);;

             return $resp = array(
                 'success' => true,
                 'message' => "Rooms",
                 'data' => $rooms
             );
         }*/

        $excluding_ids = DB::table('rooms')
            ->join('applicants', 'rooms.id', '=', 'applicants.room_id')
            ->where('status', 'hired')
            ->orWhere('status', '')->pluck('applicants.room_id');

        $query = Room::with('city')->with('place')->with('category')->whereNotIn('id', $excluding_ids->toArray());
        if ($request->cityId != 0) {
            $query->where('city_id', $request->cityId);
        }
        if ($request->placeId != 0) {
            $query->where('place_id', $request->placeId);
        }
        if ($request->categoryId != 0) {
            $query->where('category_id', $request->categoryId);
        }
        $rooms = $query->get(['id', 'title', 'price', 'city_id', 'place_id', 'category_id', 'created_at']);

        return $resp = array(
            'success' => true,
            'message' => "Rooms",
            'data' => $rooms
        );
    }

    public function allRoomSearch()
    {
        $categories = Category::all();
        $rooms = Room::with('city')
            ->with('place')->with('category')
            ->select(['id', 'title', 'price', 'city_id', 'place_id', 'category_id', 'created_at'])->paginate(10);
        return view('room_seeker.index', compact('rooms', 'categories'));
    }

    public function seekerRoom()
    {
        $id = auth()->id();
        $rooms = DB::table('applicants')
            ->join('rooms', 'applicants.room_id', '=', 'rooms.id')
            ->when($id, function ($query) use ($id) {
                return $query->where('applicants.user_id', $id);
            })->select(['rooms.id', 'applicants.id', 'rooms.title', 'applicants.status', 'rooms.created_at'])
            ->paginate(5);
        return view('room_seeker.my_rooms', compact('rooms'));
    }
}
