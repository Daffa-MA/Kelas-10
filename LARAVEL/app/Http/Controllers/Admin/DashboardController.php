<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan penjualan hari ini
        $today = now()->format('Y-m-d');
        $todaySales = Order::whereDate('created_at', $today)
            ->select(DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_price) as total_revenue'))
            ->first();

        // Ringkasan penjualan minggu ini
        $weekStart = now()->startOfWeek()->format('Y-m-d');
        $weekEnd = now()->endOfWeek()->format('Y-m-d');
        $weeklySales = Order::whereBetween(DB::raw('DATE(created_at)'), [$weekStart, $weekEnd])
            ->select(DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_price) as total_revenue'))
            ->first();

        // Pesanan terbaru
        $latestOrders = Order::with(['items.menu'])
            ->latest()
            ->take(5)
            ->get();

        // Menu terlaris
        $popularMenus = DB::table('order_items')
            ->join('menus', 'order_items.menu_id', '=', 'menus.id')
            ->select('menus.name', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->groupBy('menus.id', 'menus.name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'todaySales',
            'weeklySales',
            'latestOrders',
            'popularMenus'
        ));
    }
}