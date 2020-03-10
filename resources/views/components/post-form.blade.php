<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h2>@if($post !== '') Edit @else Create @endif Post</h2></div>

            <div class="card-body">
                <div class="row">
                    @if($post !== '')
                    <div class="col-sm-12 col-md-4">
                        @if($post->image)
                        <h3>Current Image :</h3>
                        <div class="w-100 text-center">
                            <img src="/storage/{{$post->image}}" class="image">
                        </div>
                        @else 
                        <h3 class="info">
                            <i class="fa fa-exclamation-circle"></i><br/>
                            No Image Avaiable
                        </h3>
                        @endif
                    </div>
                    @endif

                    <div class="@if($post !== '') col-sm-12 col-md-8 @else col-md-12 @endif">
                        <form method="POST" enctype="multipart/form-data" action="/post/{{$user->id}}/{{$post !== '' ?'update':'create'}}">
                            @csrf

                            @if($post !== '')
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            @method('patch')
                            @endif

                            <div class="form-group row">
                                <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('title') }}</label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $post->title ?? '' }}" autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('description') }}</label>

                                <div class="col-md-8">
                                    <!-- <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->description }}" autocomplete="description" autofocus> -->

                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus placeholder="Your message....">{{ old('description') ?? $post->description ?? '' }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <input type="submit" class="btn btn-primary" value="{{$post !== '' ?'Update':'Create'}}">
                            </div>

                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>