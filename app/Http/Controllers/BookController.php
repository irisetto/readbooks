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
        $googleBooks = new GoogleBooks(['maxResults' => 15]);
        $books = $googleBooks->volumes->search('A');

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
    
    $existingBook = Book::where('google_id', $bookId)
    ->where('user_id', auth()->user()->id)
    ->first();
    if ($existingBook) {
        return redirect()->back()->with('error', 'Cartea exista deja în lista ta.')->withInput();;
    }
    $book = new Book();
    $book->google_id = $bookId;
    $book->user_id = auth()->user()->id;

    $book->save();

    //return response()->json(['message' => 'Cartea a fost adăugată în lista ta.']);

    return redirect('/my_books')->with('success', 'Cartea a fost adăugată cu succes în lista ta.');
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
    return view('/my_books', ['books' => $books]);
}
public function showBook($bookId)
{
    $googleBooks = new GoogleBooks();
    $book = $googleBooks->volumes->get($bookId);
    $book->added = false;
    $existingBook = Book::where('google_id', $bookId)
    ->where('user_id', auth()->user()->id)
    ->first();
    if ($existingBook) {
        $book->added = true;}
    return view('book_details', ['book' => $book]);
}
}