
@extends('layouts.app')

@section('content')
<div id="main" class="container">
    
    <div class="row justify-content-center">
        <div id="posts" class="col-md-12">
        </div>
    </div>
  	
  	@component('components.message')
    @endcomponent

    {{--
    @component('components.general-post-list', ['user' => $user, 'posts' => $posts])
    @endcomponent
    --}}
</div>
@endsection

