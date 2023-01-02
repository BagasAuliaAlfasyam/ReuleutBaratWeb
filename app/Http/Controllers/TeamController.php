<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function index()
    {
        $data = Aparatur::orderBy('jabatan')
            ->where('periode', date('Y'))
            ->where('demisioner', date('Y') + 1)
            ->get();
        $active = 'aparatur';
        return view('home.teams.index', compact('data', 'active'));
    }
    public function create()
    {
        $type = DB::select("SELECT COLUMN_TYPE FROM information_schema.`COLUMNS` WHERE TABLE_NAME = 'aparaturs' AND COLUMN_NAME = 'jabatan'")[0]->COLUMN_TYPE;
        preg_match('/^enum((.*))$/', $type, $matches);
        $jabatan = array();
        foreach (explode(',', $matches[1]) as $key => $value) {
            $v = trim($value, "(')");
            $jabatan = Arr::add($jabatan, $key, $v);
        }
        $active = 'aparatur';
        return view('home.teams.create', compact('active', 'jabatan'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'fullname' => 'required',
                'position' => 'required|unique:aparaturs,jabatan',
                'images' => 'required|max:5020|mimes:png,jpg'
            ]);
            $fileName = Auth()->user()->username . now()->format('d-M-Y') . time() . '.' . $request->file('images')->getClientOriginalExtension();
            $request->file('images')->storeAs('uploads/images', $fileName);
            $team = new Aparatur();
            $team->jabatan = $request->position;
            $team->fullname = $request->fullname;
            $team->images = $fileName;
            $team->periode = date('Y');
            $team->demisioner = date('Y') + 1;
            $team->save();
            if (Aparatur::all()->count() == 16) {
                return redirect('/teams')->with('success', 'Insert data successfully!');
            }
            return redirect()->back()->with('success', 'Insert data success');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }
    public function edit($id)
    {
        $data = Aparatur::firstWhere('id', $id);
        $type = DB::select("SELECT COLUMN_TYPE FROM information_schema.`COLUMNS` WHERE TABLE_NAME = 'aparaturs' AND COLUMN_NAME = 'jabatan'")[0]->COLUMN_TYPE;
        preg_match('/^enum((.*))$/', $type, $matches);
        $jabatan = array();
        foreach (explode(',', $matches[1]) as $key => $value) {
            $v = trim($value, "(')");
            $jabatan = Arr::add($jabatan, $key, $v);
        }
        $active = 'aparatur';
        return view('home.teams.edit', compact('data', 'active', 'jabatan'));
    }
    public function update(Request $request, $id)
    {
        try {
            $team = Aparatur::findOrFail($id);
            if (isset($request->images)) {
                $fileName = Auth()->user()->username . now()->format('d-M-Y') . time() . '.' . $request->file('images')->getClientOriginalExtension();
                $request->file('images')->storeAs('uploads/images', $fileName);
                $team->fullname = $request->fullname;
                $team->jabatan = $request->position;
                $team->images = $fileName;
                $team->save();
            } else {
                $team->fullname = $request->fullname;
                $team->jabatan = $request->position;
                $team->save();
            }
            return redirect('/teams')->with('success', 'Updated data successfully!');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }
    public function destroy($id)
    {
        try {
            $team = Aparatur::findOrFail($id);
            $team->delete();
            return redirect()->back()->with('success', 'Deleted data successfully!');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', 'Server tidak merespon!');
        }
    }
}
