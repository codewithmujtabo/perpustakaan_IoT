<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Requests\BorrowingRequest;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        } else {
            $borrowings = Borrowing::where('id_user', Auth::id())
                ->with('book')
                ->latest()
                ->get();
        }
        
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $books = Book::where('stok', '>', 0)->get();
        return view('borrowings.create', compact('books'));
    }

    public function store(BorrowingRequest $request)
    {
        $book = Book::findOrFail($request->id_buku);
        
        if ($book->stok <= 0) {
            return back()->with('error', 'Book is out of stock');
        }
        
        // Create borrowing
        $borrowing = Borrowing::create([
            'id_user' => Auth::id(),
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now()->addDays(7),
            'status' => 'dipinjam',
        ]);
        
        // Update book stock
        $book->decrement('stok');
        
        return redirect()->route('borrowings.index')->with('success', 'Book borrowed successfully');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status === 'dikembalikan') {
            return back()->with('error', 'This book has already been returned');
        }
        
        $borrowing->update([
            'status' => 'dikembalikan',
        ]);
        
        // Increment the book stock when returned
        $borrowing->book->increment('stok');
        
        return back()->with('success', 'Book returned successfully');
    }
}
