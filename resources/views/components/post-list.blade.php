
@if(count($user->posts) > 0) 

@foreach($user->posts as $post)
<div class="row justify-content-center pt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                
                <form action="post/{{$user->id}}/delete" method="post">
                    @csrf
                    @method('delete')
                    <button type="button" class="btn verify-action float-right" action="delete post"><i class="fa fa-trash"></i></button>
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </form>
                <form action="post/{{$user->id}}/edit" method="post">
                    @csrf
                    <button type="submit" class="btn float-right"><i class="fa fa-edit"></i></button>
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </form>
            </div>

            <div class="card-body post-content">
                @if($post->image)
                <div class="w-100 text-center">
                    <img src="storage/{{$post->image}}" class="image">
                </div>
                <br/>
                @endif
                <h2>{{ $post->title }}</h2>
                @if($post->description)
                    <blockquote>
                        {{$post->description}}
                    </blockquote>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach

@else
<div class="row justify-content-center pt-4">
    <div class="col-md-12">
        <p class="placeholder-message">No post to display, create one above.</p>
    </div>
</div>
@endif