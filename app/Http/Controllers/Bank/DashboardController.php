<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Aggregator;
use function view;

class DashboardController extends Controller
{
    public function __construct(protected Aggregator $aggregator) {}

    public function index()
    {
        $aggregate = $this->aggregator->getByYear(date('Y'));

        return view('dashboard.index', compact('aggregate'));
    }
}
