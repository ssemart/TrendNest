<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.sub_category.create', compact('categories'));
    }

    public function manage(){
        $subcategories = Subcategory::with('category')->get();
        return view('admin.sub_category.manage', compact('subcategories'));
    }

    public function store(Request $request){
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories|max:100|min:5',
            'category_id' => 'required|exists:categories,id'
        ]);

        Subcategory::create($request->only(['subcategory_name', 'category_id']));

        return redirect()->route('admin.subcategories')->with('success', 'Subcategory created successfully');
    }

    public function edit($id){
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.sub_category.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id){
        $subcategory = Subcategory::findOrFail($id);
        
        $request->validate([
            'subcategory_name' => 'required|max:100|min:5|unique:subcategories,subcategory_name,'.$id,
            'category_id' => 'required|exists:categories,id'
        ]);

        $subcategory->update($request->only(['subcategory_name', 'category_id']));

        return redirect()->route('admin.subcategories')->with('success', 'Subcategory updated successfully');
    }

    public function destroy($id){
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        
        return redirect()->route('admin.subcategories')->with('success', 'Subcategory deleted successfully');
    }
}
