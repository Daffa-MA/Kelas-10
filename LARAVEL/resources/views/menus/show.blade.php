@extends('layouts.app')

@section('title', 'Detail Menu')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Detail Menu</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="img-fluid rounded">
                    @else
                        <div class="text-center p-4 bg-light rounded">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th style="width: 200px">Nama Menu</th>
                            <td>{{ $menu->name }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $menu->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $menu->is_available ? 'bg-success' : 'bg-danger' }}">
                                    {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $menu->description ?: 'Tidak ada deskripsi' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('menus.edit', $menu) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection