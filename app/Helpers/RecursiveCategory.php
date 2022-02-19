<?php

namespace App\Helpers;

class RecursiveCategory
{

    public static function recursuveCategory($categories, $leaf = false, $char = '')
    {
        foreach ($categories as $key => $item) {

            // Nếu là chuyên mục con thì hiển thị

            if ($item['leaf'] == $leaf) {

                echo '<option value=' . $item['category_id'] . '>' . $char . $item['name'] . '</option>';

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::recursuveCategory($item['children'], false, '|--');
            } else {
                echo '<option value=' . $item['category_id'] . '> |-- ' . $char . $item['name'] . '</option>';
            }
        }
    }

    public static function recursuveEditCategory($categories, $lazSelect, $leaf = false, $char = '')
    {
        foreach ($categories as $key => $item) {

            // Nếu là chuyên mục con thì hiển thị

            if ($item['leaf'] == $leaf) {
                $select = $lazSelect == $item['category_id'] ? 'selected' : '';
                echo '<option value=' . $item['category_id'] . ' ' . $select . ' >' . $char . $item['name'] . '</option>';

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::recursuveCategory($item['children'], false, '|--');
            } else {
                echo '<option value=' . $item['category_id'] . '> |-- ' . $char . $item['name'] . '</option>';
            }
        }
    }

    static function showAddProductCategories($categories, $parent_id = null, $char = '')
    {
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
                if ($item['parent_id'] < 2){
                    echo '<option disabled value=' . $item['id'] . ' >' . $char . $item['name'] . '</option>';
                }else{
                    echo '<option value=' . $item['id'] . '>' . $char . $item['name'] . '</option>';

                }

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showAddProductCategories($categories, $item['id'], $char . '|---');
            }
        }
    }
    static function showEditProductCategories($categories,$select_category, $parent_id = 0, $char = '')
    {
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
                $select = $select_category === $item['id'] ? 'selected' : '';


                if ($item['parent_id'] < 2){
//                    echo '<option disabled value=' . $item['id'] . ' >' . $char . $item['name'] . '</option>';
                    echo '<option disabled value=' . $item['id'] . ' '.$select.' >' . $char . $item['name'] . '</option>';
                }else{
//                    echo '<option value=' . $item['id'] . '>' . $char . $item['name'] . '</option>';
                    echo '<option value=' . $item['id'] . ' '.$select.' >' . $char . $item['name'] . '</option>';
                }

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                self::showEditProductCategories($categories,$select_category, $item['id'], $char . '|---');
            }
        }
    }
}
