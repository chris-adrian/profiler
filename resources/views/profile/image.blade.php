@extends('layouts.app')

@section('content')
<div class="container">

    @component('components.message')
    @endcomponent
    
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><h1>My Profile Image</h1></div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/profile/{{$user->id}}/image">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
