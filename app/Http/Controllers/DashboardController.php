<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Aggregator;

class DashboardController extends Controller
{
    public function __construct(protected Aggregator $aggregator) {}

    public function index()
    {
        $aggregate = $this->aggregator->getByYear(date('Y'));

        return view('dashboard.index', compact('aggregate'));
    }
}
