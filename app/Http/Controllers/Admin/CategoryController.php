<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function manage(){
        $categories = Category::all();
        return view('admin.category.manage', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories|max:100|min:5',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'featured_order' => 'nullable|integer|min:0'
        ]);

        $data = [
            'category_name' => $request->category_name,
            'is_featured' => $request->boolean('is_featured'),
            'featured_order' => $request->featured_order ?? 0
        ];

        if ($request->hasFile('category_image')) {
            $data['image_path'] = $request->file('category_image')->store('category-images', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories')->with('success', 'Category Added Successfully');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'category_name' => 'required|max:100|min:5|unique:categories,category_name,'.$id,
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'featured_order' => 'nullable|integer|min:0'
        ]);

        $data = [
            'category_name' => $request->category_name,
            'is_featured' => $request->boolean('is_featured'),
            'featured_order' => $request->featured_order ?? 0
        ];

        if ($request->hasFile('category_image')) {
            // Delete old image if exists
            if ($category->image_path && Storage::disk('public')->exists($category->image_path)) {
                Storage::disk('public')->delete($category->image_path);
            }
            
            $data['image_path'] = $request->file('category_image')->store('category-images', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories')->with('success', 'Category Updated Successfully');
    }

    public function destroy($id){
        $category = Category::findOrFail($id);
        
        // Delete the image if exists
        if ($category->image_path && Storage::disk('public')->exists($category->image_path)) {
            Storage::disk('public')->delete($category->image_path);
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }
}
