<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::with(['items', 'payments'])->get();
        $customers_count = Customer::count();

        $users = Order::with(['items', 'payments'])->select(DB::raw("COUNT(*) as count"), DB::raw("DAY(created_at) as day_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Day(created_at)"))
            ->pluck('count', 'day_name');
        $customer_labels = $users->keys();
        $customer_data = $users->values();

        $earnings = Payment::select(DB::raw("SUM(earning) as total_earnings"), DB::raw("DAY(created_at) as day_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Day(created_at)"))
        ->pluck('total_earnings', 'day_name');
        $earning_labels = $earnings->keys();
        $earning_data = $earnings->values();

        return view('home', [
            'orders_count' => $orders->count(),
            'sales' => $orders->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'sales_today' => $orders->where('created_at', '>=', date('Y-m-d').' 00:00:00')->map(function($i) {
                if($i->receivedAmount() > $i->total()) {
                    return $i->total();
                }
                return $i->receivedAmount();
            })->sum(),
            'customers_count' => $customers_count,
            'chart_customer_labels' => $customer_labels,
            'chart_customer_data' => $customer_data,
            'chart_earning_labels' => $earning_labels,
            'chart_earning_data' => $earning_data,
        ]);
    }
}
