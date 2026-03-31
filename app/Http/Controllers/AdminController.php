<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('pages.admin.index');
    }


    public function users()
    {
        $users = User::paginate(7);
        return view('pages.admin.users', compact('users'));
    }


    public function settings()
    {
        return view('pages.admin.settings');
    }
}
