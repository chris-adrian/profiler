<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;

class MainController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index() {
    	if (Auth::user()) {
    		$user = User::findOrFail(Auth::user()->id);
            // $posts = Post::orderBy('created_at', 'desc')->get();
    		// return view('main', ['user' => $user, 'posts' => $posts]);
            return view('main', compact('user'));
    	} else {
    		return view('welcome');
    	}

    }

    public function posts(){
        if (Auth::user()) { 
            $posts = Post::orderBy('created_at', 'desc')->get();
            return response()->json($posts);
        }
    }

    public function getUser(){
        if (Auth::user()) { 
            $user = User::findOrFail(Auth::user()->id);
            return response()->json($user->id);
        }   
    }
}
