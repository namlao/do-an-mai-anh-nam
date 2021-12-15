<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dropbox\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        //
        $users = $this->user->get();
        return view('backend.admin.user.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //

        try {
            DB::beginTransaction();
            if($request->hasFile('avatar')){
                // Lấy thông tin file
                $oldfile = $request->avatar;

                // đường dẫn đến thư mục chứa file
                $path = 'images/users/';
                // đặt tên file: ten_product_random(10).<extension-file>
                $fileName = Str::slug($request->name).'.'.$oldfile->getClientOriginalExtension();
                //lưu file
                $file = $request->file('avatar')->move($path, $fileName);
            }else{
                $file = null;
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'avatar' => $file
            ];

            $this->user->create($data);
            DB::commit();
            return redirect()->route('user.index');
        }catch (Exception $e){
            DB::rollBack();
            Log::error('Error: '.$e->getMessage().' Line: '.$e->getLine().' on file: '.$e->getFile());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = $this->user->find($id);
        return view('backend.admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        try {
            DB::beginTransaction();
            $user = $this->user->find($id);
            if($request->hasFile('avatar')){
                // Lấy thông tin file
                $oldfile = $request->avatar;

                // đường dẫn đến thư mục chứa file
                $path = 'images/users/';
                // đặt tên file: ten_product_random(10).<extension-file>
                $fileName = Str::slug($request->name).'.'.$oldfile->getClientOriginalExtension();
                //lưu file
                $file = $request->file('avatar')->move($path, $fileName);
            }else{
                $file = $user->avatar;
            }
            $data = [
                'name' => $request->name,
                'avatar' => $file
            ];

            if ($request->changePassword == 'on'){
                $data['password'] = Hash::make($request->password);
            }


            $this->user->find($id)->update($data);
            DB::commit();
            return redirect()->route('user.index');
        }catch (Exception $e){
            DB::rollBack();
            Log::error('Error: '.$e->getMessage().' Line: '.$e->getLine().' on file: '.$e->getFile());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $this->user->find($id)->delete();
        return redirect()->route('user.index');
    }
}
