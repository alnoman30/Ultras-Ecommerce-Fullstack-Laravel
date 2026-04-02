<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $categories = Category::all();
        $sliders = Slider::all();
        $featuredProducts = Product::where('featured', true)->latest()->take(8)->get();
        return view('pages.website.index', compact('categories', 'sliders', 'featuredProducts'));
    }

    public function shop(Request $request)
    {
        $query = Product::query();

        //  Category filter
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        //  Brand filter (multiple)
        if ($request->brands) {
            $query->whereIn('brand_id', $request->brands);
        }

        //  Price filter
        if ($request->min_price && $request->max_price) {
            $query->whereBetween('regular_price', [
                $request->min_price,
                $request->max_price
            ]);
        }

        //  Sorting
        if ($request->sort) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('regular_price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('regular_price', 'desc');
                    break;
                case 'latest':
                    $query->latest();
                    break;
                case 'oldest':
                    $query->oldest();
                    break;
                case 'az':
                    $query->orderBy('name', 'asc');
                    break;
                case 'za':
                    $query->orderBy('name', 'desc');
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->appends($request->query());

        $categories = Category::all();
        $brands = Brand::withCount('products')->get();

        return view('pages.website.shop', compact('products', 'categories', 'brands'));
    }

    public function cart()
    {
        return view('pages.website.cart');
    }

    public function checkout()
    {
        return view('pages.website.checkout');
    }

    public function orderConfirm()
    {
        return view('pages.website.order-confirm');
    }

    public function about()
    {
        return view('pages.website.about');
    }

    public function contact()
    {
        return view('pages.website.contact');
    }

    public function wishlist()
    {
        return view('pages.website.wishlist');
    }
}
