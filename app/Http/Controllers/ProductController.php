<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category')->latest()->paginate(7);
        return view('pages.admin.products', compact('products'));
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('pages.admin.products-create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required|string|unique:products,SKU',
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product = new Product();

        // Fill product info
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured ?? false;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Handle single image
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        // Handle multiple images
        if ($request->hasFile('images')) {
            $gallery = [];
            foreach ($request->file('images') as $img) {
                $name = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('uploads/products'), $name);
                $gallery[] = $name;
            }
            $product->images = json_encode($gallery);
        }

        $product->save();
        flash()->success('Product created successfully!');
        return redirect()->route('admin.product');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        return view('pages.admin.products-edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required|string|unique:products,SKU,' . $id,
            'stock_status' => 'required|in:instock,outofstock',
            'featured' => 'nullable|boolean',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
        ]);

        $product = Product::findOrFail($id);

        // Fill product info
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured ?? false;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Handle single image update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
                File::delete(public_path('uploads/products/' . $product->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName;
        }

        // Handle multiple images update
        if ($request->hasFile('images')) {
            // Delete old gallery images
            if ($product->images) {
                $oldImages = json_decode($product->images, true);
                foreach ($oldImages as $oldImg) {
                    if (File::exists(public_path('uploads/products/' . $oldImg))) {
                        File::delete(public_path('uploads/products/' . $oldImg));
                    }
                }
            }

            $gallery = [];
            foreach ($request->file('images') as $img) {
                $name = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('uploads/products'), $name);
                $gallery[] = $name;
            }
            $product->images = json_encode($gallery);
        }

        $product->save();
        flash()->success('Product updated successfully!');
        return redirect()->route('admin.product');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete single image
        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        // Delete multiple images
        if ($product->images) {
            $images = json_decode($product->images, true);
            foreach ($images as $img) {
                if (File::exists(public_path('uploads/products/' . $img))) {
                    File::delete(public_path('uploads/products/' . $img));
                }
            }
        }

        $product->delete();
        flash()->success('Product deleted successfully!');
        return redirect()->route('admin.product');
    }
}