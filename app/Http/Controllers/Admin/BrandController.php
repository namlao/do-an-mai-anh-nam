<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    private $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = $this->brand->all();
        return view('backend.admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.admin.brand.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddBrandRequest $request)
    {
        //
        if ($request->hasFile('logo')) {
            // Lấy thông tin file
            $oldfile = $request->logo;
            // đường dẫn đến thư mục chứa file
            $path = 'images/brands/' . Auth::user()->id;
            // đặt tên file: ten_product_random(10).<extension-file>
            $fileName = $request->name . '.' . $oldfile->getClientOriginalExtension();
            //lưu file
            $file = $request->file('logo')->move($path, $fileName);
        } else {
            $file = null;
        }
        $name='';
        if (isset($request->name)){
            $name = Str::ucfirst($request->name);
        }
        $data = [
            'name' => $name,
            'logo' => $file
        ];

        $this->brand->create($data);
        return redirect()->route('brand.index');
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
        $brand = $this->brand->find($id);
        return view('backend.admin.brand.edit',compact('brand'));
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
        $brand = $this->brand->find($id);
        if ($request->hasFile('logo')) {
            // Lấy thông tin file
            $oldfile = $request->logo;
            // đường dẫn đến thư mục chứa file
            $path = 'images/brands/' . Auth::user()->id;
            // đặt tên file: ten_product_random(10).<extension-file>
            $fileName = $request->name . '.' . $oldfile->getClientOriginalExtension();
            //lưu file
            $file = $request->file('logo')->move($path, $fileName);
        } else {
            $file = $brand->logo;
        }
        $name='';
        if (isset($request->name)){
            $name = Str::ucfirst($request->name);
        }
        $data = [
            'name' => $name,
            'logo' => $file
        ];
        $brand = $this->brand->find($id)->update($data);
        return redirect()->route('brand.index');
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
        $brand = $this->brand->find($id)->delete();
        return redirect()->route('brand.index');
    }
}
