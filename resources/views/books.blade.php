@include('includes.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Books</title>
    @vite(['resources/css/app.css','resources/js/app.js','resources/js/searchBooks.js'])

</head>
<body >
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
<?php

foreach ($books as $book) {
  
    ?>
    <div class="m-2 mb-8 px-2  sm:w-1/5 md:w-1/6 ">
      <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
        <img src="{{$book->getCover('thumbnail')}}" alt="book cover" class="rounded-t-lg " />
        <div class="p-2 flex-grow">
          <h2 class="mb-2 text-md font-semibold">{{ $book->title }}</h2>
          @if ($book->authors)
          <p class="mb-2 text-sm text-gray-700">Author: {{ $book->authors[0] }}</p>
          @endif
          <p class="mb-4 text-sm text-gray-700">Data publicării: {{ $book->publishedDate }}</p>
        </div>
        @auth  
        <div class="p-2 mt-auto">
        <form action="{{ route('books.addToList', ['book' => $book->id]) }}" method="POST" class="flex justify-center">
            @csrf
            @method('POST')
            <button type="submit"
            class="block rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600 mt-auto"
            >Add to List</button>
        </form>
          </div>  
        @endauth
      </div>
    </div>
    <?php

}
?>
</div>
</body>
</html>