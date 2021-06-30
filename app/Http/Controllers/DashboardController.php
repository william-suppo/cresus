<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AggregateService;

class DashboardController extends Controller
{
    public function __construct(protected AggregateService $aggregateService) {}

    public function index()
    {
        $data = $this->aggregateService->getByYear(date('Y'));
    }
}
