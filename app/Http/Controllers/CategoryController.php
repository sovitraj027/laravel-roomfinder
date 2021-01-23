<?php

namespace App\Http\Controllers;

use Session;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Helper\AppHelper;

class CategoryController extends Controller
{
    public function __construct()
    {
        //  $this->middleware(['admin']);
    }

    public function index()
    {
        return view('category.index')->with('categories', Category::all());
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|string|min:3'
        ]);

        Category::create($data);

        Session::flash('success', 'Category ' . AppHelper::DataAdded);
        return redirect()->route('room_category.index');
    }

    public function update(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $data = $this->validate($request, [
            'name' => 'required|string|min:3'
        ]);

        $category->update($data);

        Session::flash('success', 'Category ' . AppHelper::DataUpdated);
        return redirect()->route('room_category.index');
    }

    public function destroy(Category $room_category)
    {
        $room_category->delete();
        Session::flash('error', 'Category ' . AppHelper::DataDeleted);
        return redirect()->route('room_category.index');
    }
}
