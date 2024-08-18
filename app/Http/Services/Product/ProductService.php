<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Psr\Log;

class ProductService
{
    const LIMIT = 16;

    public function getMenu()
    {
        return Menu::where('parent_id', '<>', 0)->where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if ($request->input('price_sale') < 0 && $request->input('price') < 0) {
            Session::flash('error', 'Giá tiền luôn lớn hơn !');
            return false;
        }
        return true;
    }

    public function insert($request)
    {
        // $isValidPrice = $this->isValidPrice($request);
        // if ($isValidPrice == false) return false;

        // dd($request->except('_token'));
        try {
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm sản phẩm thất bại!');
            return false;
        }
        return true;
    }

    public function get()
    {
        return Product::with('menu')->orderByDesc('id')->paginate(15);
    }

    public function update($request, $product)
    {
        try {
            $product->fill($request->input());
            $product->save();
            Session::flash('success', 'Cập nhập thành công!');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhập thất bại!');
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $path = str_replace('storage', 'public', $product->thumb);
            Storage::delete($path);
            $product->delete();
            return true;
        }
        return false;
    }

    public function show($id)
    {
        return Product::where('id', $id)->where('active', 1)->with('menu')->firstOrFail();
    }

    public function more($id)
    {
        return Product::select('id', 'name', 'thumb', 'price_sale')
            ->where('active', 1)
            ->where('id', '<>', $id)
            ->limit(4)
            ->get();
    }
}
