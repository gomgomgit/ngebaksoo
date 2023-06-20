<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $this_month = date('m');

        $count_menu = Menu::count();
        $count_customer = Customer::count();
        $count_sold = OrderDetail::whereHas('order', function ($query) {
            return $query->where('status', 'done');
        })->whereMonth('created_at', $this_month)->sum('quantity');
        $count_profit = Order::where('status', 'done')->whereMonth('date', $this_month)->sum('total');
        $count_order = Order::where('status', 'pending')->count();
        $counter = (Object) [
            'menu' => $count_menu,
            'customer' => $count_customer,
            'sold' => $count_sold,
            'profit' => $count_profit,
            'order' => $count_order
        ];

        $revenue = [];
        for ($i=0; $i < 6; $i++) {
            $month = Carbon::now()->subMonth($i)->isoFormat('MMMM');
            $start = Carbon::now()->startOfMonth()->subMonth($i);
            $end = Carbon::now()->endOfMonth()->subMonth($i);
            array_push($revenue, (object) [
                'month' => $month,
                'value' => Order::whereBetween('date', [$start, $end])->sum('total'),
            ]);
        }

        return view('dashboard.index', compact('counter', 'revenue'));
    }
}
