@extends('layouts.master')
@vite(['resources/css/app.css','resources/js/app.js'])
@section('title', 'Books')
@section('content')
<div class="flex flex-wrap overflow-auto w-100 justify-center">
@if (!isset($books))
    <p class="text-center text-2xl ">No books in your library :(  </p>
@else
@foreach ($books as $book) 
    <div class="m-1 mb-8 px-1  sm:w-1/5 md:w-1/6 ">
      <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
        <img src="{{$book->getCover('thumbnail')}}" alt="book cover" class="rounded-t-lg " />
        <div class="p-2 flex-grow">
          <h2 class="mb-2 text-md font-semibold break-words">{{ $book->title }}</h2>
          @if ($book->authors)
          <p class="mb-2 text-sm text-gray-700">Author: {{ $book->authors[0] }}</p>
          @endif
          <p class="mb-4 text-sm text-gray-700">Data publicării: {{ $book->publishedDate }}</p>
        </div>
      </div>
    </div>
@endforeach
@endif
@endsection