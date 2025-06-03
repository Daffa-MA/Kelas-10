@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Pesanan</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>
                                    <div>
                                        <strong>{{ $order->customer_name }}</strong>
                                        <div class="text-muted small">{{ $order->customer_phone }}</div>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('orders.update', $order) }}" method="POST" class="d-flex gap-2 align-items-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm" style="width: 130px;" onchange="this.form.submit()">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info text-white">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        <button type="button" class="btn btn-sm btn-success" onclick="window.print()">
                                            <i class="bi bi-printer"></i> Cetak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">Belum ada pesanan</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection