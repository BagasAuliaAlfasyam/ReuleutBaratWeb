<?php

use App\Http\Controllers\AccountController;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/team', 'team');
    Route::get('/blog', 'blog');
    Route::get('/blog/detail/{post}', 'detail');
    Route::post('/post/visit', 'visit');
    Route::get('/blog/authors/{user:username}', 'authors');
    Route::get('/blog/categories/{category:slug}', 'categories');
    Route::get('/blog/tags/{tag:slug_tag}', 'tags');
    Route::get('/blog/published/{post:published_at}', 'published');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index');
    Route::post('/login', 'login')->name('login');
});
Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::get('/dashboard/traffic', 'traffic');
        Route::get('/dashboard/post', 'post');
    });

    // For Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/blog/categories', 'index');
        Route::get('/blog/category/create', 'create');
        Route::post('/blog/category', 'store');
        Route::get('/blog/category/edit/{id}', 'edit');
        Route::patch('/blog/category/update/{id}', 'update');
        Route::delete('/blog/category/destroy/{id}', 'destroy');
    });
    // For Tags
    Route::controller(TagController::class)->group(function () {
        Route::get('/blog/tags', 'index');
        Route::get('/blog/tag/create', 'create');
        Route::post('/blog/tag', 'store');
        Route::get('/blog/tag/edit/{id}', 'edit');
        Route::patch('/blog/tag/update/{id}', 'update');
        Route::delete('/blog/tag/destroy/{id}', 'destroy');
    });
    // For Posts
    Route::controller(PostController::class)->group(function () {
        Route::get('/blog/posts', 'index');
        Route::get('/blog/post/create', 'create');
        Route::post('/blog/post', 'store');
        Route::get('/blog/post/edit/{id}', 'edit');
        Route::get('/blog/post/show/{id}', 'show');
        Route::patch('/blog/post/update/{id}', 'update');
        Route::delete('/blog/post/destroy/{id}', 'destroy');
    });
    // For Teams
    Route::middleware(['admin'])->group(function () {
        Route::controller(TeamController::class)->group(function () {
            Route::get('/teams', 'index');
            Route::get('/team/create', 'create');
            Route::post('/team', 'store');
            Route::get('/team/edit/{id}', 'edit');
            Route::patch('/team/update/{id}', 'update');
            Route::get('/team/destroy/{id}', 'destroy');
        });
        // For Gallery
        Route::controller(GalleryController::class)->group(function () {
            Route::get('/galleries', 'index');
            Route::get('/gallery/create', 'create');
            Route::post('/gallery', 'store');
            Route::get('/gallery/edit/{id}', 'edit');
            Route::get('/gallery/destroy/{id}', 'destroy');
        });
        // For Create Account
        Route::controller(AccountController::class)->group(function () {
            Route::get('/accounts', 'index');
            Route::get('/account/create', 'create');
            Route::post('/account', 'store');
            Route::get('/account/{id}/edit','edit');
            Route::patch('/account/{id}/update', 'update');
            Route::get('/account/{id}/destroy', 'destroy');
        });
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index');
        Route::patch('/profile/update/{id}', 'update');
        Route::patch('/password/update/{id}', 'password');
        Route::patch('/image/update/{id}', 'changeImage');
    });
    Route::get('update', function () {
        $data = Team::all();
        $id = 1;
        foreach ($data as $key => $value) {
            DB::table('aparaturs')->where('id', $value->id)->update([
                'id' => $id
            ]);
            $id++;
        }
        return redirect('dashboard');
    });
    Route::get('/cache-clear', function () {
        $m = Artisan::call('optimize:clear');
        return $m;
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
