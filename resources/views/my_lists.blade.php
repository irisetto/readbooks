@if(Auth::user()->user_lists)
    <h2>Listele tale:</h2>
    <ul>
        @foreach(Auth::user()->user_lists as $list)
            <li class="list-item" data-list-id="{{ $list->id }}">{{ $list->name }}</li>
        @endforeach
    </ul>
@else
    <p>Nu aveti nicio lista.</p>
@endif
