<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Traits\LazadaTraits;
use App\Traits\ProductFunc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Lazada\LazopClient;
use Lazada\LazopRequest;


class HomeController extends Controller
{
    use ProductFunc;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:admin|member-manager|content']);
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        LazadaTraits::autoGetProduct();
//        ProductFunc::deleteProduct();

//        ProductFunc::checkTrashProduct();
        return view('backend.index');
    }


}
