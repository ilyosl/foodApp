<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.categories.index');
    }
    public function create() {
        return view('admin.categories.create');
    }
    public function store(CategoryFormRequest $request){

        $validatedData = $request->validated();

        $category = new Category();

        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->desc = $validatedData['desc'];
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cat_'.time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keywords = $validatedData['meta_keywords'];
        $category->meta_desc = $validatedData['meta_desc'];

        $category->status = $request->status == true ? 1: 0;

        $category->save();

        return redirect('admin/category')->with('message', 'Category is added successfully');
    }
    public function edit(Category $category) {
        return view('admin.categories.edit', compact('category'));
    }
    public function update(CategoryFormRequest $request, $category){

        $validatedData = $request->validated();

        $category = Category::findOrFail($category);


        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['name']);
        $category->desc = $validatedData['desc'];
        if($request->hasFile('image')){
            $delPath = 'uploads/category/'.$category->image;
            if(File::exists($delPath)){
                File::delete($delPath);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = 'cat_'.time().'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }

        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keywords = $validatedData['meta_keywords'];
        $category->meta_desc = $validatedData['meta_desc'];

        $category->status = $request->status == true ? 1: 0;

        $category->update();

        return redirect('admin/category')->with('message', 'Category is updated successfully');

    }
}
