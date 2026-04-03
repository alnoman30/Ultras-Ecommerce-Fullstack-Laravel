@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Cart</h2>

        @if ($items->isEmpty())
            <h3>Your cart is empty.</h3>
            <a href="{{ route('shop') }}" class="btn btn-primary text-white">Continue Shopping</a>
        @else
            <div class="checkout-steps mb-4">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </a>
            </div>

            <!-- Cart Table Form -->
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                <div class="shopping-cart">
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th></th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                <img loading="lazy" src="{{ asset('uploads/products/' . $item['image']) }}"
                                                     width="120" height="120" alt="{{ $item['name'] }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{ $item['name'] }}</h4>
                                            </div>
                                        </td>
                                        <td>${{ number_format($item['price'], 2) }}</td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <input type="number" name="quantity[{{ $item['id'] }}]" 
                                                       value="{{ $item['qty'] }}" min="1"
                                                       class="qty-control__number text-center">
                                                <div class="qty-control__reduce">-</div>
                                                <div class="qty-control__increase">+</div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                        <td>
                                            <a href="{{ route('cart.remove', $item['id']) }}" class="remove-cart">
                                                &times;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="cart-table-footer mt-3">
                            <button type="submit" class="btn btn-light">UPDATE CART</button>
                            <a href="{{ route('cart.clear') }}" class="btn btn-danger">CLEAR CART</a>
                        </div>
                    </div>

                    <!-- Cart Totals -->
                    <div class="shopping-cart__totals-wrapper mt-4">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>Cart Totals</h3>
                                <table class="cart-totals">
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>${{ number_format($subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>VAT (15%)</th>
                                            <td>${{ number_format($vat, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mobile_fixed-btn_wrapper mt-3">
                                <div class="button-wrapper container">
                                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">
                                        PROCEED TO CHECKOUT
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </section>
</main>
@endsection