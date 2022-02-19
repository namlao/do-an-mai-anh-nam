<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Dropbox\Exception;
use Gloudemans\Shoppingcart\Cart;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShoppingCartController extends FrontendBaseController
{
    //
    private $cart;
    private $product;
    private $customer;
    private $user;
    private $bill;
    private $billDetail;
    private $brand;

    public function __construct(Category $category,Cart $cart,Product $product,Customer $customer,User $user,Bill $bill, BillDetail $billDetail,Brand $brand)
    {
        parent::__construct($category,$product,$brand);
        $this->brand = $brand;
        $this->cart = $cart;
        $this->product = $product;
        $this->customer = $customer;
        $this->user = $user;
        $this->bill = $bill;
        $this->billDetail = $billDetail;
    }

    public function index(){
        $cartContent = $this->cart->content();
        $product = $this->product->get();
        return view('frontend.cart',compact('cartContent','product'));
    }
    public function addCart($id){
        $product = $this->product->find($id);
        $this->cart->add(
            [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'weight' => $product->weight,
                'options' =>
                    [
                        'size' => 'large',
                        'image' => $product->image_feature_path,
                        'category' => $product->category->name
                    ]
            ]
        );
//        dd($this->cart->content());
        return redirect()->back();
    }

    public function update(Request $request)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::update($request->rowId, $request->qty);
    }

    public function removeCart($rowId): \Illuminate\Http\RedirectResponse
    {
        $this->cart->remove($rowId);
        return back();
    }

    public function checkout(){
        if (Auth::check()){
            $userId = Auth::user()->id;
            $user = $this->user->find($userId);
            $customer = $this->customer->where('user_id',$userId)->first();
            if ($customer===null){
                $this->customer->firstOrNew([
                    'user_id' => $user->id,
                    'first_name' => '',
                    'last_name' => ''
                ]);
            }
            $provinces = Province::all();

            $cart = $this->cart->content();
            $cartCount = $this->cart->count();
            return view('frontend.checkout',compact('customer','user','provinces','cart','cartCount'));

        }
        $provinces = Province::all();
        return view('frontend.checkout',compact('provinces'));
    }

    public function postCheckout(Request $request){
        $cartInfo = $this->cart->content();
        $province = Province::find(request()->get('province_id'));
        $district = District::find(request()->get('district_id'));
        $ward = Ward::find(request()->get('ward_id'));

        try {
            DB::beginTransaction();
            $customer = Customer::create([
                'first_name' => request()->get('firstname'),
                'last_name' => request()->get('lastname'),
                'phone' => request()->get('phone'),
                'address' => request()->get('address'),
                'city' =>$province->name,
                'district' =>$district->name,
                'ward' =>$ward->name,
                'user_id' => auth()->user()->id,
            ]);
            $bill = Bill::create([
                'customer_id' => $customer->id,
                'date_order' => date('Y-m-d H:i:s'),
                'total' => str_replace(',', '', $this->cart->total()),
                'note' => request()->get('note'),
                'payment_method' => $request->payment_method,

            ]);
        if (count($cartInfo) >0) {
                foreach ($cartInfo as $key => $item) {
                    BillDetail::create([
                        'bill_id' => $bill->id,
                        'product_id' => $item->id,
                        'quantily' => $item->qty,
                        'price' => $item->price,
                    ]);
                }
            }
            $this->cart->destroy();
            DB::commit();
            return redirect('success');
        }catch (Exception $e){
            DB::rollBack();
            Log::error('Error: '.$e->getMessage());
        }
    }


    public function jsonDistrictInProvince(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $district = District::whereProvinceId($request->province_id)->select('id','name','gso_id')->get();

            return response()->json($district);
        }

    }

    public function jsonWardInDistrict(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $ward = Ward::whereDistrictId($request->district_id)->select('id','name','gso_id')->get();

            return response()->json($ward);
        }
    }

    public function success(){
        return view('frontend.pages.checkout-suscess');
    }


}
