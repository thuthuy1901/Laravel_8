<?php

namespace App\Http\Services;

use App\Models\Customer;

class CartService
{
    public function getCustomer()
    {
        return Customer::orderByDesc('id')->paginate(15);
    }

    public function getProductForCarts($customer)
    {
        return $customer->carts()->with([
            'product' => function ($query) {
                $query->select('id', 'name', 'thumb');
            }
        ])->get();
    }
}
