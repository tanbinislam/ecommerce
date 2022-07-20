<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image; 


class ProductController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'role:Admin']);
    }

    // view all products
    public function allProducts()
    {
        $products = Product::orderBy('id', 'DESC')->where('draft', 0)->with('categories')->get();
        return view('admin.product.all', compact('products'));
    }

    // show add product form
    public function createProduct()
    {
        return view('admin.product.add');
    }

    // store new product
    public function storeProduct(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['numeric'],
            'categories' => ['required', 'array'],
            'categories.*' => ['numeric'],
            'tags' => ['required','array'],
            'tags.*' => ['numeric'],
        ]);

        $p_slug = 'PD'.Str::random(9);
        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'draft' => 1,
            'product_slug' => $p_slug,
        ]);
        
        $product->tags()->attach($request->tags);
        $product->categories()->attach($request->categories);

        return response()->json(
            [
                'success' => 'Product Created',
                'product_id' => $product->id
            ]
        );
    }

    // view a single product
    public function viewProduct(Product $product)
    {
        return view('admin.product.view', compact('product'));
    }

    // sdow edit product form
    public function editProduct(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    // update a product information
    public function updateProduct(Product $product, Request $request)
    {
        //dd($request->preloaded);
        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'discount' => ['numeric'],
            'stock' => ['required', 'numeric'],
            'categories' => ['required', 'array'],
            'categories.*' => ['numeric'],
            'draft' => ['boolean'],
            'images' => ['required', 'array'],
            'images.*' => ['mimes:jpg,jpeg,png'],
            'tags' => ['required','array'],
            'tags.*' => ['numeric'],
        ]);

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->stock = $request->stock;
            $product->draft = $request->draft;
            $product->images = json_encode($this->updateImages($request, $product), JSON_FORCE_OBJECT);
            $product->save();

            $product->tags()->sync($request->tags);
            $product->categories()->sync($request->categories);

        session()->flash('success', 'Product Updated!');
        return redirect(route('viewProduct', ['product' => $product]));
    }

    // view all drafted products
    public function draftedProducts()
    {
        $products = Product::where('draft', 1)->with('categories')->get();
        return view('admin.product.draft', compact('products'));
    }

    // view all deleted products
    public function trashedProducts()
    {
        $products = Product::onlyTrashed()->with('categories')->get();
        return view('admin.product.trash', compact('products'));
    }

    // soft delete a product
    public function deleteProduct(Product $product)
    {
        $product->delete();
        session()->flash('success', 'Product Deleted!');
        return redirect(route('allProducts'));
    }

    // restore soft deleted product
    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->restore();
        session()->flash('success', 'Product Restored!');
        return redirect(route('allProducts'));
    }

    // permanently delete a product
    public function permanentDeleteProduct($id)
    {
        $product = Product::onlyTrashed()->find($id);
        $product->tags()->detach($product->tags->pluck('id'));
        $product->categories()->detach($product->categories->pluck('id'));
        $images = json_decode($product->images, true);
        foreach($images as $k =>$image)
        {
            unlink(public_path('images/product-images/'.$image));
        }
        $product->forceDelete();
        session()->flash('success', 'Product Permanently Deleted!');
        return redirect(route('allProducts'));
    }

    //process images and store
    private function storeImages($request, $slug)
    {
        $imgName =[];
        foreach($request->file('images') as $k => $imgFile)
        {
            $name = 'PIMG-'.$slug.'-'.Str::random(5).'.'.$imgFile->getClientOriginalExtension();
            $canvas  = Image::canvas(800, 800, '#ffffff'); 
            $wm = Image::make(public_path('images/watermark.png'))->resize(150, null, function($a){
                $a->aspectRatio();
            });
            $img = Image::make($imgFile)->resize(null, 770, function($ar){
                $ar->aspectRatio();
            })->insert($wm, 'bottom-right', 15, 15);
            $canvas->insert($img, 'center')->save('images/product-images/'.$name);
            $imgName[$k] = $name;
        };

        return $imgName;
    }

    //update images from database and folders
    private function updateImages($request, $product)
    {
        $stored_images = json_decode($product->images, true);
        $deleted_images = array_diff(array_keys($stored_images), $request->preloaded);
        $imageNames = $stored_images;
        if(!empty($deleted_images))
        {
            foreach($deleted_images as $image)
            {
                unlink(public_path('images/product-images/'.$stored_images[$image]));
                unset($stored_images[$image]);
            }
            $imageNames = array_values($stored_images);
        }

        if($request->hasFile('images')){
            $newNames = $this->storeImages($request, $product->product_slug);
            $imageNames = array_merge(array_values($stored_images),array_values($newNames));
        }

        return $imageNames;
    }

}

