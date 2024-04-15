<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //index
    public function index(Request $request)
    {
        //get categories with pagination
        $categories = DB::table('categories')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        return view('pages.categories.index', compact('categories'));
    }

    //create
    public function create()
    {
        return view('pages.categories.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/categories', $filename);
        $data = $request->all();

        $categories = new \App\Models\Category;
        $categories->name = $request->name;
        $categories->description = $request->description;
        $categories->image = $filename;
        $categories->save();
        return redirect()->route('categories.index')->with('success', 'Category successfully created');
    }

    //edit
    public function edit($id)
    {
        $categories = \App\Models\Category::findOrFail($id);
        return view('pages.categories.edit', compact('categories'));
    }


    //update
    public function update(Request $request, $id)
    {
        $categories = \App\Models\Category::findOrFail($id);
	    $filename=$categories->image;
        // check image
       if ($request->hasFile('image')) {
           $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/categories', $filename);
            $categories['image'] = $filename;
       }

        $categories->update ([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,

        ]);

        return redirect()->route('categories.index')->with('success', 'Category successfully updated');
    }

    //destroy
    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category successfully deleted');
    }
}

