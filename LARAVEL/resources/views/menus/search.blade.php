<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('menus.index') }}" method="GET" class="row g-3" id="searchForm">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="search" class="form-label">Cari Menu</label>
                    <input type="text" class="form-control @error('search') is-invalid @enderror" id="search" name="search" value="{{ request('search') }}" placeholder="Nama menu..." minlength="2">
                    @error('search')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="price_range" class="form-label">Rentang Harga</label>
                    <select class="form-select @error('price_range') is-invalid @enderror" id="price_range" name="price_range">
                        <option value="">Semua Harga</option>
                        <option value="0-25000" {{ request('price_range') == '0-25000' ? 'selected' : '' }}>< Rp 25.000</option>
                        <option value="25000-50000" {{ request('price_range') == '25000-50000' ? 'selected' : '' }}>Rp 25.000 - Rp 50.000</option>
                        <option value="50000-100000" {{ request('price_range') == '50000-100000' ? 'selected' : '' }}>Rp 50.000 - Rp 100.000</option>
                        <option value="100000-" {{ request('price_range') == '100000-' ? 'selected' : '' }}>> Rp 100.000</option>
                    </select>
                    @error('price_range')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sort" class="form-label">Urutkan</label>
                    <select class="form-select" id="sort" name="sort">
                        <option value="">Urutan Default</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Paling Populer</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    </select>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100" id="filterButton">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="loadingSpinner"></span>
                    <span id="buttonText">Filter</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('searchForm').addEventListener('submit', function() {
    document.getElementById('loadingSpinner').classList.remove('d-none');
    document.getElementById('buttonText').textContent = 'Mencari...';
    document.getElementById('filterButton').disabled = true;
});
</script>