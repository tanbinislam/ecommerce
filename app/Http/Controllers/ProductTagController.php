<?php

namespace App\Http\Controllers;

use App\Models\ProductTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductTagController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'role:Admin']);
    }

    // show all tags
    public function allTags()
    {
        $tags = ProductTag::all();
        return view('admin.product.allTags', compact('tags'));
    }

    // show add Tag form
    public function createTag()
    {
        return view('admin.product.addTag');
    }

    // save a Tag
    public function storeTag(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:30', 'unique:product_tags'],
        ]);

        ProductTag::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
        ]);

        session()->flash('success', 'Product Tag Created!');
        return redirect(route('allProductTags'));
    }

    // show edit form
    public function editTag(ProductTag $tag)
    {
        return view('admin.product.editTag', compact('tag'));
    }

    //update Tag form
    public function updateTag(Request $request, ProductTag $tag)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:30', 'unique:product_tags'],
        ]);

        $tag->title = $request->title;
        $tag->slug = Str::slug($request->title, '-');
        $tag->save();

        session()->flash('success', 'Product Tag Updated!');
        return redirect(route('allProductTags'));
    }
}
