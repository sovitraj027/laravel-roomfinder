<?php

namespace App\Http\Controllers;

use Session;
use App\Room;
use App\User;
use App\Work;
use App\City;
use App\Place;
use App\Seeker;
use App\Education;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SeekerController extends Controller
{

    public function __construct()
    {
        $this->middleware(['seeker'])->except('show');
    }

    public function dashboard()
    {
        $room_count = Room::all()->count();
        $user_count = User::all()->count();
        $owner_count = User::where('role', 1)->count();
        return view('room_seeker.dashboard', compact('room_count', 'owner_count', 'user_count'));
    }

    public function profile()
    {
        $user = Auth::user();
        $cities = City::all(['name', 'id']);
        $places = Place::all(['name', 'id']);
        $educations = Education::where('user_id', $user->id)->get();
        $works = Work::where('user_id', $user->id)->get();
        $seeker = Seeker::where('user_id', $user->id)->first();
        return view('room_seeker.profile', compact('user', 'seeker', 'cities', 'seeker', 'educations', 'works'));
    }


    public function index()
    {
    }

    public function store(Request $request)
    {
        $this->validateRequest();

        DB::beginTransaction();
        try {
            $seeker = Seeker::firstOrNew(array_merge(collect($this->validateRequest())
                ->except(['avatar', 'name', 'email'])
                ->toArray(), ['user_id' => Auth::user()->id]));
            $seeker->user->name = $request->name;
            $seeker->user->email = $request->email;
            $seeker->save();
            $seeker->user->save();

            if ($request->hasFile('avatar')) {
                $img = $request->file('avatar');
                $groupId = $seeker->image_id == 0 ? 0 : $seeker->image_id;
                $imageId = $this->manageUploads($img, 'seeker_avatar', $groupId);
                $seeker->image_id = $imageId;
                $seeker->save();
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }

        Session::flash('success', 'Seeker Profile ' . AppHelper::DataAdded);
        return redirect()->back();
    }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $works = Work::where('user_id', $user->id)->get();
        $seeker = Seeker::where('user_id', $user_id)->first();
        $educations = Education::where('user_id', $user->id)->get();
        return view('room_seeker.show', compact('seeker', 'user', 'works', 'educations'));
    }

    public function update(Request $request, Seeker $seeker)
    {
        $this->validateRequest();

        DB::beginTransaction();
        try {
            $seeker->fill(array_merge(collect($this->validateRequest())->except(['avatar', 'name', 'email'])->toArray(), ['user_id' => Auth::user()->id]));
            $seeker->user->name = $request->name;
            $seeker->user->email = $request->email;
            $seeker->save();
            $seeker->user->save();

            if ($request->hasFile('avatar')) {
                $img = $request->file('avatar');
                $groupId = $seeker->image_id == 0 ? 0 : $seeker->image_id;
                $imageId = $this->manageUploads($img, 'seeker_avatar', $groupId);
                $seeker->image_id = $imageId;
                $seeker->save();
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('error', $ex->getMessage())->withInput();
        }

        Session::flash('success', 'Seeker Profile ' . AppHelper::DataUpdated);
        return redirect()->back();
    }

    public function destroy(Seeker $seeker)
    {
        $this->deleteUploads($seeker);
        $seeker->delete();
        Session::flash('error', 'Seeker Profile ' . AppHelper::DataDeleted);
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
            'alternate_phone' => 'required|max:10',
            'link' => 'url',
            'description' => 'required|string|min:5'
        ]);
    }
}
