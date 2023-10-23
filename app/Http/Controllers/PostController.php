<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

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
        $request->validate([
            'tittle' => 'required',
            'desp' => 'required',
            'post_image' => 'required',
            'category_id' => 'required',
            'tags_id' => 'required',
        ]);
        $after_implode_tags_id = implode(',' , $request->tags_id);
        $author = Auth::user();
        $uploded_file = $request->post_image;
        $extension = $uploded_file->getClientOriginalExtension();
        $file_name = Str::lower(str_replace(' ','_',$author->name)).'_'.$author->id.'_'.rand(100000000,  999999999).'.'. $extension;
        Image::make($uploded_file)->save(public_path('/uploads/posts/'.$file_name));

        Post::insert([
        'author_id'=>Auth::id(),
        'category_id'=>$request->category_id,
        'tags_id'=>$after_implode_tags_id,
        'tittle'=>$request->tittle,
        'desp'=>$request->desp,
        'post_image'=>$file_name,
        'slug'=>Str::lower(str_replace(' ','_', $request->tittle)).'_'.rand(100000000,999999999),
       ]);
       return back();
    }
}
