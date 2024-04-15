@foreach ($books as $book) 
    <div class="m-1 mb-8 px-1  sm:w-1/6 md:w-1/7 ">
      <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
        <a href = "{{ route('book.details', ['book' => $book->id]) }}" class="">
          @if($book->getCover())
      <img src="{{$book->getCover()}}" alt="book cover" class="rounded-t-lg w-full" />
      @else
      <img src="{{ asset('pictures/no_cover.jpg') }}" alt="book cover" class="rounded-t-lg w-full" />
      @endif
      </a>
      <div class="p-2 flex-grow">
          <h2 class="mb-2 text-md font-semibold break-words">{{ $book->title }}</h2>
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
@endforeach