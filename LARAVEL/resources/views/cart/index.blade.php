@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Keranjang Belanja</h1>
        <a href="{{ route('menus.index') }}" class="btn btn-primary">Tambah Menu</a>
    </div>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($details['image'])
                                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="img-thumbnail me-2" style="max-width: 50px;">
                                            @endif
                                            <span>{{ $details['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="input-group" style="max-width: 150px;">
                                            <button class="btn btn-outline-secondary btn-sm update-cart" data-id="{{ $id }}" data-action="decrease">-</button>
                                            <input type="number" class="form-control form-control-sm text-center quantity" value="{{ $details['quantity'] }}" min="1">
                                            <button class="btn btn-outline-secondary btn-sm update-cart" data-id="{{ $id }}" data-action="increase">+</button>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="table-primary">
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Informasi Pemesanan</h4>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Nomor Telepon</label>
                        <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                        @error('customer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">Buat Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <h4>Keranjang Belanja Kosong</h4>
                <p class="text-muted">Silakan tambahkan menu ke keranjang terlebih dahulu.</p>
                <a href="{{ route('menus.index') }}" class="btn btn-primary">Lihat Menu</a>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadingOverlay = document.createElement('div');
        loadingOverlay.style.cssText = 'display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.8);z-index:9999;';
        loadingOverlay.innerHTML = '<div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;"><div class="spinner-border text-primary" role="status"></div><div class="mt-2">Memproses...</div></div>';
        document.body.appendChild(loadingOverlay);

        function showLoading() {
            loadingOverlay.style.display = 'block';
        }

        function hideLoading() {
            loadingOverlay.style.display = 'none';
        }

        function showError(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.querySelector('.container').insertBefore(alertDiv, document.querySelector('.container').firstChild);
            setTimeout(() => alertDiv.remove(), 5000);
        }

        // Update quantity
        document.querySelectorAll('.update-cart').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const action = this.getAttribute('data-action');
                const row = this.closest('tr');
                const quantityInput = row.querySelector('.quantity');
                let quantity = parseInt(quantityInput.value);

                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                } else {
                    return;
                }

                quantityInput.value = quantity;
                updateCart(id, quantity, row);
            });
        });

        // Manual quantity input
        document.querySelectorAll('.quantity').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.closest('tr').getAttribute('data-id');
                const quantity = parseInt(this.value);
                
                if (isNaN(quantity) || quantity < 1) {
                    this.value = 1;
                    return;
                }
                
                updateCart(id, quantity, this.closest('tr'));
            });
        });

        // Remove item
        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const row = this.closest('tr');
                removeFromCart(id, row);
            });
        });

        // Update cart function
        function updateCart(id, quantity, row) {
            showLoading();
            fetch(`/cart/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    showError(data.message || 'Terjadi kesalahan saat memperbarui keranjang');
                }
            })
            .catch(error => {
                showError('Terjadi kesalahan saat memperbarui keranjang');
                console.error('Error:', error);
            })
            .finally(() => {
                hideLoading();
            });
        }

        // Remove from cart function
        function removeFromCart(id, row) {
            if (confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
                showLoading();
                fetch(`/cart/remove/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        showError(data.message || 'Terjadi kesalahan saat menghapus item');
                    }
                })
                .catch(error => {
                    showError('Terjadi kesalahan saat menghapus item');
                    console.error('Error:', error);
                })
                .finally(() => {
                    hideLoading();
                });
            }
        }
    });
</script>
@endpush