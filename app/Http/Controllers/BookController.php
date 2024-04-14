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
        //dd($query);
        $books = [];
        $googleBooks = new GoogleBooks(['maxResults' => 10]);
        $result= $googleBooks->volumes->search($query);
        $i = 0;
        foreach($result as $book) {
            $books[$i] = [
                'title' => $book->title,
                'author' => $book->authors[0],
                'cover' => $book->getCover('thumbnail'),
                'google_id' => $book->id,
            ];
            $i++;

        }
        
        // return view('books', ['books' => $books]);
        return response()->json(['books' => $books]);
        
}
public function addToUserList(Request $request, $bookId)
{
    $googleBooks = new GoogleBooks();
    $googleBook = $googleBooks->volumes->get($bookId);
    if (!$googleBook) {
        return redirect()->back()->with('error', 'Cartea nu a putut fi găsită în Google Books.');
    }
    $title = $googleBook->title;
    if (isset($googleBook->authors)) {
    $authors = $googleBook->authors[0];
    }
    $cover = $googleBook->getCover('thumbnail');
    $book = new Book();
    $book->title = $title;
    $book->author = $authors;
    $book->google_id = $bookId;
    $book->cover = $cover;

    $book->user_id = auth()->user()->id;

    $book->save();


    return redirect('/dashboard')->with('success', 'Cartea a fost adăugată cu succes în lista ta.');
}
}
