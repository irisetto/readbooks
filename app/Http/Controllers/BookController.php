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
        $books = $googleBooks->volumes->search('A');
        if(auth()->check()){
            $userLists = auth()->user()->user_lists()->get();
        }
        return view('books', ['books' => $books, 'userLists' => $userLists]);
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
    $listId = $request->input('listId');
    $existingBook = Book::where('google_id', $bookId)
    ->where('user_id', auth()->user()->id)
    ->first();
    if ($existingBook) {
        return response()->json(['error' => 'The book is already in library.']);
    }
    $book = new Book();
    $book->google_id = $bookId;
    $book->user_id = auth()->user()->id;
    $book->user_list_id = $listId;

    $book->save();

    // //return response()->json(['message' => 'Cartea a fost adăugată în lista ta.']);

     return response()->json(['success' => 'The book was added successfully.']);
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
    if (!auth()->check()) {
        return view('book_details', ['book' => $book]);
    }
    $existingBook = Book::where('google_id', $bookId)
    ->where('user_id', auth()->user()->id)
    ->first();
    if ($existingBook) {
        $book->added = true;}
    return view('book_details', ['book' => $book]);
}
}