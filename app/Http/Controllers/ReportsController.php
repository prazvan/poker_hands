<?php

namespace App\Http\Controllers;

use App\Services\Reports\ReportsService;
use App\Services\Reports\Types\Poker as PokerReport;

use Illuminate\View\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers
 */
class ReportsController extends Controller
{
    /**
     * @var ReportsService
     */
    private $ReportsService;

    /**
     * ReportsController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // get the PokerReport service
        $this->ReportsService = ReportsService::make(PokerReport::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $reports = $this->ReportsService->getCurrentUserReports();

        return view('reports', compact('reports'));
    }
}
