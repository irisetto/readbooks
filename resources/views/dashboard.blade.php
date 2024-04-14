@include('includes.navbar')
@vite(['resources/css/app.css','resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{{ csrf_token() }}}">

    <title>Books</title>

</head>
<body >

<div class="flex flex-wrap overflow-auto w-100 justify-center">
<?php

foreach (auth()->user()->books as $book) {
  
    ?>
    <div class="m-2 mb-8 px-2  sm:w-1/5 md:w-1/6 ">
      <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
        <img src=" {{$book->cover}}" alt="book cover" class="rounded-t-lg " />
        <div class="p-2 flex-grow">
          <h2 class="mb-2 text-md font-semibold">{{ $book->title }}</h2>
          @if ($book->author)
          <p class="mb-2 text-sm text-gray-700">Author: {{ $book->author }}</p>
          @endif
        </div>

      </div>
    </div>
    <?php

}
?>
</div>
</body>
</html>