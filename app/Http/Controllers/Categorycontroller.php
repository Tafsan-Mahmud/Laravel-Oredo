<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use Intervention\Image\ImageManagerStatic as Image;

class Categorycontroller extends Controller
{
    function new_category()
    {
        $categories = Category::all();
        return view('Admin.category.category', compact('categories'));
    }
    function store_new_category(Request $request)
    {
        $uploded_file = $request->cat_image;
        $request->validate([
            'cat_name' => 'required|unique:categories',
            'cat_image' => 'required',
            'cat_image' => 'mimes:png,jpg',
        ]);
        if ($uploded_file) {
            $cat_store_id = Category::insertGetId([
                "cat_name" => $request->cat_name,
                "created_at" => Carbon::now(),
            ]);
            $extension = $uploded_file->getClientOriginalExtension();
            $file_name =  Str::lower(str_replace(' ', '_', $request->cat_name)) . '_' . rand(100000000, 999999999) . '.' . $extension;
            Image::make($uploded_file)->resize(250, 250)->save(public_path('/uploads/categories/' . $file_name));
            Category::find($cat_store_id)->update([
                'cat_image' => $file_name,
            ]);

            return back()->with('cat_store', "category stored successfully");
        }
        return back()->with('cat_err', "Please Upload an image");
    }


    function delete_category($cat_id)
    {
        $cat_img = Category::where('id', $cat_id)->first()->cat_image;
        $delete_from = public_path('/uploads/categories/' . $cat_img);
        unlink($delete_from);
        Category::find($cat_id)->delete();
        return back()->with('cat_delete', 'Category Deleted Successfully');
    }
    function edit_category($cat_id)
    {
        $cat_data = Category::find($cat_id);
        return view('Admin.category.edit_cat', [
            'cat_data' => $cat_data
        ]);
    }
    function store_edited_category(Request $request)
    {
        $catID = $request->cat_id;

        if ($request->cat_image == '') {
            Category::find($catID)->update([
                'cat_name' => $request->cat_name,
            ]);
            return back()->with('editSuccess', 'Category Edited Succesfully');
        } else {

            $local_img = Category::where('id', $catID)->first()->cat_image;
            $deleted_from = public_path('/uploads/categories/' . $local_img);
            unlink($deleted_from);
            $uploded_file = $request->cat_image;
            $extension = $uploded_file->getClientOriginalExtension();
            $file_name = str::lower(str_replace(' ', '_', $request->cat_name)) . $catID . rand(1000000, 999999) . '.' . $extension;
            Image::make($uploded_file)->resize(250, 250)->save(public_path('/uploads/categories/' . $file_name));

            Category::find($catID)->update([
                'cat_name' => $request->cat_name,
                'cat_image' => $file_name,
            ]);
            return back()->with('editSuccess', 'Category Edited Succesfully');
        }
    }
}
