<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function create()
    {
        return view('admin.profiles.create');
    }

    public function store()
    {
        return redirect('admin/profiles');
    }

    public function edit()
    {
        return view('admin.profiles.edit');
    }

    public function update()
    {
        return redirect('admin/profiles/edit');
    }
}
