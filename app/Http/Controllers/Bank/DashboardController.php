<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Services\Aggregator;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected Aggregator $aggregator) {}

    public function index(string $year = null): View
    {
        $year = $year ?: date('Y');

        $aggregate = $this->aggregator->getByYear($year);

        return view('dashboard.index', compact('aggregate', 'year'));
    }
}
