@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-warning text-white">
        <h3 class="my-0">Edit Data Peminjaman</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('borrowings.update', $borrowing->id_peminjaman) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_user" class="form-label">Peminjam</label>
                    <select class="form-select @error('id_user') is-invalid @enderror" id="id_user" name="id_user" required>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $borrowing->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="id_buku" class="form-label">Buku</label>
                    <select class="form-select @error('id_buku') is-invalid @enderror" id="id_buku" name="id_buku" required>
                        @foreach($books as $book)
                            <option value="{{ $book->id_buku }}" {{ $borrowing->book_id == $book->id_buku ? 'selected' : '' }}>
                                {{ $book->judul }} (Stok: {{ $book->stok }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_buku')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" 
                           id="tanggal_pinjam" name="tanggal_pinjam" 
                           value="{{ old('tanggal_pinjam', $borrowing->tanggal_pinjam->format('Y-m-d')) }}" required>
                    @error('tanggal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" 
                           id="tanggal_kembali" name="tanggal_kembali" 
                           value="{{ old('tanggal_kembali', $borrowing->tanggal_kembali->format('Y-m-d')) }}" required>
                    @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="dipinjam" {{ $borrowing->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ $borrowing->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection