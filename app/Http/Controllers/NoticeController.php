<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Notice;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\DB;
use App\Notifications\NoticeAddedNotification;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::where('user_id', auth()->id())->get(['id', 'title']);
        return view('notice.index', compact('notices'));
    }

    public function create()
    {
        //finding the appropriate roles to send the notice [ex: admin can send to all roles]
        if (auth()->user()->admin) {
            $roles = Role::all(['id', 'name']);
        } else {
            $roles = Role::where('id', 2)->get(['id', 'name']);
        }
        return view('notice.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validateRequest();
        DB::beginTransaction();
        try {
            $notice = Notice::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->id()
            ]);

            $notice->roles()->attach($request->roles);

            //sending notification
            $arr = [];

            //getting id of roles in an array
            foreach ($notice->roles()->get() as $role) {
                array_push($arr, $role->id);
            }

            //get users with roles
            $user = User::whereIn('role', $arr)->get();

            if (\Notification::send($user, new NoticeAddedNotification(Notice::latest('id')->first()))) {
                return back();
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->back()->with('error', $ex->getMessage());
        }

        return redirect()->back()->with('success', 'Notice ' . AppHelper::DataAdded);
    }

    public function show($id)
    {
        $notice = Notice::find($id);
        return view('notice.show')->with('notice', $notice);
    }

    public function edit(Notice $notice)
    {
        if (auth()->user()->admin) {
            $roles = Role::all(['id', 'name']);
        } else {
            $roles = Role::where('id', 2)->get(['id', 'name']);
        }
        return view('notice.edit', compact('roles', 'notice'));
    }

    public function update(Request $request, Notice $notice)
    {
        $this->validateRequest();

        $notice->update(collect($this->validateRequest())->except(['roles'])->toArray());
        $notice->roles()->sync($request->roles);

        return redirect()->back()->with('success', 'Notice ' . AppHelper::DataUpdated);
    }

    public function destroy($id)
    {
        $notice = Notice::find($id);

        //to determine the sender of the notice.
        $user = User::where('id', $notice->user_id)->first();

        //----to determine the recipient roles of the notice.
        $arr = [];
        //getting id of roles in an array
        foreach ($notice->roles()->get() as $role) {
            array_push($arr, $role->id);
        }
        //getting user with those roles
        $roles = User::whereIn('role', $arr)->get();

        foreach ($roles as $role) {
            //get notices where sender and role matches [as there can be multiple sender sending to multiple roles]
            $notice_notifications = DB::table('notifications')
                ->where('type', 'App\Notifications\NoticeAddedNotification')
                ->where('data', 'like', '%"user_id":' . $notice->user_id . '%')
                ->where('notifiable_id', 'like', '%' . $role->id . '%')
                ->get();

            //if there are multiple notices
            foreach ($notice_notifications as $notice_notification) {
                //find the user based on notification_table
                $user1 = User::where('id', $notice_notification->notifiable_id)->first();
                //delete notification of that specific user
                $user1->notifications->where('id', $notice_notification->id)->first()->delete();
            }
        }

        $notice->roles()->detach();
        $notice->delete();
        return redirect()->route('notice.index')->with('success', 'Notice ' . AppHelper::DataDeleted);
    }


    public function validateRequest()
    {
        return request()->validate([
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:5',
            'roles' => 'required'
        ]);
    }
}
