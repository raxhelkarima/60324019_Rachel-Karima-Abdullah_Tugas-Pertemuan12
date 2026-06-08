@extends('layouts.app')
 
@section('title', 'Daftar Buku')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>

    <div>
        <button type="submit"
                form="bulk-delete-form"
                class="btn btn-danger">
            <i class="bi bi-trash"></i>
            Hapus Terpilih
        </button>

        <a href="{{ route('buku.export') }}"
        class="btn btn-success">
            <i class="bi bi-download"></i>
            Export CSV
        </a>

        <a href="{{ route('buku.create') }}"
        class="btn btn-primary">
            <i class="bi bi-plus-circle"></i>
            Tambah Buku
        </a>
    </div>

</div>

<form action="{{ route('buku.search') }}"
      method="GET"
      class="card card-body mb-4">

    <div class="row g-3">

        <div class="col-md-3">
            <input type="text"
                   name="keyword"
                   class="form-control"
                   placeholder="Cari judul/pengarang">
        </div>

        <div class="col-md-2">
            <select name="kategori" class="form-select">

                <option value="">Kategori</option>

                <option value="Programming">
                    Programming
                </option>

                <option value="Database">
                    Database
                </option>

                <option value="Web Design">
                    Web Design
                </option>

            </select>
        </div>

        <div class="col-md-2">
            <select name="tahun" class="form-select">

                <option value="">Tahun</option>

                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>

            </select>
        </div>

        <div class="col-md-2">
            <select name="stok" class="form-select">

                <option value="">Semua</option>

                <option value="tersedia">
                    Tersedia
                </option>

                <option value="habis">
                    Habis
                </option>

            </select>
        </div>

        <div class="col-md-3">

            <button class="btn btn-primary w-100">

                <i class="bi bi-search"></i>
                Cari Buku

            </button>

        </div>

    </div>

</form>
 
{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
{{-- Filter Kategori --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="card-title">
            <i class="bi bi-funnel"></i> Filter Kategori:
        </h6>
        <div class="btn-group" role="group">
            <a href="{{ route('buku.index') }}" class="btn btn-sm {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">
                Semua
            </a>
            <a href="{{ route('buku.kategori', 'Programming') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Programming' ? 'btn-primary' : 'btn-outline-primary' }}">
                Programming
            </a>
            <a href="{{ route('buku.kategori', 'Database') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Database' ? 'btn-primary' : 'btn-outline-primary' }}">
                Database
            </a>
            <a href="{{ route('buku.kategori', 'Web Design') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Web Design' ? 'btn-primary' : 'btn-outline-primary' }}">
                Web Design
            </a>
            <a href="{{ route('buku.kategori', 'Networking') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Networking' ? 'btn-primary' : 'btn-outline-primary' }}">
                Networking
            </a>
            <a href="{{ route('buku.kategori', 'Data Science') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Data Science' ? 'btn-primary' : 'btn-outline-primary' }}">
                Data Science
            </a>
        </div>
    </div>
</div>
 
<form action="{{ route('buku.bulk-delete') }}"
      method="POST"
      id="bulk-delete-form">

    @csrf

    <div class="mb-3">
        <input type="checkbox" id="select-all">
        <label for="select-all">
            Pilih Semua
        </label>

        <button type="submit"
                class="btn btn-danger btn-sm ms-3">
            Hapus Terpilih
        </button>
    </div>

    <div class="row">

        @forelse ($bukus as $buku)

            <div class="col-md-4 mb-4">
                <x-buku-card :buku="$buku" />
            </div>

        @empty

            <div class="alert alert-info">
                Tidak ada data buku
            </div>

        @endforelse

    </div>

</form>
 
@if ($bukus->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
            @isset($kategori)
                dari kategori <strong>{{ $kategori }}</strong>
            @endisset
        </p>
    </div>
@endif

@push('scripts')
<script>
    // SweetAlert confirmation untuk delete
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const judul = this.getAttribute('data-judul');
            
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
@push('scripts')
<script>
document.getElementById('select-all').addEventListener('change', function() {
    document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
        cb.checked = this.checked;
    });
});
</script>
@endpush
@endsection