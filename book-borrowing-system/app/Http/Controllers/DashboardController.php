<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'member')->count();
        $activeBorrowings = Borrowing::where('status', 'dipinjam')->count();
        $overdueBorrowings = Borrowing::where('status', 'dipinjam')
            ->where('tanggal_kembali', '<', now())
            ->count();
            
        $recentBorrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('dashboard.index', compact(
            'totalBooks',
            'totalUsers',
            'activeBorrowings',
            'overdueBorrowings',
            'recentBorrowings'
        ));
    }
}