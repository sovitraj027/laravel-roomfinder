<?php

namespace App\Http\Controllers;

use Session;
use App\City;
use App\Room;
use App\User;
use App\Place;
use App\Rating;
use App\Seeker;
use App\Category;
use App\Facility;
use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware(['owner'])->except(['show', 'addRating', 'recommendationMatrix']);
    }

    public function index()
    {
        $rooms = Room::where('user_id', auth()->id())->get();
        return view('room.index')->withRooms($rooms);
    }

    public function create()
    {
        //to make sure that the room owner has to profile (so errors donot occur in view)
        if (AppHelper::hasProfile('owner') != null) {
            return AppHelper::hasProfile('owner')->with('info', 'Create Profile first');
        }
        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $categories = Category::all();
        $facilities = Facility::all();
        return view('room.create', compact('cities', 'places', 'categories', 'facilities'));
    }

    public function store(Request $request)
    {
        $this->validateRequest();
        // collect($this->validateRequest())->except(['images'])->toArray() gives request->all() except images
        $room = Room::create(array_merge(collect($this->validateRequest())->except(['images'])->toArray(), ['user_id' => Auth::user()->id]));
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $groupId = $room->images == 0 ? 0 : $room->images;
                $imageId = $this->manageUploads($img, 'room', $groupId);
                $room->images = $imageId;
                $room->save();
            }
        }
        $room->facilities()->attach($request->facilities);
        Session::flash('success', 'Room ' . AppHelper::DataAdded);
        return redirect()->route('room.index');
    }


    public function show($id)
    {
        $room = Room::findOrFail($id);
        //to make sure that the room seeker has a profile (so errors donot occur in view)
        if (AppHelper::hasProfile('seeker') != null && \auth()->user()->role == 2) {
            return AppHelper::hasProfile('seeker')->with('info', 'Create Profile first');
        }

        $user_id = Auth::id();
        $room_id = $room->id;
        $room = $room->load('facilities')->load('city'); //lazy loading
        //for views in db
        $uniqueKey = 'key_' . $room->id;
        if (!Session::has($uniqueKey)) {
            $room->views++;
            Session::put($uniqueKey, 1);
        }
        $room->save();

        $seeker = Seeker::where('user_id', \auth()->user()->id)->first();

        //to check if user has (already) applied to a job or not
        $is_applied = DB::table('applicants')
            ->join('rooms', 'rooms.id', '=', 'applicants.room_id')
            ->when($room_id, function ($query) use ($room_id) {
                return $query->where('applicants.room_id', $room_id);
            })->when($user_id, function ($query) use ($user_id) {
                return $query->where('applicants.user_id', $user_id);
            })->select('applicants.id', 'status')->first();


        $rating = Rating::where('user_id', auth()->id())->where('room_id', $room_id)->first();
        if ($rating == null) {
            $rating = 0;
        }

        return view('room.show', compact('room', 'is_applied', 'seeker', 'rating'));
    }


    public function edit(Room $room)
    {
        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $categories = Category::all();
        $facilities = Facility::all();
        return view('room.edit', compact('room', 'cities', 'places', 'categories', 'facilities'));
    }

    public function update(Request $request, Room $room)
    {
        $this->validateRequest();
        $room->update(array_merge(collect($this->validateRequest())->except(['images'])->toArray(), ['user_id' => Auth::user()->id]));

        if ($request->hasFile('images')) {
            //delete old upload
            $this->deleteUploads($room);
            foreach ($request->file('images') as $img) {
                $groupId = $room->images == 0 ? 0 : $room->images;
                $imageId = $this->manageUploads($img, 'room/files', $groupId);
                $room->images = $imageId;
                $room->save();
            }
        }

        $room->facilities()->sync($request->facilities);
        Session::flash('success', 'Room ' . AppHelper::DataUpdated);
        return redirect()->route('room.index');
    }

    public function destroy(Room $room)
    {
        DB::beginTransaction();
        try {
            //delete the room notification
            $room_notifications = DB::table('notifications')
                ->where('type', 'App\Notifications\ApplicantNotification')
                ->where('data', 'like', '%"user_id":' . $room->user_id . '%')
                ->where('data', 'like', '%"id":' . $room->id . '%')
                ->get();

            //if there are multiple notices
            foreach ($room_notifications as $room_notification) {
                //find the user based on notification_table
                $user1 = User::where('id', $room_notification->notifiable_id)->first();
                //delete notification of that specific user
                $user1->notifications->where('id', $room_notification->id)->first()->delete();
            }

            //delete Applicants
            $room_applicants = Applicant::where('room_id', $room->id)->get();
            foreach ($room_applicants as $applicant) {
                $applicant->delete();
            }

            //detach applicants
            $room->applicants()->detach();

            //delete the room
            $this->deleteUploads($room);
            $room->forceDelete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->back()->with('error', 'Room ' . AppHelper::DataDeleted);
    }

    //-------------------------------------------------rating and recommendation
    public function addRating(Request $request)
    {
        $rating = Rating::updateOrCreate(
            ['user_id' => $request->user_id, 'room_id' => $request->room_id, 'title' => $request->title],
            ['rating' => $request->rating,]
        );
    }

    public function recommendationMatrix()
    {
        $ratings = Rating::all();
        $matrix = array(); //matrix representation
        // dd($ratings);

        foreach ($ratings as $rating) {
            $users = User::where('id', $rating->user_id)->pluck('name')->toArray();
            foreach ($users as $user) {
                $matrix[$user][$rating->room['titleLimit']] = $rating['rating'];
            }
        }

        // dd($matrix[Auth::user()->name]);
        $rooms = $this->getRecommendation($matrix, Auth::user()->name);

        //    dd($rooms);


        //filter rated rooms array into rooms
        $temp_array = array();
        foreach ($ratings as $rating) {
            foreach ($rooms as $t => $r) {
                if ($rating->title == $t) {
                    array_push($temp_array, $rating->room_id);
                }
            }
        }

        $recommedated_rooms = Room::whereIn('id', $temp_array)->where('deleted_at', null)->get();
        return view('room_seeker.recommendation', compact('recommedated_rooms'));
    }


    function getRecommendation($matrix, $authUser)
    {
        $total = array();
        $simSum = array();
        $ranks = array();

        foreach ($matrix as $otherUser => $val) {

            if ($otherUser !== $authUser) {
                $sim = $this->similarityDistance($matrix, $authUser, $otherUser);

                //formula part
                foreach ($matrix[$otherUser] as $key => $value) {
                    if (!array_key_exists($key, $matrix[$authUser])) {
                        if (!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }

                        $total[$key] += $matrix[$otherUser][$key] * $sim;

                        if (!array_key_exists($key, $simSum)) {
                            $simSum[$key] = 0;
                        }

                        $simSum[$key] += $sim;
                    }
                }
            }
        }

        //div num with dino
        foreach ($total as $key => $value) {
            $ranks[$key] = $value / $simSum[$key];

            array_multisort($ranks, SORT_DESC);
        }

        //    dd($ranks);
        return $ranks;
    }

    function similarityDistance($matrix, $authUser, $otherUser)
    {
        $similarity = array();
        $sum = 0;

        foreach ($matrix[$authUser] as $key => $value) {
            if (array_key_exists($key, $matrix[$otherUser])) {
                $similarity[$key] = 1;
            }
        }

        if ($similarity == 0) {
            return 0;
        }

        foreach ($matrix[$authUser] as $key => $value) {
            if (array_key_exists($key, $matrix[$otherUser])) {
                $sum = $sum + pow($value - $matrix[$otherUser][$key], 2);
            }
        }

        return 1 / (1 + sqrt($sum));
        // var_dump (1/(1+sqrt($sum)));


    } //end of function

    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|string|min:2',
            'city_id' => 'required|numeric',
            'place_id' => 'required|numeric',
            'price' => 'required|min:3|numeric',
            'total_rooms' => 'required|numeric',
            'category_id' => 'required|numeric',
            'description' => 'required|string|min:10',
            'images' => 'sometimes|max:2048',
        ]);
    }
}
