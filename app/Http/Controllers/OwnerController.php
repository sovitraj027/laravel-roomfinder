<?php

namespace App\Http\Controllers;

use App\City;
use App\Place;
use App\Room;
use Session;
use App\Owner;
use App\User;
use App\Http\Helper\AppHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['owner'])->except('show');
    }

    public function dashboard()
    {
        $room_count = Room::where('user_id', auth()->id())->count();
        $seeker_count = User::where('role',2)->count();
        $room_requests = Owner::where('user_id',auth()->id())->first()->applicants->count();
        return view('room_owner.dashboard', compact('room_count', 'room_requests', 'seeker_count'));
    }

    public function profile()
    {
        $user = Auth::user();
        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $owner = Owner::where('user_id', $user->id)->first();
        return view('room_owner.profile')->with(compact('user', 'owner', 'cities'));
    }

    public function index()
    {
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $owner = new Owner;
            $owner->user_id = Auth::id();
            $owner->phone = $request->phone;
            $owner->link = $request->link;
            $owner->city_id = $request->city_id;
            $owner->place_id = $request->place_id;
            $owner->description = $request->description;
            $owner->user->name = $request->name;
            $owner->user->email = $request->email;
            $owner->save();
            $owner->user->save();

            if ($request->hasFile('avatar')) {
                $img = $request->file('avatar');
                $groupId = $owner->image_id == 0 ? 0 : $owner->image_id;
                $imageId = $this->manageUploads($img, 'owner_avatar', $groupId);
                $owner->image_id = $imageId;
                $owner->save();
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }

        Session::flash('success', 'Profile ' . AppHelper::DataAdded);
        return redirect()->back();
    }

    public function show($id)
    {
        $owner = Owner::findOrFail($id);
        return view('room_owner.show', compact('owner'));
    }


    public function update(Request $request, Owner $owner)
    {
        $this->validateRequest();

        DB::beginTransaction();
        try {

            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->hasFile('avatar')) {
                //delete old upload
                $this->deleteUploads($owner);

                $img = $request->file('avatar');
                $groupId = $owner->image_id == 0 ? 0 : $owner->image_id;
                $imageId = $this->manageUploads($img, 'owner_avatar', $groupId);
                $user->owner->image_id = $imageId;
                $user->owner->save();
            }

            $user->owner->user_id = Auth::id();
            $user->owner->phone = $request->phone;
            $user->owner->city_id = $request->city_id;
            $user->owner->place_id = $request->place_id;
            $user->owner->link = $request->link;
            $user->owner->description = $request->description;
            $user->save();
            $user->owner->save();

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }

        Session::flash('success', 'Profile ' . AppHelper::DataUpdated);
        return redirect()->back();
    }

    public function destroy(Owner $owner)
    {
        foreach ($owner->rooms as $room) {
            $this->deleteUploads($room);
            $room->delete();
        }
        $this->deleteUploads($owner);
        $owner->delete();
        $owner->user->delete();
        Session::flash('error', 'Profile ' . AppHelper::DataDeleted);
        return redirect()->back();
    }

    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required|string|min:2',
            'email' => 'email|required',
            'city_id' => 'required|numeric',
            'place_id' => 'required|numeric',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|max:10',
            'link' => 'url',
            'description' => 'required|string|min:5'
        ]);
    }
}
