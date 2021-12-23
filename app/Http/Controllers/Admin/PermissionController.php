<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    private $display_name;
    private $action;

    public function __construct()
    {
        $this->display_name = config('rolepermission.display_name');
        $this->action = config('rolepermission.action');
        $this->middleware('auth');
        $this->middleware(['role:admin']);
    }

    public function index()
    {
        $display_names = $this->display_name;
        $actions = $this->action;
        return view('backend.admin.permission.index', compact('display_names', 'actions'));
    }

    public function add(Request $request)
    {
//        dd($this->getNameDisplay('role delete'));
        $permissionData = $request->permission;
        foreach ($permissionData as $key => $value) {
            if (!Permission::where('name', '=', $value)->exists()) {   //true => nếu chuỗi $value tồn tại
                $permission[] = Permission::create(['name' => $value, 'display_name' => $this->getNameDisplay($value)]);
            }
        }
        return back();
    }

    public function getNameDisplay($value)
    {
        $valueArr[] = explode(" ", $value); //$valueArr[0] = role, $valueArr[1] = delete
        return $this->getSearchNameAction($valueArr[0][1]) . ' ' . $this->getSearchDisplayName($valueArr[0][0]);
    }

    private function getSearchNameAction($keySearch)
    {
        $actions = $this->action;
        $name = '';
        foreach ($actions as $key => $value){
            if ($key == $keySearch){
                $name = $value;
            }
        }
        return $name;
    }

    private function getSearchDisplayName($keySearch)
    {
        $displayNames = $this->display_name;
        $name = '';
        foreach ($displayNames as $key => $value){
            if ($key == $keySearch){
                $name = $value;
            }
        }
        return $name;
    }
}



// Lấy vâlue theo key
//'display_name' => [
//    'category' => 'Chuyên mục',
//    'product' => 'Sản phẩm',
//    'slide' => 'Slide',
//    'setting' => 'Cài đặt',
//    'user' => 'Thành viên',
//    'role' => 'Vai trò',
//],
//    'action' => [
//    'list' => 'Danh sách',
//    'add' => 'Thêm',
//    'edit' => 'Sửa',
//    'delete' => 'Xóa'
//]
// value + key
