<!-- resources/views/borrowings/index.blade.php -->

@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center my-4">
    <h2>Daftar Peminjaman</h2>
    @if(Auth::check())
        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Pinjam Buku
        </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        @if(Auth::user()->role === 'admin')
                            <th>Nama Peminjam</th>
                        @endif
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $index => $borrowing)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @if(Auth::user()->role === 'admin')
                                <td>{{ $borrowing->user->nama_lengkap }}</td>
                            @endif
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
                            <td>
                                @if(Auth::user()->role === 'admin' && $borrowing->status === 'dipinjam')
                                    <form action="{{ route('borrowings.return', $borrowing->id_peminjaman) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Kembalikan
                                        </button>
                                    </form>
                                @elseif($borrowing->status === 'dipinjam')
                                    <span class="text-muted">Menunggu konfirmasi pengembalian</span>
                                @else
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Sudah dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'admin' ? '7' : '6' }}" class="text-center">Belum ada data peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection