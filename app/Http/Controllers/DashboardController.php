<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'post' => Post::all()->count(),
            'category' => Category::all()->count(),
            'visitor' => Post::where('publish_status', true)->where('user_id', Auth()->user()->id)->get()->sum('visit'),
            'latest_post' => Post::where('publish_status', true)->where('user_id', Auth()->user()->id)->latest()->first()
        ];
        $active = 'dashboard';
        return view('home.index', compact('data', 'active'));
    }
    public function traffic()
    {
        $post = Post::join('categories', 'categories.id', '=', 'posts.category_id')
            ->where('publish_status', true)
            ->where('user_id', Auth()->user()->id)
            ->get()->groupBy('name');
        $postData = [];
        foreach ($post as $key => $value) {
            array_push($postData, [
                'labelTrue' => $key,
                'dataTrue' => $value->count()
            ]);
        }
        $color = [];
        for ($i = 0; $i < $post->count(); $i++) {
            array_push($color, ['rgb(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ')']);
        }
        return response()->json([
            'postTrue' => $postData,
            'color' => $color
        ], 200);
    }
    public function post()
    {
        $post = Post::orderBy('published_at')->where('publish_status', true)->where('user_id', Auth()->user()->id)->get()->groupBy(function ($item) {
            return $item->published_at->format('Y-m-d');
        });
        $draft = Post::orderBy('published_at')->where('publish_status', false)->where('user_id', Auth()->user()->id)->get()->groupBy(function ($item) {
            return $item->published_at->format('Y-m-d');
        });
        $pub = [];
        foreach ($post as $key => $value) {
            array_push($pub, [
                'label' => $key,
                'data' => $value->count()
            ]);
        }
        $draf = [];
        foreach ($draft as $key => $value) {
            array_push($draf, [
                'label' => $key,
                'data' => $value->count()
            ]);
        }
        return response()->json(['pub' => $pub, 'draft' => $draf], 200);
    }
}
