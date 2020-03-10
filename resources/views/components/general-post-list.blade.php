@foreach($posts as $post)
<div class="row justify-content-center pt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ $post->title }}
                @if($post->user_id == $user->id)
                <form action="post/{{$user->id}}/delete" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger float-right" name="" value="Delete">
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </form>
                <form action="post/{{$user->id}}/edit" method="post">
                    @csrf
                    <input type="submit" class="btn btn-primary float-right" name="" value="Update">
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                </form>
                @endif
            </div>

            <div class="card-body">
                @if($post->image)
                <div class="w-100 text-center">
                    <img src="storage/{{$post->image}}" class="image">
                </div>
                @endif

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

<div class="row">
    <div class="col-md-12">
        {{-- $posts->links() --}}
    </div>
</div>