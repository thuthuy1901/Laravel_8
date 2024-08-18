<?php

namespace App\Http\Services\Cart;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác!');
            return false;
        }
        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }
        $exists = Arr::exists($carts, $product_id);

        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);
        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return [];
        }
        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request);
        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);
        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {
        try {
            DB::beginTransaction();
            $carts = Session::get('carts');
            if (is_null($carts)) return false;

            $customer = Customer::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'content' => $request->input('content')
            ]);

            $this->infoProductCart($carts, $customer->id);

            DB::commit();
            Session::flash('success', 'Đặt hàng thành công!');

            // SendMail
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Vui lòng thử lại!');
            return false;
        }
        return true;
    }

    public function infoProductCart($carts, $customer_id)
    {
        $productId = array_keys($carts);
        $products =  Product::select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'qty' => $carts[$product->id],
                'price' => $product->price_sale
            ];
        }
        return Cart::insert($data);
    }
    public function getOrder($search)
    {
        return Customer::where('email', $search)
            ->orWhere('phone', $search)
            ->select('id', 'address', 'name', 'phone', 'email', 'created_at')
            ->get();
    }
    public function getCustomer($id)
    {
        return Customer::where('id', $id)
            ->select('address', 'name', 'phone', 'email', 'id', 'content')
            ->get();
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
