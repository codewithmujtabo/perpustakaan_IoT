<!-- resources/views/books/show.blade.php -->

@extends('layouts.app')

@section('title', $book->judul)

@section('content')
<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h3 class="my-0">Detail Buku</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/300x400?text=Book+Cover" class="img-fluid rounded" alt="{{ $book->judul }}">
            </div>
            <div class="col-md-8">
                <h2>{{ $book->judul }}</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
                        <p><strong>Penerbit:</strong> {{ $book->penerbit }}</p>
                        <p><strong>Tahun Terbit:</strong> {{ $book->tahun_terbit }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>RFID Tag:</strong> {{ $book->rfid_tag }}</p>
                        <p><strong>Stok:</strong> {{ $book->stok }}</p>
                        <p>
                            <strong>Status:</strong>
                            <span class="badge {{ $book->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $book->stok > 0 ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <div class="mt-4">
                    @if(Auth::check())
                        @if($book->stok > 0)
                            <form action="{{ route('borrowings.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="id_buku" value="{{ $book->id_buku }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-book"></i> Pinjam Buku
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary" disabled>
                                <i class="fas fa-times-circle"></i> Tidak Tersedia
                            </button>
                        @endif
                    @endif
                    
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('books.edit', $book->id_buku) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('books.destroy', $book->id_buku) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection