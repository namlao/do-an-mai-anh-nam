<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddFrontendRegisterRequest;
use App\Http\Requests\AddFrontendUserRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Dropbox\Exception;
use Gloudemans\Shoppingcart\Cart;
use HoangPhi\VietnamMap\Models\Province;
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
    private $brand;
    public function __construct(Category $category,Slide $slide,Product $product,Cart $cart,Customer $customer,User $user,Brand $brand)
    {
        parent::__construct( $category,$product,$brand);
        $this->category = $category;
        $this->brand = $brand;
        $this->slide = $slide;
        $this->product = $product;
        $this->cart = $cart;
        $this->customer = $customer;
        $this->user = $user;
    }

    public function index(){
        $slides = $this->slide->where('display','=',1)->take(4)->get();
        $productNews = $this->product->latest()->get();
        $categoryWithProducts = Category::leaves();


        return view('frontend.index',compact('slides','productNews','categoryWithProducts'));
    }

    //display all product
    public function shop(){


        $products = $this->product->paginate(16);

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
            $error = 'Email ho???c m???t kh???u kh??ng ????ng';
            return back()->with('error',$error);
        }
    }
    public function logoutCustomer(){
        Auth::logout();
        \session()->flush();
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
            return back()->with('success','B???n ???? ????ng k?? th??nh c??ng');
        }catch (Exception $e){
            DB::rollBack();
            Log::error('Error messsage: '.$e->getMessage().' line: '.$e->getLine());
        }

    }

    public function product($id){
        $productItem = $this->product->find($id);
        $product = $this->product->get();
        $comments = Comment::where('product_id',$id)->get();

        return view('frontend.item',compact('product','productItem','comments'));
    }

    public function privacy_policy(){
        return view('frontend.pages.privacy-policy');
    }
    public function faq(){
        return view('frontend.pages.faq');
    }
    public function about(){
        return view('frontend.pages.about');
    }

    public function contact(){
        return view('frontend.pages.contact');
    }

    public function terms_conditions(){
        return view('frontend.pages.terms-conditions');

    }

    public function getSearch(Request $request){
        $keyword = $request->keyword;
        $products = $this->product->where('name','like',"%{$keyword}%")->paginate(16);
        return view('frontend.search',compact('keyword','products'));
    }

    public function account(){
        return view('frontend.account');
    }

    public function accountPassword(){
        return view('frontend.account_password');
    }

    public function accountInfo(){
        $id = Auth::user()->id;
        $email = Auth::user()->email;
        $customer = $this->customer->where('user_id',$id)->first();

        return view('frontend.account_info',compact('customer','email'));
    }

    public function accountAddress(){

        $id = Auth::user()->id;
        $provinces = Province::all();

        $customer = $this->customer->where('user_id',$id)->first();

        return view('frontend.account_address',compact('customer','provinces'));
    }
}
