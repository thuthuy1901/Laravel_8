<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFromRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create()
    {
        return view('admin.menu.add', [
            'title' => 'Thêm danh mục mới',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFromRequest $request)
    {
        $this->menuService->create($request);

        return redirect('/admin/menus/list');
    }

    public function index()
    {
        return view('admin.menu.list', [
            'title' => 'Danh sách danh mục',
            'menus' => $this->menuService->getAll()
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $result = $this->menuService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function show(Menu $menu)
    {
        return view('admin.menu.edit', [
            'title' => 'Chỉnh sửa danh mục',
            'menu' => $menu,
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function update(Menu $menu, CreateFromRequest $request)
    {
        $this->menuService->update($request, $menu);

        return redirect('/admin/menus/list');

        // return redirect('admin/menus/list');
    }
}
