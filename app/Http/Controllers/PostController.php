<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function add_new_post (){
        $categories = Category::all();
        $tags = Tag::all();
        return view('Admin.PostManagement.add_new_post',[
            'categories'=> $categories,
            'tags'=> $tags,
        ]);
    }
    function store_post (Request $request){
        print_r($request->all());
    }
}
