<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFrontendRegisterRequest;
use App\Http\Requests\AddFrontendUserRequest;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Dropbox\Exception;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Session\Session;

class FrontendController extends FrontendBaseController
{
    private $category;
    private $slide;
    private $product;
    private $cart;
    private $customer;
    private $user;
    public function __construct(Category $category,Slide $slide,Product $product,Cart $cart,Customer $customer,User $user)
    {
        parent::__construct( $category,$product);
        $this->category = $category;
        $this->slide = $slide;
        $this->product = $product;
        $this->cart = $cart;
        $this->customer = $customer;
        $this->user = $user;
    }

    public function index(){
        $slides = $this->slide->where('display','=',1)->take(4)->get();
        $productNews = $this->product->latest()->get();

        return view('frontend.index',compact('slides','productNews'));
    }

    //display all product
    public function shop(Request $request){

        $limit = request()->get('limit');
        $products = $this->product->paginate($limit);

        return view('frontend.shop',compact('products'));
    }

    //display all product with category id
    public function categoryId($id){
        $products = $this->product->where('category_id',$id)->paginate(12);
        $categoryId = $this->category->find($id);
        return view('frontend.category-product',compact('categoryId','products'));
    }

    public function loginCustomer(){

        return view('frontend.login');
    }
    public function postCustomLogin(AddFrontendUserRequest $request){
        $data = [
          'email' => $request->email,
          'password' => $request->password
        ];

        if (Auth::attempt($data)){
            $user = User::find(Auth::user()->id);

            if ($user->hasRole('guest')){
                return back();
            }else{
                return redirect('/admin/');
            }
        }else{
            $error = 'Email hoặc mật khẩu không đúng';
            return back()->with('error',$error);
        }
    }
    public function logoutCustomer(){
        Auth::logout();
        return redirect('/');
    }

    public function registerCustom(){
        return view('frontend.register');
    }

    public function postRegisterCustom(AddFrontendRegisterRequest $request){
        try {
            DB::beginTransaction();
            $data = [
                'name' =>   $request->firstname .' '. $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $user = $this->user->create($data);
            $user->assignRole('guest');
            $dataCustomer = [
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'user_id' => $user->id
            ];
            $this->customer->create($dataCustomer);
            Db::commit();
            return back()->with('success','Bạn đã đăng ký thành công');
        }catch (Exception $e){
            DB::rollBack();
            Log::error('Error messsage: '.$e->getMessage().' line: '.$e->getLine());
        }

    }

    public function product($id){
        $productItem = $this->product->find($id);
        $product = $this->product->get();
        return view('frontend.item',compact('product','productItem'));
    }
}
