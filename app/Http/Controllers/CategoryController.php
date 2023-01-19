<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::with(["post"])->get();
        return view('home.blog.categories.index', compact('data'));
    }
    public function create()
    {
        return view('home.blog.categories.ceate');
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories',
                'slug' => 'required|unique:categories',
            ]);
            $category = new Category();
            $category->slug = $request->slug;
            $category->name = $request->name;
            $category->save();
            return redirect()->back()->with(['success' => 'Insert data successfully!']);
        } catch (QueryException $th) {
            $th;
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function edit($id)
    {
        try {
            $data = Category::firstWhere('id', $id);
            return view('home.blog.categories.edit', compact('data'));
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => ['required', 'unique:categories,name,' . $id],
                'slug' => ['required', 'unique:categories,slug,' . $id],
            ]);
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return redirect('/blog/categories')->with(['success' => 'Successfully updated data!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            $validasi = Post::join('tags', 'tags.id', '=', 'posts.tag_id')
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->where('posts.user_id', Auth()->user()->id)
                ->where('category_id', $id)
                ->where('categories.id', $id)
                ->get();
            if (!isset($validasi)) {
                return redirect()->back()->with(['info' => 'Categories in usage!']);
            }
            $category->delete();
            return redirect('/blog/categories')->with(['success' => 'Successfully deleted data!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
}
