<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Admin\Photo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Models\Product;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('admin.product.list', [
            'title' => 'Danh sách sản phẩm',
            'products' => $this->productService->get(),
        ]);
    }


    public function create()
    {
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
            'menus' => $this->productService->getMenu()
        ]);
    }

    public function store(ProductRequest $request)
    {
        $result = $this->productService->insert($request);
        if ($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }

    public function show(Product $product)
    {
        return view('admin.product.edit', [
            'menus' => $this->productService->getMenu(),
            'title' => 'Cập nhập sản phẩm',
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        //
    }


    public function update(ProductRequest $request, Product $product)
    {
        $result = $this->productService->update($request, $product);
        if ($result) {
            return redirect('/admin/products/list');
        }
        return redirect()->back();
    }


    public function destroy(Request $request): JsonResponse
    {
        $result = $this->productService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công!'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }
}
