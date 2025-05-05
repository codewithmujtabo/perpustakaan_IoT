<!-- resources/views/books/index.blade.php -->

@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center my-4">
    <h2>Daftar Buku</h2>
    @if(Auth::check() && Auth::user()->role === 'admin')
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    @endif
</div>

<div class="row">
    @forelse($books as $book)
        <div class="col-md-3 mb-4">
            <div class="card book-card h-100">
                <img src="https://via.placeholder.com/300x400?text=Book+Cover" class="card-img-top" alt="{{ $book->judul }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->judul }}</h5>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-user me-1"></i> {{ $book->penulis }}
                        </small>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-building me-1"></i> {{ $book->penerbit }}
                        </small>
                    </p>
                    <p class="card-text">
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i> {{ $book->tahun_terbit }}
                        </small>
                    </p>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="badge {{ $book->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                            {{ $book->stok > 0 ? 'Tersedia: ' . $book->stok : 'Stok Habis' }}
                        </span>
                        <a href="{{ route('books.show', $book->id_buku) }}" class="btn btn-sm btn-info text-white">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i> Belum ada buku yang tersedia.
            </div>
        </div>
    @endforelse
</div>
@endsection