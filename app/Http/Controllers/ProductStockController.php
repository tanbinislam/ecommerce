<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Rules\CheckStock;
use App\Rules\Insertable;
use App\Rules\InsertIf;
use App\Rules\UniqueIf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductStockController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth', 'role:Admin']);
    }

    public function productStock($product_id)
    {
        $stock = ProductStock::where('product_id', $product_id)->get();
        return response()->json(['stock' => $stock]);
    }

    //store product Stock info
    public function storeStock(Request $request, $product_id)
    {
        $request->validate([
            'v_type_color' => ['string'],
            'v_type_size' => ['string'],
            'color.name' => [
                'required_if:v_type_color,on','string',
                // Rule::unique('product_stocks', 'color')
                // ->where('product_id', $product_id)
                // ->whereNull('size')
                // Rule::when(
                //     function($request, $product_id){
                //         return ProductStock::where('product_id', $product_id)->whereNull('size')->count() < 1;
                //     }, []
                // ),
            ],
            'color.qty' => [
                'exclude_if:v_type_size,on',
                Rule::when(
                    function($product_id){
                        return ProductStock::where('product_id', $product_id)->whereNull('size')->count() < 1;
                    }, ['numeric']
                ),
            ],
            'size' => [
                'required_if:v_type_size,on','array:xxl,xl,l,m,s',
            ],
            'size.*.size' => [
                'string',
                Rule::unique('product_stocks', 'size')
                ->where('product_id', $product_id)
                ->where('color', $request->color['name']),
                'regex:/(xxl|xl|l|m|s)/',
                //new InsertIf('product_stocks', 'product_id', $product_id, 'stock')
            ],
            'size.*.qty' => ['numeric','exclude_without:size.*.size'],
        ],
        [
            'color.name.required_if' => 'Color name is required!',
            'color.name.string' => 'Color name must be string!',
            'color.qty.exclude_if' => 'Additional sizes available!',
            'color.qty.numeric' => 'Quantity must be a number!',
            'size.required_if' => 'Additional size information required!',
            'size.array' => 'Invalid size input type!', 
            'size.*.qty.numeric' => 'Quantity must be a number!',
            'size.*.size.string' => 'Invalid data type!',
            'size.*.size.unique' => 'Duplicate Entry!',
            'size.*.size.regex' => 'Invalid data type!',
        ]);
        
        if(isset($request->v_type_color) && !isset($request->v_type_size)){
            ProductStock::create([
                'stock' => $request->color['qty'],
                'color' => $request->color['name'],
                'product_id' => $product_id,
            ]);
            return response()->json(['success' => 'Product stock by color added!']);
        }

        if(isset($request->v_type_color) && isset($request->v_type_size)){
            foreach($request->size as $size => $item){
                ProductStock::create([
                    'stock' => $item['qty'],
                    'size' => $item['size'],
                    'color' => $request->color['name'],
                    'product_id' => $product_id,
                ]);
            }
            return response()->json(['success' => 'Product stock with color & sizes added!']);
        }

        if(isset($request->v_type_size) && !isset($request->v_type_color)){
            foreach($request->size as $size => $item){
                ProductStock::create([
                    'stock' => $item['qty'],
                    'size' => $item['size'],
                    'product_id' => $product_id,
                ]);
            }
            return response()->json(['success' => 'Product stock with sizes added!']);
        }
    }

    public function storeGeneralStock(Request $request, $product_id)
    {
        $request->validate([
            'stock' => [
                'required','numeric', 
                new CheckStock('general', $product_id)
            ],
        ],[
            'stock.required' => 'Stock is required!',
            'stock.numeric' => 'Stock must be a number',
            'stock.when' => 'Duplicate Entry'
        ]);

        ProductStock::create([
            'stock' => $request->stock,
            'product_id' => $product_id
        ]);

        return response()->json(['success' => 'Product Stock Added!']);
    }

    public function storeColorStock(Request $request, $product_id)
    {
        $request->validate([
            'color.*.name' => [
                'required', 'string',
                 new CheckStock('color', $product_id), 
                 Rule::unique('product_stocks', 'color')
                 ->where('product_id', $product_id)
                ],
            'color.*.qty' => ['required', 'numeric'],
        ],[
            'color.*.name.required' => 'The color name is required.',
            'color.*.qty.required' => 'The color quantity is required.',
            'color.*.name.string' => 'The color name must be a string.',
            'color.*.qty.numeric' => 'The color quantity must be a number.',
        ]);

        foreach($request->color as $k => $val){
            ProductStock::create([
                'color' => $val['name'],
                'stock' => $val['qty'],
                'product_id' => $product_id
            ]);
        }

        return response()->json(['success' => 'Product Stock bu Colors Added!']);
    }

    public function storeSizeStock(Request $request, $product_id)
    {
        $request->validate([
            'size.*' => [
                'required', 'string', 
                new CheckStock('size', $product_id),
                Rule::unique('product_stocks', 'size')
                ->where('product_id', $product_id)
            ],
            'size.*.qty' => ['required', 'numeric'],
            
        ],[
            'size.*.required' => 'The size is required.',
            'size.*.string' => 'The size must be a string.',
            'size.*.qty.required' => 'The size quantity is required.',
            'size.*.qty.numeric' => 'The size quantity must be a number.',
        ]);

        foreach($request->size as $k => $val){
            ProductStock::create([
                'size' => $val,
                'stock' => $val['qty'],
                'product_id' => $product_id
            ]);
        }

        return response()->json(['success' => 'Product Stock by Sizes Added!']);
    }

    public function storeColorSizeStock(Request $request, $product_id)
    {
        // dd($request);
        $request->validate([
            'color.*.size' => ['array', Rule::in(['xxl', 'xl', 'l', 'm', 's'])],
            'color.*.name.title' => [
                'required', 'string', 
                new CheckStock('color_size', $product_id),
                Rule::unique('product_stocks', 'color')
                ->where('product_id', $product_id)
                ->where('size', 'xxl')
            ],
            'color.*.size.*' => ['required', 'numeric'],
        ],[
            'color.*.name.title.required' => 'The color name is required.',
            'color.*.size.*.required' => 'The color quantity is required.',
            'color.*.name.title.string' => 'The color name must be a string.',
            'color.*.size.*.numeric' => 'The color quantity must be a number.',
        ]);

        foreach($request->color as $k => $val){
            foreach($val['size'] as $size => $qty){
                ProductStock::create([
                    'color' => $val['name']['title'],
                    'size' => $size,
                    'stock' => $qty,
                    'product_id' => $product_id
                ]);
            }
        }

        return response()->json(['success' => 'Product Stock by Colors & Sizes Added!']);
    }


    public function test($product_id)
    {
        return ProductStock::where('product_id', $product_id)->where('size', 'xxl')->get();
    }
}
