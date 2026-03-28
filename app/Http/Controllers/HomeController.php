<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.website.index');
    }

    public function shop()
    {
        return view('pages.website.shop');
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


    public function profDetails()
    {
        return view('pages.website.prod-details');
    }
}
