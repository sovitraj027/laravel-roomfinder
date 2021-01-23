<?php

namespace App\Http\Controllers;

use App\Room;
use App\Seeker;
use App\User;
use App\Owner;
use App\Message;
use Pusher\Pusher;
use App\Applicant;
use Illuminate\Http\Request;


class FriendController extends Controller
{
    public function index()
    {

        //if auth user is owner then show seekers(who are applicants)
        if (auth()->user()->role == 1) {
            $owner_room_ids = Owner::where('user_id', auth()->id())->first()->rooms->pluck('id');
            $all_applicants = Applicant::distinct()->whereIn('room_id', $owner_room_ids)->pluck('user_id');
            $users = User::whereIn('id', $all_applicants)->get();
        } elseif (auth()->user()->role == 2) { //if auth user is seeker then show owner(to whom application has been send)
            $applicants_room_ids = Applicant::distinct()->where('user_id', auth()->id())->pluck('room_id');
            $user_rooms = Room::distinct()->whereIn('id', $applicants_room_ids)->pluck('user_id');
            $users = User::whereIn('id', $user_rooms)->get();
        } else {
            $users = [];
        }

        return view('chat.friends', ['users' => $users]);
    }

    public function getMessage($receiver_id)
    {
        $my_id = auth()->id();
        // Make read all unread message
        Message::where(['from' => $receiver_id, 'to' => $my_id])->update(['is_read' => 1]);
        $my_messages = Message::where(function ($query) use ($receiver_id, $my_id) {
            $query->where('from', $my_id)->where('to', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id, $my_id) {
            $query->where('from', $receiver_id)->where('to', $my_id);
        })->get();
        if (empty($my_messages)) {
            $messages = [];
        } else {
            $messages = $my_messages;
        }
        return view('chat.message', ['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = auth()->id();
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0;
        $data->save();

        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = ['from' => $from, 'to' => $to]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
