@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row mb-4">
        <!-- Ringkasan Hari Ini -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Penjualan Hari Ini</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="text-muted">Total Pesanan</h6>
                            <h2>{{ $todaySales->total_orders ?? 0 }}</h2>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted">Total Pendapatan</h6>
                            <h2>Rp {{ number_format($todaySales->total_revenue ?? 0, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Minggu Ini -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Penjualan Minggu Ini</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="text-muted">Total Pesanan</h6>
                            <h2>{{ $weeklySales->total_orders ?? 0 }}</h2>
                        </div>
                        <div class="col-6">
                            <h6 class="text-muted">Total Pendapatan</h6>
                            <h2>Rp {{ number_format($weeklySales->total_revenue ?? 0, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Menu Terlaris -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Menu Terlaris</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th class="text-end">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($popularMenus as $menu)
                                    <tr>
                                        <td>{{ $menu->name }}</td>
                                        <td class="text-end">{{ $menu->total_sold }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Belum ada data penjualan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-warning">
                    <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('orders.show', $order) }}" class="text-decoration-none">
                                                {{ $order->order_code }}
                                            </a>
                                        </td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td class="text-end">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada pesanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection