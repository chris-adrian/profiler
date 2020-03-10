@if (session()->has('success'))
    <div class="alert alert-success">
        @if(is_array(session()->get('success')))
        <ul>
            @foreach (session()->get('success') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
            {{ session()->get('success') }}
        @endif
    </div>

@elseif (session()->has('fail'))
    <div class="alert alert-danger">
        @if(is_array(session()->get('fail')))
        <ul>
            @foreach (session()->get('fail') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        @else
            {{ session()->get('fail') }}
        @endif
    </div>
@else

@endif