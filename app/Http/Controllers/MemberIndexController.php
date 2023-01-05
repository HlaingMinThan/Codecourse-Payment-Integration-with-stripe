<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberIndexController extends Controller
{
    public function __invoke()
    {
        return view('members');
    }
}
