<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index() {
        $data = [
            'users' => User::all()
        ];

        return view('home.account.index', $data);
    }

    public function create() {

    }

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
