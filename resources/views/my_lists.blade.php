@if(Auth::user()->user_lists)
    <ul class="flex flex-col items-center">
        @foreach(Auth::user()->user_lists as $list)
            <li class="cursor-pointer list-item text-xl text-center my-4 p-3 bg-white rounded-md drop-shadow-md w-5/6 hover:bg-indig" data-list-id="{{ $list->id }}">{{ $list->name }}</li>
        @endforeach
    </ul>
@else
    <p>Nu aveti nicio lista.</p>
@endif
