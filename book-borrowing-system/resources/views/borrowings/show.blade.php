@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h3 class="my-0">Detail Peminjaman</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5>Informasi Peminjam</h5>
                <hr>
                <p><strong>Nama:</strong> {{ $borrowing->user->nama_lengkap }}</p>
                <p><strong>Email:</strong> {{ $borrowing->user->email }}</p>
                <p><strong>Role:</strong> {{ ucfirst($borrowing->user->role) }}</p>
            </div>
            
            <div class="col-md-6">
                <h5>Informasi Buku</h5>
                <hr>
                <p><strong>Judul:</strong> {{ $borrowing->book->judul }}</p>
                <p><strong>Penulis:</strong> {{ $borrowing->book->penulis }}</p>
                <p><strong>Penerbit:</strong> {{ $borrowing->book->penerbit }}</p>
                <p><strong>Stok:</strong> {{ $borrowing->book->stok }}</p>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Detail Peminjaman</h5>
                <hr>
                <p><strong>Tanggal Pinjam:</strong> {{ $borrowing->tanggal_pinjam->format('d M Y') }}</p>
                <p><strong>Tanggal Kembali:</strong> {{ $borrowing->tanggal_kembali->format('d M Y') }}</p>
                @if($borrowing->status === 'dipinjam' && $borrowing->tanggal_kembali < now())
                    <p class="text-danger"><strong>Status:</strong> Terlambat</p>
                @endif
            </div>
            
            <div class="col-md-6">
                <h5>Status</h5>
                <hr>
                <p>
                    <strong>Status:</strong>
                    <span class="badge {{ $borrowing->status === 'dipinjam' ? 'bg-primary' : 'bg-success' }}">
                        {{ $borrowing->status === 'dipinjam' ? 'Dipinjam' : 'Dikembalikan' }}
                    </span>
                </p>
                
                @if($borrowing->status === 'dipinjam')
                    <p class="text-muted"><small>Harap kembalikan buku sebelum tanggal kembali</small></p>
                @else
                    <p class="text-success"><small>Buku telah dikembalikan</small></p>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('borrowings.edit', $borrowing->id_peminjaman) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                
                @if($borrowing->status === 'dipinjam')
                    <form action="{{ route('borrowings.return', $borrowing->id_peminjaman) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Kembalikan
                        </button>
                    </form>
                @endif
                
                <form action="{{ route('borrowings.destroy', $borrowing->id_peminjaman) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
            @endif
            
            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection