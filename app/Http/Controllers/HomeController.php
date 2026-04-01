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
        return view('pages.website.index', compact('categories', 'sliders'));
    }

    public function shop()
    {
        $products = Product::latest()->paginate(9);
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
