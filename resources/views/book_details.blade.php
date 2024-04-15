@extends('layouts.master')
@section('title', 'Book Details')
@vite(['resources/css/app.css', 'resources/js/app.js'])

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
                        <p>Published Date: {{ $book->publishedDate }}</p>
                    </div>

                    <div class="text-md mt-6 text-gray-700">
                        <p>Pages: {{ $book->pageCount }}</p>
                    </div>
                    <div class="text-md mt-6 text-gray-700">
                        <p>Categories: {{ $book->categories[0] }}</p>
                    </div>
                    <div class="text-md mt-6 text-gray-700">
                        <p>Language: {{ $book->language }}</p>
                    </div>
                    @if (isset($book->saleInfo->buyLink))
                    <div class="text-md mt-6 text-gray-700">
                        <p>Buy here:
                            <a href="{{ $book->saleInfo->buyLink }}">
                                {{ $book->saleInfo->buyLink }}
                            </a>
                        </p>
                    </div>
                    @endif
                </div>
                @auth
                    <div class="p-2 mb-0">
                        <form action="{{ route('books.addToList', ['book' => $book->id]) }}" method="POST"
                            class="flex justify-center mt-5">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                class="w-full rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600 mb-0
                                {{$book->added ? 'hidden' : '' }}">Add
                                to List</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
        <div class="px-5 ">
            <div class="font-serif mt-5 mb-8 text-gray-700">
                <p class="text-justify">{!! html_entity_decode($book->description) !!}</p>
            </div>
        </div>
    </div>
    <!-- Related Items Section -->
    <!--   <section class="mt-10 border-t border-gray-200 py-16 px-4 sm:px-0">
                  <h2 class="text-xl font-bold text-gray-900">Customers also bought</h2>
                  <div class="mt-8 grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-y-12 xl:gap-x-8 sm:gap-x-6">
                    <div class="relative">
                      <div class="w-full h-72 rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-01.jpg" alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls." class="h-full w-full object-cover object-center">
                      </div>
                      <div class="mt-4">
                        <h3 class="text-sm text-gray-900 font-medium">Zip Tote Basket</h3>
                        <p class="mt-1 text-sm text-gray-500">White and black</p>
                      </div>
                      <div class="absolute top-0 inset-x-0 h-72 flex justify-end items-end rounded-lg p-4 overflow-hidden">
                        <div class="absolute bottom-0 inset-x-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                        <p class="relative text-xl font-semibold text-white">$140</p>
                      </div>
                      <div class="mt-6">
                        <a href="#" class="flex items-center justify-center border border-transparent rounded-md bg-gray-100 hover:bg-gray-300 px-8 py-2 text-sm font-medium text-gray-900 ">Add to Bag</a>
                      </div>
                    </div>
                    <div class="relative">
                      <div class="w-full h-72 rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-02.jpg" alt="Front of zip tote bag with white canvas, blue canvas straps and handle, and front zipper pocket." class="h-full w-full object-cover object-center">
                      </div>
                      <div class="mt-4">
                        <h3 class="text-sm text-gray-900 font-medium">Zip High Wall Tote</h3>
                        <p class="mt-1 text-sm text-gray-500">White and blue</p>
                      </div>
                      <div class="absolute top-0 inset-x-0 h-72 flex justify-end items-end rounded-lg p-4 overflow-hidden">
                        <div class="absolute bottom-0 inset-x-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                        <p class="relative text-xl font-semibold text-white">$140</p>
                      </div>
                      <div class="mt-6">
                        <a href="#" class="flex items-center justify-center border border-transparent rounded-md bg-gray-100 hover:bg-gray-200 px-8 py-2 text-sm font-medium text-gray-900 ">Add to Bag</a>
                      </div>
                    </div>
                    <div class="relative">
                      <div class="w-full h-72 rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-03.jpg" alt="Front of tote with monochrome natural canvas body, straps, roll top, and handles." class="h-full w-full object-cover object-center">
                      </div>
                      <div class="mt-4">
                        <h3 class="text-sm text-gray-900 font-medium">Halfsize Tote</h3>
                        <p class="mt-1 text-sm text-gray-500">Clay</p>
                      </div>
                      <div class="absolute top-0 inset-x-0 h-72 flex justify-end items-end rounded-lg p-4 overflow-hidden">
                        <div class="absolute bottom-0 inset-x-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                        <p class="relative text-xl font-semibold text-white">$140</p>
                      </div>
                      <div class="mt-6">
                        <a href="#" class="flex items-center justify-center border border-transparent rounded-md bg-gray-100 hover:bg-gray-200 px-8 py-2 text-sm font-medium text-gray-900 ">Add to Bag</a>
                      </div>
                    </div>
                    <div class="relative">
                      <div class="w-full h-72 rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/product-page-03-related-product-04.jpg" alt="Front of zip tote bag with black canvas, black handles, and orange drawstring top." class="h-full w-full object-cover object-center">
                      </div>
                      <div class="mt-4">
                        <h3 class="text-sm text-gray-900 font-medium">High Wall Tote</h3>
                        <p class="mt-1 text-sm text-gray-500">Black and orange</p>
                      </div>
                      <div class="absolute top-0 inset-x-0 h-72 flex justify-end items-end rounded-lg p-4 overflow-hidden">
                        <div class="absolute bottom-0 inset-x-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
                        <p class="relative text-xl font-semibold text-white">$140</p>
                      </div>
                      <div class="mt-6">
                        <a href="#" class="flex items-center justify-center border border-transparent rounded-md bg-gray-100 hover:bg-gray-200 px-8 py-2 text-sm font-medium text-gray-900 ">Add to Bag</a>
                      </div>
                    </div>
                  </div>
                </section> -->

@endsection
