@extends('layouts.master')
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/booksByList.js'])
@section('title', 'My Books')
@section('content')
<div class="flex flex-row">
    <div>
        @include('my_lists')
</div>
    <div class="flex flex-wrap overflow-auto w-100 justify-center"
     id="my-books-container">
        @include('my_book_card', ['books' => $books])
    </div>
    </div>
    @endsection
