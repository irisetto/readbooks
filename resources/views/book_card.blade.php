@foreach ($books as $book) 
    <div class="m-1 mb-8 px-1   sm:w-1/4 md:w-1/5 lg:w-1/6  ">
      <div class="rounded-lg bg-white shadow-lg  flex flex-col h-full">
        <a href = "{{ route('book.details', ['book' => $book->id]) }}" class="">
          @if($book->getCover('thumbnail'))
      <img src="{{$book->getCover('thumbnail')}}" alt="book cover" class="rounded-t-lg w-full" />
      @else
      <img src="{{ asset('pictures/no_cover.jpg') }}" alt="book cover" class="rounded-t-lg w-full" />
      @endif
      </a>
      <div class="p-2 flex-grow">
          <h2 class="mb-2 text-md font-semibold break-words">{{ $book->title }}</h2>
          @if ($book->authors)
          <p class="mb-2 text-sm text-gray-700">Author: {{ $book->authors[0] }}</p>
          @endif
          <p class="mb-4 text-sm text-gray-700">Published: {{ $book->publishedDate }}</p>
        </div>
        @auth  
        {{-- <form action="{{ route('books.addToList', ['book' => $book->id]) }}" method="POST" class="flex justify-center">
            @csrf
            @method('POST')
            <button type="submit"
            class="block rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600 mt-auto"
            >Add to List</button>
        </form> --}}
      <div class="flex justify-center p-2">           
          <div  class="dropdown inline-block relative">
         
          <button
          class="btn block rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600 mt-auto text-center inline-flex items-center"
          >Add to List
          <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
          </button>
    
          <ul class="dropdown-menu absolute hidden w-full text-gray-700 pt-1">
            @foreach($userLists as $list)
            <li class="">
              <a class="add-to-list bg-gray-200 hover:bg-gray-300 py-2 px-4 block whitespace-no-wrap" href="#" 
              data-book-id="{{ $book->id }}"
               data-list-id="{{ $list->id }}">
                {{$list->name}}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
        
  </div>
        @endauth
      </div>
    </div>
@endforeach