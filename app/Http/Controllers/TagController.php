<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class TagController extends Controller
{
    public function index()
    {
        $data = Tag::all();
        $usage = $data->load("post_tag")->count();
        $active = 'tags';
        return view('home.blog.tags.index', compact('data', 'usage', 'active'));
    }
    public function create()
    {
        $active = 'tags';
        return view('home.blog.tags.ceate', compact('active'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name_tag' => 'required|unique:tags',
                'slug_tag' => 'required|unique:tags',
            ]);
            $tag = new Tag();
            $tag->slug_tag = $request->slug_tag;
            $tag->name_tag = $request->name_tag;
            $tag->save();
            return redirect()->back()->with(['success' => 'Insert data successfully!']);
        } catch (QueryException $th) {
            $th;
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function edit($id)
    {
        try {
            $data = Tag::firstWhere('id', $id);
            $active = 'tags';
            return view('home.blog.tags.edit', compact('data', 'active'));
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name_tag' => ['required', 'unique:tags,name_tag,' . $id],
                'slug_tag' => ['required', 'unique:tags,slug_tag,' . $id],
            ]);
            $tag = Tag::findOrFail($id);
            $tag->name_tag = $request->name_tag;
            $tag->slug_tag = $request->slug_tag;
            $tag->save();
            return redirect('/blog/tags')->with(['success' => 'Successfully updated data!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function destroy($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            $validasi = Post::join('tags', 'tags.id', '=', 'posts.tag_id')
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->where('posts.user_id', Auth()->user()->id)
                ->where('tag_id', $id)
                ->where('tags.id', $id)
                ->get();
            if (!isset($validasi)) {
                return redirect()->back()->with(['info' => 'Tags in usage!']);
            }
            $tag->delete();
            return redirect('/blog/tags')->with(['success' => 'Successfully deleted data!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
}
