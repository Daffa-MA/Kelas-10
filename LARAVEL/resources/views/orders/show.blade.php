@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detail Pesanan</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="button" class="btn btn-success" onclick="window.print()">
                <i class="bi bi-printer"></i> Cetak Struk
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Informasi Pesanan</h5>
                    <span class="badge bg-{{ $order->status_color }}">{{ $order->status_label }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Kode Pesanan:</strong></div>
                        <div class="col-md-8">{{ $order->order_code }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Tanggal Pesanan:</strong></div>
                        <div class="col-md-8">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nama Pelanggan:</strong></div>
                        <div class="col-md-8">{{ $order->customer_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Nomor Telepon:</strong></div>
                        <div class="col-md-8">{{ $order->customer_phone }}</div>
                    </div>
                    @if($order->notes)
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Catatan:</strong></div>
                        <div class="col-md-8">{{ $order->notes }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Item</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->menu->image)
                                                    <img src="{{ asset('storage/' . $item->menu->image) }}" alt="{{ $item->menu->name }}" class="img-thumbnail me-2" style="max-width: 50px;">
                                                @endif
                                                <span>{{ $item->menu->name }}</span>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Status</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status Pesanan</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
@media print {
    .btn, .alert, form, .navbar, .footer {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .card-header {
        background: none !important;
        border-bottom: 1px solid #ddd !important;
    }
    .badge {
        border: 1px solid #000 !important;
        color: #000 !important;
        background: none !important;
    }
}
</style>
@endpush