<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRoleRequest;
use Dropbox\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:admin|manager-member']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Role::all();
        return view('backend.admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('backend.admin.role.add', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddRoleRequest $request)
    {

        try {
            DB::beginTransaction();
//        dd($request->permission);
            $roleData = [
                'display_name' => $request->display_name,
                'name' => Str::slug($request->display_name),
                'description' => $request->description
            ];
            $permissions = $request->permission;
            $role = Role::create($roleData);
            $role->givePermissionTo($permissions);

            DB::commit();
            return redirect()->route('role.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' on file: ' . $e->getFile());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::find($id);
        $permissions = Permission::all();
        $roleSelecteds = $role->getPermissionNames();
        return view('backend.admin.role.edit', compact('role', 'permissions', 'roleSelecteds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        try {
            DB::beginTransaction();
            $roleData = [
                'display_name' => $request->display_name,
                'name' => Str::slug($request->display_name),
                'description' => $request->description
            ];
            $permissions = $request->permission;

            $role = Role::find($id);
            $role->update($roleData);
            $role->syncPermissions($permissions);

            DB::commit();
            return redirect()->route('role.index');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' on file: ' . $e->getFile());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $role = Role::find($id);
        $permission = $role->getPermissionNames();
        $role->revokePermissionTo($permission);
        $role->delete();
        return redirect()->route('role.index');
    }
}
