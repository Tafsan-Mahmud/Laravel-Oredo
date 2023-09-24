<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class Tagcontroller extends Controller
{
    function tag (){
        $tag_data = Tag::all();
        return view('Admin.Tags.tag',[
            'tag_data' => $tag_data
        ]);
    }

    function store_new_tag (Request $request){
        $request->validate([
            'tag_name' => 'required |unique:tags'
        ],[
            // 'tag_name.required' =>"kicu to lekh vai"
        ]);

        Tag::insert([
            'tag_name' => $request->tag_name
        ]);
        return back()->with('tagSuccess' , 'New - Tag Added Successfully');
    }
    function delete_tag ($tag_id){
        Tag::find($tag_id)->delete();
        return back()->with('tagdel' , 'Tag - Deleted Successfully');
    }

}
