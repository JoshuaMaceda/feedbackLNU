<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        // For now, hard‑code teacher ID = 1.
        // Later, you’ll replace this with dynamic logic (e.g., after login).
        return view('landing', ['teacherId' => 1]);
    }
}
