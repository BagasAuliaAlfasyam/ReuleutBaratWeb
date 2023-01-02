<?php

namespace App\Http\Controllers;

use App\Models\Aparatur;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $gallery = Gallery::all();
        $type = DB::select("SELECT COLUMN_TYPE FROM information_schema.`COLUMNS` WHERE TABLE_NAME = 'galleries' AND COLUMN_NAME = 'filter_gallery'")[0]->COLUMN_TYPE;
        preg_match('/^enum((.*))$/', $type, $matches);
        $filter = array();
        foreach (explode(',', $matches[1]) as $key => $value) {
            $v = trim($value, "(')");
            $filter = Arr::add($filter, $key, $v);
        }
        $recent = Post::where('publish_status', true)->orderBy('created_at', 'desc')->paginate(3);
        $keyword = 'REULEUT BARAT';
        $desc = 'Sistem Informasi Desa REULEUT BARAT';
        return view('index', compact('gallery', 'filter', 'recent', 'keyword', 'desc'));
    }
    public function team()
    {
        $data = Aparatur::orderBy('jabatan')
            ->where('periode', date('Y'))
            ->where('demisioner', date('Y') + 1)
            ->get();
        $keyword = 'REULEUT BARAT';
        $desc = 'Sistem Informasi Desa REULEUT BARAT';
        return view('pages.team.index', compact('data', 'keyword', 'desc'));
    }
    public function blog()
    {
        $blog = '';
        if (request()->get('tag')) {
            $blog = Post::join('users', 'posts.user_id', 'users.id')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('post_tags', 'posts.id', '=', 'post_tags.post_id')
                ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
                ->where('slug_tag', request()->get('tag'))
                ->search(request(['search', 'category', 'author', 'published']))
                ->paginate(3);
        } else {
            $blog = Post::with(["author", "category", "post_tag"])
                ->where('publish_status', true)
                ->latest()
                ->search(request(['search', 'category', 'author', 'published']))
                ->paginate(3);
        }
        $categories = Category::latest()->get();
        $tags = Tag::all();
        $keyword = array();
        foreach ($tags as $key => $value) {
            $keyword = Arr::add($keyword, $key, $value->name_tag);
        }
        $keyword ?? 'REULEUT BARAT';
        $desc = 'Sistem Informasi Desa REULEUT BARAT ';
        $recent = Post::where('publish_status', true)->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.blog.index', compact('blog', 'categories', 'tags', 'keyword', 'desc', 'recent'));
    }
    public function detail($post)
    {
        $blog = Post::firstWhere('slug_post', $post);
        $categories = Category::latest()->get();
        $tags = Tag::all();
        $page = false;
        $keyword = array();
        foreach ($blog->post_tag as $key => $value) {
            $keyword = Arr::add($keyword, $key, $value->tag->name_tag);
        }
        $keyword ?? 'REULEUT BARAT';
        $desc = 'Sistem Informasi Desa REULEUT BARAT';
        $recent = Post::where('publish_status', true)->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.blog.index', compact('blog', 'categories', 'tags', 'keyword', 'desc', 'recent', 'page'));
    }
    public function tags(Tag $tag)
    {
        $posts = Post::join('post_tags', 'posts.id', '=', 'post_tags.post_id')
            ->where('tag_id', $tag->id)
            ->latest('posts.created_at')
            ->paginate(3);
        $blog = $posts->load("user", "category", "post_tag");
        $categories = Category::latest()->get();
        $tags = Tag::all();
        $page = true;
        $keyword = array();
        foreach ($tags as $key => $value) {
            $keyword = Arr::add($keyword, $key, $value->name_tag);
        }
        $keyword ?? 'REULEUT BARAT';
        $desc = 'Sistem Informasi Desa REULEUT BARAT';
        $recent = Post::where('publish_status', true)->orderBy('created_at', 'desc')->paginate(5);
        return view('pages.blog.index', compact('blog', 'categories', 'tags', 'keyword', 'desc', 'recent', 'page'));
    }
    public function visit(Request $request)
    {
        $post = Post::findOrFail($request->all()['id']);
        if ($post->visit == null) {
            $post->visit = 1;
            $post->save();
        }
        $up = Post::findOrFail($request->all()['id']);
        $up->visit = $post->visit + 1;
        $up->save();

        return response()->json([
            'message' => 'Successfully!'
        ], 200);
    }
}
