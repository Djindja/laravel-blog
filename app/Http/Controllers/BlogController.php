<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getSingle($slug) {
        // fetch from the DB based on slug
        $post = Post::where('slug', '=', $slug)->get();
        

        // return the view and pass in the post object
    }
}
