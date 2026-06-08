<div class="form-check mb-2">
    <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}">
</div>

<div class="card h-100 shadow-sm">
<div class="card h-100 shadow-sm">

    <div class="card-body">

        <div class="form-check mb-3">
            <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}">
        </div>

        <div class="text-center mb-3">

            <i class="bi bi-book text-primary"
               style="font-size: 4rem;"></i>

        </div>

        <h5>{{ $buku->judul }}</h5>

        <p class="text-muted">
            <i class="bi bi-person"></i>
            {{ $buku->pengarang }}
        </p>

        <span class="badge bg-info">
            <i class="bi bi-tag"></i>
            {{ $buku->kategori }}
        </span>

        <hr>

        <p>
            <i class="bi bi-cash"></i>
            Rp {{ number_format($buku->harga) }}
        </p>

        <p>
            <i class="bi bi-box"></i>
            Stok: {{ $buku->stok }}
        </p>

        @if ($buku->stok > 0)

            <span class="badge bg-success">
                <i class="bi bi-check-circle"></i>
                Tersedia
            </span>

        @else

            <span class="badge bg-danger">
                <i class="bi bi-x-circle"></i>
                Habis
            </span>

        @endif

        @if ($showActions)

            <div class="btn-group-vertical d-grid gap-2">
                <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-info text-white">
                    <i class="bi bi-eye"></i> Detail
                </a>
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                
                {{-- Delete Button dengan SweetAlert --}}
                <form action="{{ route('buku.destroy', $buku->id) }}" 
                    method="POST" 
                    class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger w-100 btn-delete" 
                            data-judul="{{ $buku->judul }}">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>

            </div>

        @endif

    </div>

</div>