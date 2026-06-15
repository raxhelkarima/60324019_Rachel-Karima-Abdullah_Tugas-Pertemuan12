@extends('layouts.app')
 
@section('title', 'Daftar Buku')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">

    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>

    <div>
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

<form action="{{ route('buku.search') }}"
      method="GET"
      class="card card-body mb-4">

    <div class="row g-2 align-items-end">

        <div class="col-md-4">
            <label class="form-label fw-semibold"> Keyword </label>
            <input type="text" name="keyword" class="form-control" placeholder="Cari judul, pengarang, penerbit">
        </div>

        <div class="col-md-2">
            <label class="form-label fw-semibold"> Kategori </label>
            <select name="kategori" class="form-select">
                <option value="">Semua</option>
                <option value="Programming">Programming</option>
                <option value="Database">Database</option>
                <option value="Web Design">Web Design</option>
                <option value="Networking">Networking</option>
                <option value="Data Science">Data Science</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label fw-semibold"> Tahun </label>
            <select name="tahun" class="form-select">
                <option value="">Semua</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label fw-semibold"> Ketersediaan </label>
            <select name="stok" class="form-select">
                <option value="">Semua</option>
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
            </select>
        </div>

        <div class="col-md-2 d-flex gap-2">
            <button type="submit"class="btn btn-primary flex-fill">
                <i class="bi bi-search"></i>Cari
            </button>
            <a href="{{ route('buku.index') }}"class="btn btn-outline-secondary">
                <i class="bi bi-arrow-clockwise"></i>Reset
            </a>
        </div>

    </div>

</form>
 
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

    <div class="d-flex align-items-center gap-3 mb-3">
        <div>
            <input type="checkbox" id="select-all">
            <label for="select-all">Pilih Semua</label>
        </div>

        <span class="badge bg-primary" id="selected-count">
            0 dipilih
        </span>

        <button type="submit"
                class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i>
            Hapus Terpilih
        </button>
    </div>

    <div class="row">
        @forelse ($bukus as $buku)
            <div class="col-12 mb-3">
                <x-buku-card :buku="$buku" />
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Tidak ada data buku</div>
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
            const judul = this.getAttribute('data-judul');
            const url = this.getAttribute('data-url');
            
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
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

    //select all checkbox
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
            cb.checked = this.checked;
        });
        updateSelectedCount();
    });

    function updateSelectedCount() {
        let total = document.querySelectorAll('input[name="buku_ids[]"]:checked').length;
        document.getElementById('selected-count').textContent = total + ' dipilih';
    }

    document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
        cb.addEventListener('change', updateSelectedCount);
    });

    // konfimasi bulk delete
    document.getElementById('bulk-delete-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const checked = document.querySelectorAll('input[name="buku_ids[]"]:checked');

        if (checked.length === 0) {
            Swal.fire('Perhatian', 'Pilih minimal satu buku!', 'warning');
            return;
        }

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus ${checked.length} buku terpilih?`,
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
</script>
@endpush
@endsection