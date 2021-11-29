<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings = $this->setting->all();
        return view('backend.admin.setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.admin.setting.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SettingRequest $request)
    {
        //

        if($request->type == 'image'){
            if($request->hasFile('config_value')){
                // Lấy thông tin file
                $oldfile = $request->config_value;
                // đường dẫn đến thư mục chứa file
                $path = 'images/settings/';
                $fileName = $request->config_key.'.'.$oldfile->getClientOriginalExtension();
                //lưu file
                $config_value = $request->file('config_value')->move($path, $fileName);

            }else{
                $config_value = null;
            }
        }else{
            $config_value = $request->config_value;
        }
        if (is_null($request->type)){
            $type = 'text';
        }else{
            $type = $request->type;
        }
        $data = [
            'config_name' => $request->config_name,
            'config_key' => $request->config_key,
            'config_value' => $config_value,
            'type' => $type
        ];
        $this->setting->create($data);
        return redirect()->route('setting.index');
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
        $setting = $this->setting->find($id);
        return view('backend.admin.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingRequest $request, $id)
    {
        //
        if($request->type == 'image'){
            if($request->hasFile('config_value')){
                // Lấy thông tin file
                $oldfile = $request->config_value;
                // đường dẫn đến thư mục chứa file
                $path = 'images/settings/';
                $fileName = $request->config_key.'.'.$oldfile->getClientOriginalExtension();
                //lưu file
                $config_value = $request->file('config_value')->move($path, $fileName);

            }else{
                $config_value = null;
            }
        }else{
            $config_value = $request->config_value;
        }
        if (is_null($request->type)){
            $type = 'text';
        }else{
            $type = $request->type;
        }
        $data = [
            'config_name' => $request->config_name,
            'config_key' => $request->config_key,
            'config_value' => $config_value,
            'type' => $type
        ];
        $this->setting->find($id)->update($data);
        return redirect()->route('setting.index');
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
        $this->setting->find($id)->delete();
        return redirect()->route('setting.index');
    }
}
