<?php

namespace App\Http\Controllers;

class AdminReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Implementasi laporan belum ada pada project sebelumnya.
        // Minimal render agar route tidak 404 dan sidebar Admin tetap berfungsi.
        return view('admin.reports');
    }
}

