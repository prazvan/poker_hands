<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard');
    }
}
