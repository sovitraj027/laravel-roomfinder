<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('admin');
    }

    public function dashboard()
    {
        $room_count = Room::all()->count();
        $user_count = User::all()->count();
        $owner_count = User::where('role', 1)->count();
        $seeker_count = User::where('role', 2)->count();
        return view('admin.dashboard', compact('room_count', 'seeker_count', 'owner_count', 'user_count'));
    }

    public function index()
    {
        $owners = User::where('role', 1)->orWhere('role', 3)->get();
        $seekers = User::where('role', 2)->orWhere('role', 4)->get();
        return view('admin.all_users', compact('owners', 'seekers'));
    }

    public function banOwner($id)
    {
        $user = User::findOrFail($id);
        $user->role = 3; //any role_id other than 1,2
        $user->save();

        /* $user_room = Room::where('user_id', $id)->pluck('id');
       Room::whereIn('user_id', $user_room)->delete(); */

        Room::where('user_id', $id)->delete();
        return redirect()->back()->with('success', $user->name . ' ' . AppHelper::UserBanned);
    }

    public function unbanOwner($id)
    {
        $user = User::findOrFail($id);
        $user->role = AppHelper::OwnerRoleId;
        $user->save();
        // $user_room = Room::withTrashed()->where('user_id', $id)->pluck('id');
        // Room::withTrashed()->whereIn('user_id', $user_room)->restore();
        Room::withTrashed()->where('user_id', $id)->restore();
        return redirect()->back()->with('success', $user->name . ' ' . AppHelper::UserUnbanned);
    }

    public function banSeeker($id)
    {
        $user = User::findOrFail($id);
        $user->role = 4;
        $user->save();

        return redirect()->back()->with('success', $user->name . ' ' . AppHelper::UserBanned);
    }

    public function unbanSeeker($id)
    {
        $user = User::findOrFail($id);
        $user->role = AppHelper::SeekerRoleId;
        $user->save();

        return redirect()->back()->with('success', $user->name . ' ' . AppHelper::UserUnbanned);
    }
}
