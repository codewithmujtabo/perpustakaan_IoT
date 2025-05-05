@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<div class="card mt-4">
    <div class="card-header bg-info text-white">
        <h3 class="my-0">Detail Pengguna</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ $user->nama_lengkap }}</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> 
                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-primary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </p>
                        <p><strong>Terdaftar Pada:</strong> {{ $user->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Peminjaman:</strong> {{ $user->borrowings->count() }}</p>
                        <p><strong>Peminjaman Aktif:</strong> {{ $user->borrowings->where('status', 'dipinjam')->count() }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->nama_lengkap) }}&size=200&background=random" 
                     class="img-fluid rounded-circle mb-3" 
                     alt="{{ $user->nama_lengkap }}">
                <h4>{{ $user->nama_lengkap }}</h4>
                <p class="text-muted">{{ ucfirst($user->role) }}</p>
            </div>
        </div>
        
        @if($user->borrowings->count() > 0)
            <div class="mt-5">
                <h4>Riwayat Peminjaman</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->borrowings as $index => $borrowing)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $borrowing->book->judul }}</td>
                                    <td>{{ $borrowing->tanggal_pinjam->format('d M Y') }}</td>
                                    <td>
                                        {{ $borrowing->tanggal_kembali->format('d M Y') }}
                                        @if($borrowing->status === 'dipinjam' && $borrowing->tanggal_kembali < now())
                                            <span class="badge bg-danger">Terlambat</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $borrowing->status === 'dipinjam' ? 'bg-primary' : 'bg-success' }}">
                                            {{ $borrowing->status === 'dipinjam' ? 'Dipinjam' : 'Dikembalikan' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection