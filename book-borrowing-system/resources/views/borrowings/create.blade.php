<!-- resources/views/borrowings/create.blade.php -->

@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h3 class="my-0">Pinjam Buku</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('borrowings.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="id_buku" class="form-label">Pilih Buku</label>
                <select class="form-select @error('id_buku') is-invalid @enderror" id="id_buku" name="id_buku" required>
                    <option value="">-- Pilih Buku --</option>
                    @foreach($books as $book)
                        <option value="{{ $book->id_buku }}">{{ $book->judul }} (Stok: {{ $book->stok }})</option>
                    @endforeach
                </select>
                @error('id_buku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-book"></i> Pinjam
                </button>
                <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection