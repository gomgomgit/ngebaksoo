<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index (Request $request) {
        $start = $request->start ?? Carbon::now()->startOfMonth()->toDateString();
        $end = $request->end ?? Carbon::now()->endOfMonth()->toDateString();

        $orders = Order::where('status', 'done')->whereBetween('date', [$start, $end])->withCount('orderDetails')->with('orderDetails.menu')->get();

        $data = (object)[
            'start' => $start,
            'end' => $end,
            'orders' => $orders
        ];
        return view('report.index', compact('data'));
    }
}
