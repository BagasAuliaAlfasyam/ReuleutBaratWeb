<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
    public function index()
    {
        $data = Post::where('user_id', Auth()->user()->id)->get();
        $active = 'posts';
        return view('home.blog.posts.index', compact('data', 'active'));
    }
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $active = 'posts';
        return view('home.blog.posts.ceate', compact('active', 'categories', 'tags'));
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title_post' => 'required',
                'body_post' => 'required',
                'category' => 'required',
                'image_post' => 'file|max:5120|mimes:jpg,png'
            ]);
            $slug = Str::replace(' ', '-', $request->title_post);
            $fileName = Auth()->user()->username . now()->format('d-M-Y') . time() . '.' . $request->file('image_post')->getClientOriginalExtension();
            $request->file('image_post')->storeAs('uploads/images', $fileName);
            $post = new Post();
            $post->user_id = Auth()->user()->id;
            $post->category_id = $request->category;
            $post->title_post = $request->title_post;
            $post->slug_post = Str::lower($slug);
            $post->body_post = $request->body_post;
            $post->images = $fileName;
            $post->publish_status = $request->publish_status;
            $post->published_at = now();
            $post->save();
            foreach ($request->tag as $item) {
                $post_tag = new PostTag();
                $post_tag->post_id = $post->id;
                $post_tag->tag_id = $item;
                $post_tag->save();
            }
            return redirect('/blog/posts')->with(['success' => 'Insert data successfully!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function show($id)
    {
        $data = Post::firstWhere('id', $id);
        $active = 'posts';
        return view('home.blog.posts.show', compact('data', 'active'));
    }
    public function edit($id)
    {
        try {
            $data = Post::firstWhere('id', $id);
            $categories = Category::all();
            $tags = Tag::all();
            $post_tag = PostTag::where('post_id', $id)->get()->groupBy('tag_id');
            $active = 'posts';
            return view('home.blog.posts.edit', compact('data', 'active', 'categories', 'tags', 'post_tag'));
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title_post' => 'required',
                'body_post' => 'required',
                'category' => 'required',
                'image_post' => 'file|max:5120|mimes:jpg,png'
            ]);
            if (isset($request->image_post)) {
                $slug = Str::replace(' ', '-', $request->title_post);
                $fileName = Auth()->user()->username . now()->format('d-M-Y') . time() . '.' . $request->file('image_post')->getClientOriginalName();
                $request->file('image_post')->storeAs('uploads/images', $fileName);
                $post = Post::findOrFail($id);
                $post->user_id = Auth()->user()->id;
                $post->category_id = $request->category;
                $post->title_post = $request->title_post;
                $post->slug_post = Str::lower($slug);
                $post->body_post = $request->body_post;
                $post->images = $fileName;
                $post->publish_status = $request->publish_status;
                $post->published_at = now();
                $post->save();
                DB::table('post_tags')->where('post_id', $id)->delete();
                foreach ($request->tag as $item) {
                    $post_tag = new PostTag();
                    $post_tag->post_id = $id;
                    $post_tag->tag_id = $item;
                    $post_tag->save();
                }
            } else {
                $slug = Str::replace(' ', '-', $request->title_post);
                $post = Post::findOrFail($id);
                $post->user_id = Auth()->user()->id;
                $post->category_id = $request->category;
                $post->title_post = $request->title_post;
                $post->slug_post = Str::lower($slug);
                $post->body_post = $request->body_post;
                $post->publish_status = $request->publish_status;
                $post->published_at = now();
                $post->save();
                DB::table('post_tags')->where('post_id', $id)->delete();
                foreach ($request->tag as $item) {
                    $post_tag = new PostTag();
                    $post_tag->post_id = $id;
                    $post_tag->tag_id = $item;
                    $post_tag->save();
                }
            }
            return redirect('/blog/posts')->with(['success' => 'Insert data successfully!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
    public function destroy($id)
    {
        try {
            $post_tag = PostTag::where('post_id', $id)->get();
            foreach ($post_tag as $key => $value) {
                $value->delete();
            }
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect('/blog/posts')->with(['success' => 'Successfully deleted data!']);
        } catch (QueryException $th) {
            return redirect()->back()->with(['error' => 'Server tidak merespon!']);
        }
    }
}
