<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';
        $i = 1;
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td class="' . ($menu->parent_id == 0 ? '' : 'font-weight-bold') . '">' . $i . '</td>
                        <td class="' . ($menu->parent_id == 0 ? 'font-weight-bold' : '') . '">' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a href="/admin/menus/edit/' . $menu->id . '" class="btn btn-secondary">
                                <img src="/template/admin/dist/img/edit.png" alt="edit" style="width: 15px;">
                            </a>
                            <a href="#" class="btn btn-dark" onClick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\')">
                                <img src="/template/admin/dist/img/remove.png" alt="remove" style="width: 15px;">
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);
                $html .= self::menu($menus, $menu->id, $char . '--');
                $i++;
            }
        }
        return $html;
    }

    public static function active($active = 0)
    {
        return $active == 0 ?
            '<span class="btn btn-secondary">
                <img src="/template/admin/dist/img/no.png" alt="no" style="width: 15px;">
            </span>' :
            '<span class="btn btn-dark">
                <img src="/template/admin/dist/img/yes.png" alt="yes" style="width: 15px;">
            </span>';
    }

    public static function menus($menus, $parent_id = 0): string
    {
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                         <a onClick="changeColorMenu()"
                         href="' . ($menu->parent_id == 0 ? '#' : '/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html') . '">
                            ' . $menu->name . '</a>';

                unset($menus[$key]);
                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="sub-menu">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                }
            }
        }
        return $html .= '</li>';;
    }

    public static function isChild($menus, $id): bool
    {
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }

    public static function price($price = 0, $priceSale = 0)
    {
        if ($priceSale != 0) return number_format($priceSale);
        if ($price != 0) return number_format($price);
        return '
            <a href="/lien-he.html">Liên hệ</a>
        ';
    }
}
