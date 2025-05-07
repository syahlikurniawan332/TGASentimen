<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function show()
    {
        $data = Seminar::all();
        return view('test', compact('data'));
    }
}
