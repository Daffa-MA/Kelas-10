@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Detail Kategori</h2>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <h3>{{ $category->name }}</h3>
                <p class="text-muted">{{ $category->description ?: 'Tidak ada deskripsi' }}</p>
            </div>

            <div class="mb-4">
                <h4>Menu dalam Kategori Ini</h4>
                @if($category->menus->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $menu->name }}</td>
                                        <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $menu->is_available ? 'bg-success' : 'bg-danger' }}">
                                                {{ $menu->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">Belum ada menu dalam kategori ini</p>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Kembali</a>
                <div>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection