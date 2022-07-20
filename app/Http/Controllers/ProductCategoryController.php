<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'role:Admin']);
    }

    // show all categories
    public function allCategories()
    {
        $categories = ProductCategory::all();
        return view('admin.product.allCategories', compact('categories'));
    }

    // show add category form
    public function createCategory()
    {
        return view('admin.product.addCategory');
    }

    // save a category
    public function storeCategory(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', 'unique:product_categories'],
        ]);

        ProductCategory::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
        ]);

        session()->flash('success', 'Product Category Created!');
        return redirect(route('allProductCategories'));
    }

    // show edit form
    public function editCategory(ProductCategory $category)
    {
        return view('admin.product.editCategory', compact('category'));
    }

    //update category form
    public function updateCategory(Request $request, ProductCategory $category)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', 'unique:product_categories'],
        ]);

        $category->title = $request->title;
        $category->slug = Str::slug($request->title, '-');
        $category->save();

        session()->flash('success', 'Product Category Updated!');
        return redirect(route('allProductCategories'));
    }
}
