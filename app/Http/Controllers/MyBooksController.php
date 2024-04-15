<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scriptotek\GoogleBooks\GoogleBooks;

class MyBooksController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $books = $user->books;
        $userBooks = [];
        foreach ($books as $book) {
            $googleBooks = new GoogleBooks();
            $googleBook = $googleBooks->volumes->get($book->google_id);
            if ($googleBook) {
                $userBooks[] = $googleBook;
            }
        }
        return view('my_books', ['books' => $userBooks]);
    }
    public function delete($bookId)
    {
        $user = auth()->user();
        $book = $user->books->where('google_id', $bookId)->first();
        if ($book) {
            $book->delete();
            return redirect('/my_books')->with('success', 'Cartea a fost ștearsă cu succes din lista ta.');
        }
        return redirect('/my_books')->with('error', 'Cartea nu a fost găsită în lista ta.');
    }
}
