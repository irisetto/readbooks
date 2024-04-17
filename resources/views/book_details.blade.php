@extends('layouts.master')
@section('title', 'Book Details')
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/addToList.js'])

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row -mx-4 ">

            <!-- Images-Section -->
            <div class="md:flex-1 py-5 px-5 ">
                <div class="w-80 object-cover object-center rounded-lg border border-gray-200 mx-auto">
                    @if($book->getCover())
                    <img src="{{$book->getCover()}}" alt="book cover" class="rounded-lg w-full" />
                    @else
                    <img src="{{ asset('pictures/no_cover.jpg') }}" alt="book cover" class="rounded-lg w-full" />
                    @endif
                </div>
            </div>

            <!-- Description-Section -->
            <div class = "md:flex-1 py-5 px-5 flex flex-col justify-between">
                <div class=" w-full  lg:py-4  mx-auto r">
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">{{ $book->title }}</h1>
                    <div class="py-3">
                        @if ($book->authors)
                            <p class="text-2xl text-gray-900 tracking-tight">{{ $book->authors[0] }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="text-md mt-3 text-gray-700">
                      @if ($book->publishedDate)
                        <p>Published Date: {{ $book->publishedDate }}</p>
                      @endif
                    </div>

                    <div class="text-md mt-6 text-gray-700">
                      @if ($book->pageCount)
                        <p>Pages: {{ $book->pageCount }}</p>
                        @endif
                    </div>
                    <div class="text-md mt-6 text-gray-700">
                      @if ($book->categories)
                        <p>Categories: {{ $book->categories[0] }}</p>
                      @endif
                    </div>
                    <div class="text-md mt-6 text-gray-700">
                      @if ($book->language)
                        <p>Language: {{ $book->language }}</p>
                      @endif
                    </div>
                    @if (isset($book->saleInfo->buyLink))
                    <div class="text-md mt-6 text-gray-700">
                      @if ($book->saleInfo->buyLink)
                        <p>Buy here:
                            <a href="{{ $book->saleInfo->buyLink }}">
                                {{ $book->saleInfo->buyLink }}
                            </a>
                        </p>
                      @endif
                    </div>
                    @endif
                </div>
              
                @auth  
                <div id="notification" class="flex justify-center">
                </div>
                <div class="flex justify-center p-2 mb-0">           
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
        <div class="px-5 ">
            <div class="font-serif mt-5 mb-8 text-gray-700">
              @if ($book->description)
                <p class="text-justify">{!! html_entity_decode($book->description) !!}</p>
              @endif
            </div>
        </div>
    </div>
@endsection
