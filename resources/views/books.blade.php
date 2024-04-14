@extends('layouts.master')
@section('title', 'Books')
@vite(['resources/css/app.css','resources/js/app.js','resources/js/searchBooks.js'])

@section('content')
<div class="mt-5 w-1/2 mr-auto ml-auto mb-5">
    <div class="px-2 flex items-center border-1 bg-white border shadow-md rounded-full">
    
        <input name="query" class="border-0 rounded-l-sm w-full py-0 px-6 text-gray-700 leading-tight focus:outline-none " id="searchInput"
            type="text" placeholder="Search">
        <div class="p-2">
            <button id="searchButton" 
                class="bg-indig text-white rounded-full p-2 hover:bg-blue-400 focus:outline-none w-12 h-12 flex items-center justify-center">
                <svg class="w-4 h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
            </button>
        </div>
    
    </div>
</div>

<div class="flex flex-wrap overflow-auto w-100 justify-center" id="searchResults">

   @include('book_card', ['books' => $books])

</div>
@endsection