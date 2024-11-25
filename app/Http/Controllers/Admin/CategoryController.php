<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
    
        // Check if there's a search query
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Paginate the categories
        $categories = $query->paginate(5); // Adjust the number of categories per page as needed
    
        return view('admin.categories.index', compact('categories'));
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
    
        // Sending SweetAlert message on success
        return redirect('admin/category')->with('successAdd', 'Category Added Successfully');
    }

    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('admin.categories.edit', compact('category'));
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

        // Sending SweetAlert message on success
        return redirect('admin/category')->with('successUpdate', 'Category Updated Successfully');
    }

    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);
    
        // Perform a soft delete
        $category->delete();
    
        // Sending SweetAlert message on success
        return redirect('admin/category')->with('successDelete', 'Category Deleted Successfully');
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