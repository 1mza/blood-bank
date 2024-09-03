<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('permission:categories-delete',['only' => ['destroy'] ]);
        $this->middleware('permission:categories-lists',['only' => ['index','show'] ]);
        $this->middleware('permission:categories-edit',['only' => ['edit','update'] ]);
        $this->middleware('permission:categories-create',['only' => ['create','store'] ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];
        $this->validate($request,$rules);
        $category = Category::create($request->all());
        flash()->success('Category created successfully.');
        return redirect()->route('categories.show',compact('category'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required',
        ];
        $this->validate($request,$rules);
        $category = Category::findOrFail($id);
        $category->update($request->all());
        flash()->success('Category updated successfully.');
        return redirect()->route('categories.show',compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        flash()->success('Category deleted successfully.');
        return redirect()->route('categories.index');
    }
}
