<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use UploadImageTrait;
    public function __construct(){
        $this->middleware('permission:posts-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:posts-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:posts-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:posts-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $rules = [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
            'category_id' => 'required',
        ];

        $this->validate($request, $rules);

        $path = $this->uploadImage($request->image, 'posts');
        $post = Post::create([
            'title' => $request->title,
            'detailed_title' => $request->detailed_title,
            'image' => $path,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);

        flash()->success('Post created successfully.');
        return redirect()->route('posts.show', compact('post'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ];
        $this->validate($request,$rules);
        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            $path = $this->uploadImage($request->file('image'), 'posts');
        } else {
            $path = $post->image;
        }
        $post->update([
            'title' => $request->title,
            'detailed_title' => $request->detailed_title,
            'image' => $path,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);
        flash()->success('Post updated successfully.');
        return redirect()->route('posts.show',compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        flash()->success('Post deleted successfully.');
        return redirect()->route('posts.index');
    }
}
