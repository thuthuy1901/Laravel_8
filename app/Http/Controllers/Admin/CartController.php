<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use App\Models\Customer;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('admin.cart.customer', [
            'title' => 'Danh sách đơn hàng',
            'customers' => $this->cart->getCustomer(),

        ]);
    }

    public function show(Customer $customer)
    {
        $carts = $this->cart->getProductForCarts($customer);
        return view('admin.cart.detail', [
            'title' => 'Chi tiết đơn hàng',
            'customer' => $customer,
            'carts' => $carts,
        ]);
    }
}
