<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Models\Product;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuService->getId($id);

        $products = $this->menuService->getProduct($menu, $request);

        return view('menu', [
            'title' => $menu->name,
            'products' => $products,
            'menu' => $menu,
            'menus' => $this->menuService->show(),
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('name', 'like', '%' . $search . '%')->get();
        return view('search', [
            'menus' => $this->menuService->show(),
            'title' => 'Tìm kiếm sản phẩm',
            'products' => $products,
        ]);;
    }
}
