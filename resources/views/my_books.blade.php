@extends('layouts.master')
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/booksByList.js'])
@section('title', 'My Books')
@section('content')
<div class="grid grid-cols-4 h-full">
    <div class="col-span-1 rounded-lg flex justify-center items-center sticky top-0 mb-20">
    <div class="flex flex-col w-full justify-center ">
        @include('my_lists')
</div>
    </div>
    <div class="col-span-3 overflow-auto h-full">
    <div class="flex flex-wrap overflow-auto w-full justify-center"
     id="my-books-container">
        @include('my_book_card', ['books' => $books])
    </div>
    </div>
    </div>
    @endsection
