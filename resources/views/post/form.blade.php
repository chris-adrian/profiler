@extends('layouts.app')

@section('content')
<div class="container">

    @component('components.message')
    @endcomponent

    @if(isset($post))
	    @component('components.post-form', ['user' => $user, 'post' => $post])
	    @endcomponent
    @else
    	@component('components.post-form', ['user' => $user, 'post' => ''])
	    @endcomponent
	@endif
</div>
@endsection
