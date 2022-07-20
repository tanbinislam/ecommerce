<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class ProductImageController extends Controller
{
    /** Dimentions For Product Image
     *  size XL
     *  type array
     */
    protected $image_xl = [
        'canvas_width' => 1000,
        'canvas_height' => 1000,
        'image_width' => 950,
        'image_height' => 950,
        'image_position' => 'center',
        'logo_width' => 150,
        'logo_height'  => null,
        'logo_position' => 'bottom-right',
        'logo_offset_x' => 15,
        'logo_offset_y' => 15,
    ];

    /** Dimentions For Product Image
     *  size SM
     *  type array
     */
    protected $image_sm = [
        'canvas_width' => 470,
        'canvas_height' => 522,
        'image_width' => 445,
        'image_height' => 497,
        'image_position' => 'center',
        'logo_width' => 75,
        'logo_height'  => null,
        'logo_position' => 'bottom-right',
        'logo_offset_x' => 7,
        'logo_offset_y' => 7,
    ];

    /** 
     * Constructor function For Product Images 
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    /** Store Product Images
     *  return json respomse
     *  for dropzone file uploader
     */
    public function storeProductImage(Request $request, $product_id)
    {
        $request->validate([
            'images' => ['required', 'mimes:jpg,jpeg,png']
        ]);
        
        $product = Product::findOrFail($product_id);
        $image_name = 'PIMG-'.$product->product_slug.'-'.Str::random(5).'.'.$request->file('images')->getClientOriginalExtension();

        $this->processImage($request->file('images'), $image_name, $this->image_xl, 'images/product-images/xl/');
        $this->processImage($request->file('images'), $image_name, $this->image_sm, 'images/product-images/sm/');

        ProductImage::create([
            'image' => $image_name,
            'product_id' => $product_id
        ]);

        return response()->json(['success' => 'Upload Success']);
    }

    /** 
     * Delete Product Images
     */
    public function deleteProductImage(ProductImage $image)
    {
        unlink(public_path('images/product-images/xl/'.$image->image));
        unlink(public_path('images/product-images/sm/'.$image->image));
        $image->delete();
        return response()->json(['success' => 'Product Image Removed']);
    }

    protected function processImage($image, $name, $properties, $path)
    {
        Image::canvas(
            $properties['canvas_width'],
            $properties['canvas_height'],
            '#ffffff')
            ->insert(Image::make($image)
                ->resize(
                    $properties['image_width'],
                    $properties['image_height'],
                    function($a){
                        $a->aspectRatio();
                        $a->upsize();
                    }
                ),
                $properties['image_position'])
            ->insert(Image::make(public_path('images/watermark.png'))
                ->resize(
                    $properties['logo_width'],
                    $properties['logo_height'],
                    function($a){
                        $a->aspectRatio();
                    }),
                    $properties['logo_position'],
                    $properties['logo_offset_x'],
                    $properties['logo_offset_y']
                    )
            ->save($path.$name);
    }
}
