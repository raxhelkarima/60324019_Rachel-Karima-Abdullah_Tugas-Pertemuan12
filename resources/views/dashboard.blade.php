@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="mb-4">
    <i class="bi bi-speedometer2 text-primary"></i>
    Dashboard Perpustakaan
</h1>

<div class="row mb-4">

    {{-- statistik buku --}}
    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Buku</h6>
                        <h2>{{ $totalBuku }}</h2>
                    </div>

                    <i class="bi bi-book text-primary"
                       style="font-size: 3rem;"></i>
                </div>

                <hr>

                <span class="badge bg-success">
                    <i class="bi bi-check-circle"></i>
                    Tersedia: {{ $bukuTersedia }}
                </span>

                <span class="badge bg-danger">
                    <i class="bi bi-x-circle"></i>
                    Habis: {{ $bukuHabis }}
                </span>

            </div>
        </div>
    </div>

    {{-- statistik anggota --}}
    <div class="col-md-4">
        <div class="card border-success shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Anggota</h6>
                        <h2>{{ $totalAnggota }}</h2>
                    </div>

                    <i class="bi bi-people text-success"
                       style="font-size: 3rem;"></i>
                </div>

                <hr>

                <span class="badge bg-success">
                    <i class="bi bi-check-circle"></i>
                    Aktif: {{ $anggotaAktif }}
                </span>

                <span class="badge bg-secondary">
                    <i class="bi bi-x-circle"></i>
                    Nonaktif: {{ $anggotaNonaktif }}
                </span>

            </div>
        </div>
    </div>

    {{-- quick links --}}
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="mb-3">
                    <i class="bi bi-lightning-charge"></i>
                    Quick Links
                </h5>

                <div class="d-grid gap-2">

                    <a href="{{ route('home') }}"
                       class="btn btn-outline-secondary">
                        <i class="bi bi-house"></i>
                        Home
                    </a>

                    <a href="{{ route('buku.index') }}"
                       class="btn btn-outline-primary">
                        <i class="bi bi-book"></i>
                        Menu Buku
                    </a>

                    <a href="{{ route('anggota.index') }}"
                       class="btn btn-outline-success">
                        <i class="bi bi-people"></i>
                        Menu Anggota
                    </a>

                    <a href="#"
                       class="btn btn-outline-info">
                        <i class="bi bi-arrow-left-right"></i>
                        Transaksi
                    </a>

                </div>

            </div>
        </div>
    </div>

</div>

<div class="row">

    {{-- 5 buku terbaru --}}
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-book-half text-primary"></i>
                    5 Buku Terbaru
                </h5>
            </div>

            <div class="card-body">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Stok</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($bukuTerbaru as $buku)

                        <tr>
                            <td>{{ $buku->judul }}</td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $buku->stok }}
                                </span>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

    {{-- 5 anggota terbaru --}}
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">

            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-people-fill text-success"></i>
                    5 Anggota Terbaru
                </h5>
            </div>

            <div class="card-body">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($anggotaTerbaru as $anggota)

                        <tr>

                            <td>{{ $anggota->nama }}</td>

                            <td>

                                @if ($anggota->status == 'Aktif')

                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i>
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        <i class="bi bi-x-circle"></i>
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

</div>

@endsection