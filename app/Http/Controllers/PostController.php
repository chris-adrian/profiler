<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class PostController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       
    }

    public function create($id) {
    	$user = User::findOrFail($id);
    	return view('post/form', compact('user'));
    }

    public function store($id) {
    	$user = User::findOrFail($id);

    	$data = request()->validate([
    		'title' => ['required', 'string', 'max:255'],
    		'image' => ['required_without:description', 'image'],
    		'description' => ['required_without:image','nullable','string', 'max:255'],
    	]);

    	if (request()->has('image')) {
	    	$imagePath = request('image')->store('uploads/post', 'public');
	    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,800);
	    	$image->save();
    	}

    	$user->posts()->create([
    		'title' => $data['title'],
	     	'image' => request()->has('image') ? $imagePath :'',
    		'description' => request()->has('description') ? $data['description'] :'',
    	]);

    	// return redirect()->back()->with('success', 'Message Posted');
        return redirect()->action('ProfileController@index', $user->username)->with('success', 'Message Posted');
    }

    public function edit($id) {
    	$user = User::findOrFail($id);

    	$post = $user->posts()->where(['id' => request('post_id')])->first();
    	return view('post/form', ['user' => $user, 'post' => $post ]);
    }

    public function update($id) {
    	$user = User::findOrFail($id);
		$data = request()->validate([
			'post_id' => ['required'],
    		'title' => ['required', 'string', 'max:255'],
    		'image' => ['nullable','image'],
    		'description' => ['nullable','string', 'max:255'],
    	]);

    	if (request()->has('image')) {
	    	$imagePath = request('image')->store('uploads/post', 'public');
	    	$image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,800);
	    	$image->save();

	    	//Update image ahead
	    	$user->posts()->where(['id' => $data['post_id']])->update([
		     	'image' => request()->has('image') ? $imagePath :'',
	    	]);
    	}

    	$user->posts()->where(['id' => $data['post_id']])->update([
    		'title' => $data['title'],
    		'description' => request()->has('description') ? $data['description'] :'',
    	]);

    	return redirect()->action('ProfileController@index', $user->username)->with('success', 'Post Updated');

    }

    public function delete($id){
    	$user = User::findOrFail($id);
    	$data = request()->validate([
			'post_id' => ['required'],
    	]);
        
        if ($user->posts()->where(['id' => $data['post_id']])->first()) {
            $file = $user->posts()->where(['id' => $data['post_id']])->first()->image;
            if( isset($file) ) {
                if ($file !== '') {
                    if (!Storage::delete('public/'.$file)) {
                        return redirect()->action('ProfileController@index', $user->username)->with('fail', 'Failed to remove post');
                    }
                }
            } 
        }

        $user->posts()->where(['id' => $data['post_id']])->delete();
        return redirect()->action('ProfileController@index', $user->username)->with('success', 'Post Removed');
    }
}
