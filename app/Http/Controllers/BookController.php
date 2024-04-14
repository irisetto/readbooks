<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scriptotek\GoogleBooks\GoogleBooks;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $googleBooks = new GoogleBooks(['maxResults' => 10]);
        $books = $googleBooks->volumes->search('Agatha Christie');

        return view('books', ['books' => $books]);
    }
    public function search(Request $request)
    {
        $query = $request->get('query');
        $googleBooks = new GoogleBooks(['maxResults' => 10]);
        $result= $googleBooks->volumes->search($query);
        return view('book_card', ['books' => $result]);
        
}
public function addToUserList(Request $request, $bookId)
{
    // $googleBooks = new GoogleBooks();
    // $googleBook = $googleBooks->volumes->get($bookId);
    // if (!$googleBook) {
    //     return redirect()->back()->with('error', 'Cartea nu a putut fi găsită în Google Books.');
    // }
    $existingBook = Book::where('google_id', $bookId)
    ->where('user_id', auth()->user()->id)
    ->first();
    if ($existingBook) {
        return response()->json(['error' => 'Cartea este deja în lista ta.'], 400);
    }
    $book = new Book();
    $book->google_id = $bookId;
    $book->user_id = auth()->user()->id;

    $book->save();

    //return response()->json(['message' => 'Cartea a fost adăugată în lista ta.']);

    return redirect('/dashboard')->with('success', 'Cartea a fost adăugată cu succes în lista ta.');
}
public function getUserBooks()
{
    $userBooks = Book::where('user_id', auth()->user()->id)->get();
    $books = [];
    foreach ($userBooks as $book) {
        $googleBooks = new GoogleBooks();
        $googleBook = $googleBooks->volumes->get($book->google_id);
        if ($googleBook) {
            $books[] = $googleBook;
        }
    }
    return view('dashboard', ['books' => $books]);
}
}
