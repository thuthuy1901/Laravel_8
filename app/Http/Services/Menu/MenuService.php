<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class MenuService
{

    public function getParent()
    {
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll()
    {
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function create($request)
    {
        try {
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'active' => (string) $request->input('active'),
            ]);

            Session::flash('success', 'Tạo thành công!');
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if ($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
        return false;
    }

    public function update($request, $menu): bool
    {

        if ($menu->parent_id != 0) {
            $menu->parent_id = (int) $request->input('parent_id');
        }
        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->active = (string) $request->input('active');
        $menu->save();
        Session::flash('success', 'Cập nhập thành công!');
        return true;
    }

    public function show()
    {
        return Menu::select('name', 'id')->where('parent_id', 0)->get();
    }

    public function getId($id)
    {
        // $parentID = Menu::where('id', $id)->value('parent_id');
        // if ($parentID == 0) {
        //     return Menu::where('parent_id', $id)->where('active', 1)->get();
        // }
        return Menu::where('id', $id)->where('active', 1)->firstOrFail();
        // dd(Menu::where('id', $id)->where('active', 1)->firstOrFail());
    }


    public function getProduct($menu, $request)
    {
        // $parentID = Menu::where('id', $id)->value('parent_id');
        // foreach ($menu as $item) {

        //     // dd($query);
        // }
        $query = $menu->products()
            ->select('id', 'name', 'thumb', 'price', 'price_sale')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderby('price_sale', $request->input('price'));
        }
        return $query->orderbyDesc('id')->paginate(12)->withQueryString();
    }
}
