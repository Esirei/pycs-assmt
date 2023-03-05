<?php

namespace App\Http\Controllers;

use App\Models\Enums\InformationType;
use App\Models\Information;

class ReportsController extends Controller
{
    public function __invoke()
    {
        return Information::where('type', InformationType::LOCATION)
            ->select(['type', 'content'])
            ->groupBy(['type', 'content'])
            ->selectSub('count(content)', 'total')
            ->orderByDesc('total')
            ->paginate()
            ->withQueryString();
    }
}
