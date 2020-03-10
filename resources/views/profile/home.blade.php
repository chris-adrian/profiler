@extends('layouts.app')

@section('content')
<div id="profile-home" class="container">
    
    @component('components.message')
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Dashboard</h1></div>
            </div>

            <div class="card card-body">
                <div class="row">
                    <div class="col-md-9">
                        @component('components.post-form', ['user' => $user, 'post' => ''])
                        @endcomponent
                        
                        @component('components.post-list', compact('user'))
                        @endcomponent
                    </div>

                    <div class="col-md-3">
                        <div class="card side-bar">
                            <div class="card-header"><h2>Menu</h2></div>
                            <div class="card-body">
                                <div class="btn-group-vertical" role="group" >
                                  <button type="button" class="btn btn-secondary">Action button 1</button>
                                  <button type="button" class="btn btn-secondary">Action button 2</button>
                                  <button type="button" class="btn btn-secondary">Action button 3</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
