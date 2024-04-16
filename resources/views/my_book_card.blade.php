@if (!isset($books) || $books==null)
<p class="text-center text-2xl ">No books in your library :( </p>
@else
@foreach ($books as $book)
    <div class="flex m-1 mt-5 px-1  sm:w-1/4 md:w-1/5 lg:w-1/6 ">
        <div class="rounded-lg bg-white shadow-lg  flex flex-col flex-grow">
            <a href = "{{ route('book.details', ['book' => $book->id]) }}">
                @if ($book->getCover())
                    <img src="{{ $book->getCover() }}" alt="book cover" class="rounded-t-lg w-full" />
                @else
                    <img src="{{ asset('pictures/no_cover.jpg') }}" alt="book cover"
                        class="rounded-t-lg w-full" />
                @endif
            </a>
            <div class="p-2 flex-grow">
                <h2 class="mb-2 text-md font-semibold break-words">{{ $book->title }}</h2>
                @if ($book->authors)
                    <p class="mb-2 text-sm text-gray-700">Author: {{ $book->authors[0] }}</p>
                @endif
                <p class="mb-4 text-sm text-gray-700">Published: {{ $book->publishedDate }}</p>
            </div>
            <div class="p-2 mt-auto">
                <form action="{{ route('books.deleteBook', ['book' => $book->id]) }}" method="POST"
                    class="flex justify-center">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this book?')"
                        class="block rounded-lg bg-red-500 px-4 py-2 text-center font-semibold text-white hover:px-7 mt-auto">x</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endif