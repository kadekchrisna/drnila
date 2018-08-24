<?php

namespace Dronila\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dronila\Post;
use DB;

class PostsController extends Controller
{

    /**

     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['showPost']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('created_at', 'desc')->take(1)->get();
        //return Post::where('title', 'Post One')->get();
        //$posts = DB::select('select * from posts ');
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);



        //$posts = Post::orderBy('created_at', 'desc')->get();



        //return view('beranda')->with('posts',$posts);
        return view('admin.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'

        ]);
                // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/homeadmindronila')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.detail')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);


        // Check for the right user
        if (auth()->user()->id !== $post->user_id) {

            return redirect('/')->with('error', 'Unauthorizied Page');

        }
        return view('admin.edit')->with('post',$post);
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
            'title' => 'required',
            'body' => 'required',
           

        ]);

        //Handle file upload
        if ($request->hasFile('cover_image')) {

            // Get File name with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore= $fileName.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            
        }
        //Create Post
        $post = Post::find($id);
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        }
        $post ->title = $request->input('title');
        $post ->body = $request->input('body');

        $post->save();
        return redirect('/adminpost')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // Check for the right user
        if (auth()->user()->id !== $post->user_id) {

            return redirect('/posts')->with('error', 'Unauthorizied Page');

        }

        if ($post->cover_image != 'noimage.jpg') {
            //Delete image
            Storage::delete(['public/cover_images'.$post->cover_image]);
        }

        $post -> delete();
        return redirect('/posts')->with('success','Post Deleted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPost($id)
    {
        $post = Post::find($id);
        return view('isipost')->with('post',$post);
    }
}
