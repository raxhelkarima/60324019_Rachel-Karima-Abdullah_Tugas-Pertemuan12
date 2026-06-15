@php
    $kategoriClass = match ($buku->kategori) {
        'Programming' => 'primary',
        'Database' => 'success',
        'Web Design' => 'info',
        'Networking' => 'warning',
        'Data Science' => 'danger',
        default => 'secondary',
    };
@endphp

<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="row align-items-center">

            {{-- checkbox + logo --}}
            <div class="col-md-2 text-center">

                <div class="mb-3 text-start">
                    <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}">
                </div>

                <i class="bi bi-book-fill text-primary"
                   style="font-size:4rem;"></i>

                <div class="mt-3">
                    <span class="badge bg-{{ $kategoriClass }}">
                        {{ $buku->kategori }}
                    </span>
                </div>

            </div>

            {{-- informasi buku --}}
            <div class="col-md-7">

                <h5 class="fw-bold mb-2">
                    {{ $buku->judul }}
                </h5>

                <p class="text-muted mb-3">
                    {{ $buku->pengarang }}
                </p>

                <div class="mb-3">

                    <strong>
                        {{ $buku->harga_format }}
                    </strong>

                </div>

                <div class="d-flex gap-2 mb-3">

                    @if($buku->stok > 0)

                        <span class="badge bg-success">
                            Tersedia
                        </span>

                    @else

                        <span class="badge bg-danger">
                            Habis
                        </span>

                    @endif

                    <span class="badge bg-secondary">
                        Stok: {{ $buku->stok }}
                    </span>

                </div>

                <small class="text-muted">
                    {{ $buku->penerbit }}
                    |
                    {{ $buku->tahun_terbit }}
                </small>

            </div>

            {{-- harga dan tombol --}}
            <div class="col-md-3 text-end">

                <div class="mb-3">

                    <h4 class="text-primary">
                        {{ $buku->harga_format }}
                    </h4>

                    <small class="text-muted">
                        Harga Buku
                    </small>

                </div>

                <div class="d-grid gap-2">

                    <a href="{{ route('buku.show',$buku->id) }}"
                       class="btn btn-info btn-sm text-white">
                        Detail
                    </a>

                    <a href="{{ route('buku.edit',$buku->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                        <button type="button"
                                class="btn btn-danger btn-sm w-100 btn-delete"
                                data-judul="{{ $buku->judul }}"
                                data-url="{{ route('buku.destroy', $buku->id) }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>

                </div>

            </div>

        </div>

    </div>

</div>