@extends('layouts.app')

@section('title', 'Daftar Menu')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Menu</h1>
        <div class="d-flex gap-3 align-items-center">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-outline-secondary" id="gridView" title="Grid View">
                    <i class="bi bi-grid"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary active" id="tableView" title="Table View">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            <a href="{{ route('menus.create') }}" class="btn btn-primary">Tambah Menu</a>
        </div>
    </div>

    @include('menus.search')

    <div id="gridViewContent" class="d-none">
        <div class="row g-4">
            @forelse($menus as $menu)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge {{ $menu->is_available ? 'bg-success' : 'bg-danger' }}">
                                    {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $menu->name }}</h5>
                            <p class="card-text text-muted small mb-2">{{ $menu->category->name }}</p>
                            <p class="card-text" style="height: 48px; overflow: hidden;">{{ Str::limit($menu->description, 100) }}</p>
                            <h6 class="mb-3 text-primary">Rp {{ number_format($menu->price, 0, ',', '.') }}</h6>
                            <div class="d-flex gap-2 justify-content-between align-items-center">
                                <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-primary" {{ !$menu->is_available ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                    </button>
                                </form>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('menus.show', $menu) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Tidak ada menu yang ditemukan.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div id="tableViewContent">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($menu->image)
                                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-thumbnail" style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>{{ $menu->name }}</div>
                                        <small class="text-muted">{{ Str::limit($menu->description, 50) }}</small>
                                    </td>
                                    <td>{{ $menu->category->name }}</td>
                                    <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $menu->is_available ? 'bg-success' : 'bg-danger' }}">
                                            {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-sm btn-primary" {{ !$menu->is_available ? 'disabled' : '' }}>
                                                    <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                                </button>
                                            </form>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('menus.show', $menu) }}" class="btn btn-sm btn-outline-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data menu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $menus->withQueryString()->links() }}
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gridView = document.getElementById('gridView');
            const tableView = document.getElementById('tableView');
            const gridViewContent = document.getElementById('gridViewContent');
            const tableViewContent = document.getElementById('tableViewContent');

            gridView.addEventListener('click', function() {
                gridView.classList.add('active');
                tableView.classList.remove('active');
                gridViewContent.classList.remove('d-none');
                tableViewContent.classList.add('d-none');
            });

            tableView.addEventListener('click', function() {
                tableView.classList.add('active');
                gridView.classList.remove('active');
                tableViewContent.classList.remove('d-none');
                gridViewContent.classList.add('d-none');
            });
        });
    </script>
    @endpush
@endsection