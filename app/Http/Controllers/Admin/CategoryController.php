<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Retrieve all categories, including soft-deleted ones
        $category = Category::all();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();

        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];

        if ($request->hasFile('image')) {
            $category->image = $this->uploadImage($request->file('image'));
        }

        $category->save();

        return redirect('admin/category')->with('message', 'Category Added Successfully');
    }

    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request->validated();
        $category = Category::findOrFail($category_id);

        $category->name = $data['name'];
        $category->description = $data['description'];

        if ($request->hasFile('image')) {
            $this->deleteImage($category->image);
            $category->image = $this->uploadImage($request->file('image'));
        }

        $category->save();

        return redirect('admin/category')->with('message', 'Category Updated Successfully');
    }

    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
    
        // Perform a soft delete
        $category->delete();
    
        return redirect('admin/category')->with('message', 'Category Deleted Successfully');
    }
    

    private function uploadImage($file)
    {
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/category/'), $filename);
        return $filename;
    }

    private function deleteImage($image)
    {
        $path = public_path('uploads/category/' . $image);
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}