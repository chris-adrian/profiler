<footer class="{{ Request::path() == '/' && !isset(Auth::user()->id) ? 'welcome' : '' }}">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 text-left">
                <h3>Relevant Links <i class="fa fa-link"></i></h3>
                @if( Auth::user())
                <div class="btn-group-vertical" role="group" >
                  <a href="/" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> General Post Feed</a>
                  <a href="/{{ Auth::user()->username }}" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Dashboard</a>
                  <a href="/post/{{ Auth::user()->id }}/create" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Create a post!</a>
                </div>
                @else
                <div class="btn-group-vertical" role="group" >
                  <a href="/register" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Sign Up!</a>
                  <a href="/login" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Account login</a>
                  <a href="/password/reset" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Forgot password?</a>
                  <a href="/" class="btn btn-secondary"><i class="fa fa-arrow-right"></i> Home</a>
                </div>
                @endif 
            </div>
            <div class="col-sm-6 col-md-4 text-center">
                <h3>Convincing Title  <i class="fa fa-exclamation-circle"></i></h3>
                <p>
                	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ultricies ipsum non felis aliquam ultricies. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut consectetur enim pellentesque odio congue, non porttitor diam hendrerit. Nullam lacinia ultrices nibh eu aliquet. 
                </p>
            </div>
            <div class="col-sm-12 col-md-4 text-right">
                <h3>Subscribe! <i class="fa fa-bell"></i> </h3>

                <form method="" action="">
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-8">
                            <input id="email" type="email" placeholder="sample@email.com" class="form-control" name="email" required autocomplete="email">
                            <small class="form-text text-muted">
                                Subscribe now to get notified !
                            </small>  
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <button type="submit" class="btn btn-primary">Notify <i class="fa fa-check"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                PROfiler, Copyright 2020
            </div>
        </div>
    </div>
</footer>