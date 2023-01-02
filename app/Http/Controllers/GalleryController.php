<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $data = Gallery::all();
        $active = 'galleries';
        return view('home.gallery.index', compact('data', 'active'));
    }
    public function create()
    {
        $type = DB::select("SELECT COLUMN_TYPE FROM information_schema.`COLUMNS` WHERE TABLE_NAME = 'galleries' AND COLUMN_NAME = 'filter_gallery'")[0]->COLUMN_TYPE;
        preg_match('/^enum((.*))$/', $type, $matches);
        $filter = array();
        foreach (explode(',', $matches[1]) as $key => $value) {
            $v = trim($value, "(')");
            $filter = Arr::add($filter, $key, $v);
        }
        $active = 'galleries';
        return view('home.gallery.create', compact('active', 'filter'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'images' => 'required|max:5020',
                'filter_gallery' => 'required',
                'description' => 'required'
            ]);
            $fileName = Auth()->user()->username . now()->format('d-M-Y') . time() . '.' . $request->file('images')->getClientOriginalExtension();
            $request->file('images')->storeAs('uploads/images', $fileName);
            $gallery = new Gallery();
            $gallery->filter_gallery = $request->filter_gallery;
            $gallery->description = $request->description;
            $gallery->images = $fileName;
            $gallery->save();
            return redirect('/galleries')->with('success', 'Insert data successfully!');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }
    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            if (public_path('/storage/uploads' . '/' . $gallery->images)) {
                File::delete(public_path('/storage/uploads' . '/' . $gallery->images));
            }
            $gallery->delete();
            return redirect()->back()->with('success', 'Data has been deleted successfully!');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }
}
