<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Scriptotek\GoogleBooks\GoogleBooks;

use App\Models\Book;

class ListController extends Controller
{
    public function getLists()
    {
        $user = Auth::user();
        $lists = $user->lists;
        return view('user.lists', compact('lists'));
    }

    public function getBooksByList(Request $request,$listId)
    {
        $books= Book::where('user_list_id', $listId)
        ->where('user_id', auth()->user()->id)
        ->get();
        $userBooks = [];
        foreach ($books as $book) {
                $googleBooks = new GoogleBooks();
                $googleBook = $googleBooks->volumes->get($book->google_id);
                if ($googleBook) {
                    $userBooks[] = $googleBook;
                }
            }
        return view('my_book_card', ['books' => $userBooks]);
        //return view('lists.showBooks', compact('books'));
    }
}
