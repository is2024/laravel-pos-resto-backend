<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request){
        $products=  DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->select('products.*', 'categories.name as category_name' )
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('products.name', 'like', '%' . $name . '%');
        })
        ->orderBy('products.created_at', 'desc')
        ->paginate(10);
        return view('pages.products.index', compact('products'));

    }
    //create
    public function create(Request $request)
    {
        $categories = DB::table('categories')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->orderBy('updated_at', 'asc')
        ->paginate(10);
        return view('pages.products.create', compact('categories'));
    }

     //store
     public function store(Request $request)
     {
        $request->validate([
            'name' => 'required|min:3|unique:products',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required',
            'stock' => 'required|integer',
            'status' => 'required|boolean',
            'is_favorite' => 'required|boolean',
            'image' => 'required|image|mimes:png,jpg,jpeg'

        ]);

         //upload image
         $filename = time() . '.' . $request->image->extension();
         $request->image->storeAs('public/products', $filename);
         $data = $request->all();

         // $data = $request->all();
         $product = new \App\Models\Product;
         //$categories = new \App\Models\Category;
         $product->name = $request->name;
         $product->description = $request->description;
         $product->price = (int) $request->price;
         $product->stock = (int) $request->stock;
         $product->category_id = $request->category_id;
         $product->status = $request->status;
         $product->is_favorite = $request->is_favorite;
         $product->image = $filename;
         $product->save();

         return redirect()->route('products.index');
    }
    //edit
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('pages.products.edit', compact('product','categories'));
    }
    //update
    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);
	    $filename=$product->image;
        // check image
       if ($request->hasFile('image')) {
           $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
            $product['image'] = $filename;
       }

        $product->update ([
            'name' => $request->name,
            'price' => (int) $request->price,
            'stock' => (int) $request->stock,
            'category_id' => $request->category_id,
            'image' => $filename,
            'status' => $request->status,
            'is_favorite' => $request->is_favorite,
        ]);

        return redirect()->route('products.index')->with('success', 'Products successfully updated');
    }

   //destroy
   public function destroy($id)
   {
       $product = \App\Models\Product::findOrFail($id);
       $product->delete();
       return redirect()->route('products.index')->with('success', 'Products deleted successfully');
   }
}
