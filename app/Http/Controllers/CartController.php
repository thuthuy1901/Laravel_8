<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService;
use Illuminate\Support\Facades\Session;
use App\Http\Services\Menu\MenuService;
use App\Models\Cart;
use App\Models\Customer;

class CartController extends Controller
{
    protected $cartService;
    protected $menuService;

    public function __construct(CartService $cartService, MenuService $menuService)
    {
        $this->cartService = $cartService;
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        $result = $this->cartService->create($request);

        if ($result == false) {
            return redirect()->back();
        }
        return redirect('/carts');
    }

    public function show()
    {
        $products = $this->cartService->getProduct();
        return view('carts.list', [
            'title' => 'Giỏ hàng',
            'products' => $products,
            'menus' => $this->menuService->show(),
            'carts' => Session::get('carts')
        ]);
    }

    public function update(Request $request)
    {
        $resultArray = array_filter($request->input('num_product'), function ($value) {
            return $value !== "0";
        });

        $this->cartService->update($resultArray);
        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->cartService->remove($id);
        return redirect('/carts');
    }

    public function addCart(Request $request)
    {
        $this->cartService->addCart($request);
        return redirect()->back();
    }

    public function showSearch()
    {
        return view('carts.searchOder', [
            'title' => 'Tra cứu đơn hàng',
            'menus' => $this->menuService->show(),
            'customers' => []
        ]);
    }

    public function check(Request $request)
    {
        $search = $request->input('search');
        $customers = $this->cartService->getOrder($search);

        return view('carts.searchOder', [
            'title' => 'Tra cứu đơn hàng',
            'menus' => $this->menuService->show(),
            'customers' => $customers
        ]);
    }

    public function showDetail($id)
    {
        $customer = $this->cartService->getCustomer($id);
        $orders = $this->cartService->getProductForCarts($customer[0]);
        return view('carts.oderDetail', [
            'title' => 'Tra cứu đơn hàng',
            'menus' => $this->menuService->show(),
            'customer' => $customer[0],
            'orders' => $orders
        ]);
    }
}
