<?php

namespace Dronila\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dronila\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'product_image' => 'image|nullable|max:1999'

        ]);
                // Handle File Upload
        if($request->hasFile('product_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('product_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('product_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        // Create Post
        $post = new Product;
        $post->name = $request->input('name');
        $post->description = $request->input('description');
        $post->user_id = auth()->user()->id;
        $post->product_image = $fileNameToStore;
        $post->save();

        return redirect('/adminproduct')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.detail')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);


        // Check for the right user
        if (auth()->user()->id !== $product->user_id) {

            return redirect('/adminproduct')->with('error', 'Unauthorizied Page');

        }
        return view('admin.product.edit')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
           

        ]);

        //Handle file upload
        if ($request->hasFile('product_image')) {

            // Get File name with the extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('product_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore= $fileName.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore);
            
        }
        //Create Post
        $product = Product::find($id);
        if($request->hasFile('product_image')){
            $product->product_image = $fileNameToStore;
        }
        $product ->name = $request->input('name');
        $product ->description = $request->input('description');

        $product->save();
        return redirect('/adminproduct')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        // Check for the right user
        if (auth()->user()->id !== $product->user_id) {

            return redirect('/adminproduct')->with('error', 'Unauthorizied Page');

        }

        if ($product->product_image != 'noimage.jpg') {
            //Delete image
            Storage::delete(['public/product_images'.$product->product_image]);
        }

        $product -> delete();
        return redirect('/adminproduct')->with('success','Post Deleted');
    }
}
