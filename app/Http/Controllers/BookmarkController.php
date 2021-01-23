<?php

namespace App\Http\Controllers;

use App\Bookmark;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    public function addBookmark($id) //$room_id
    {
        Bookmark::create([
            'room_id' => $id,
            'user_id' => auth()->id()
        ]);

        return redirect()->back()->with('success', 'Bookmark ' . AppHelper::DataAdded);
    }

    public function removeBookmark($id) //$room_id
    {
        $bookmark = Bookmark::where('room_id', $id)->where('user_id', auth()->id())->first();
        $bookmark->delete();
        return redirect()->back()->with('success', 'Bookmark ' . AppHelper::DataDeleted);
    }

    public function myBookmarks()
    {
        $rooms = DB::table('rooms')
            ->join('bookmarks', 'rooms.id', '=', 'bookmarks.room_id')
            ->paginate(5);
        return view('bookmark.bookmarks', compact('rooms'));
    }
}
