<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LazadaShop;
use App\Models\Product;
use App\Models\User;
use App\Traits\LazadaTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Lazada\LazopClient;
use Lazada\LazopRequest;
use function PHPUnit\Framework\isNull;


class LazadaController extends Controller
{
    //
    use LazadaTraits;

    public function templateAuthorize()
    {
        $msg = '';

        if (!is_null(User::find(Auth::user()->id)->lazadaShop) && session()->get('refresh_expires_in') == 0) {

            $msg = Session::flash('refresh', "Bạn đã authorize Lazada hãy click vào đây để refresh lại");
        }
        return view('backend.admin.api.lazada.authorize')->with('refresh', $msg);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function LaOpAuthorize(Request $request)
    {

        $data = [
            'appkey' => $request->app_key,
            'appsecret' => $request->app_secret,
            'user_id' => Auth::user()->id
        ];
        LazadaShop::create($data);
        session()->put('apikey', $data['appkey']);
        session()->put('appsecret', $data['appsecret']);

        $callback = url('admin/lazada/token');
        LazadaTraits::LazopAuthorize('https://auth.lazada.com/', $data['appkey'], $data['appsecret'], $callback);

    }

    public function getToken()
    {
        $code = \request()->get('code');
        $shop = User::find(Auth::user()->id)->lazadaShop;

        $json = LazadaTraits::LazopToken($code, 'https://auth.lazada.com/rest', $shop->appkey, $shop->appsecret);
        $data = [
            'access_token' => $json['access_token'],
            'refresh_token' => $json['refresh_token']
        ];
        session()->put('access_token', $json['access_token']);
        session()->put('refresh_token', $json['refresh_token']);
        session()->put('refresh_expires_in', $json['refresh_expires_in']);
//            dd($data);

        $test = User::find(Auth::user()->id)->lazadaShop->update($data);

        return redirect()->intended('admin/lazada/authorize');
    }

    public function refresh(): \Illuminate\Http\RedirectResponse
    {

        $shop = User::find(Auth::user()->id)->lazadaShop;

        $json = LazadaTraits::LazopRefresh('https://auth.lazada.com/rest', $shop->appkey, $shop->appsecret, $shop->refresh_token);
            $data = [
                'access_token' => $json['access_token'],
                'refresh_token' => $json['refresh_token'],
            ];
            session()->put('access_token', $json['access_token']);
            session()->put('refresh_token', $json['refresh_token']);
            session()->put('refresh_expires_in', $json['refresh_expires_in']);
            User::find(Auth::user()->id)->lazadaShop->update($data);
            return redirect()->intended('admin/lazada/authorize');


    }

    public function index(){
//
//        $shop = User::find(Auth::user()->id)->lazadaShop;
//        $c = new LazopClient('https://api.lazada.vn/rest',$shop->appkey,$shop->appsecret);
//        $request = new LazopRequest('/product/update');
//        $request->addApiParam('apiRequestBody','<Request>     <Product>         <ItemId>1717024314</ItemId>         <Skus><Status>inactive</Status></Skus>     </Product> </Request>');
//        dd(json_decode($c->execute($request, $shop->access_token)),true);

        $info = LazadaTraits::getSeller();

        $productAll = LazadaTraits::getProducts('all');
        $productAllItem = $productAll['data']['products'] ?? '';

//        dd($productAllItem);

        $productActive = LazadaTraits::getProducts('live');
        $productActiveItem = $productActive['data']['products'] ?? '';


        $productInactive = LazadaTraits::getProducts('inactive');
        $productInactiveItem = $productInactive['data']['products'] ?? '';


        $productDeleted = LazadaTraits::getProducts('deleted');
        $productDeletedItem = $productDeleted['data']['products'] ?? '';

//        dd($productActive);
        return view('backend.admin.api.lazada.index',compact('info','productAll','productAllItem','productActive','productActiveItem','productInactive','productInactiveItem','productDeleted','productDeletedItem'));
    }

    public function status($item_id,$status)
    {

        $product = Product::where('item_id',$item_id)->first();

        LazadaTraits::statusProduct($product,$status);

        return redirect()->route('lazada.index');
    }

    public function remove($item_id){

        $product = Product::where('item_id',$item_id)->first();

        LazadaTraits::remove($product);
        $product->delete();
        return redirect()->route('lazada.index');

    }
//

    public static function restore($item_id){
        Product::withTrashed()->where('item_id',$item_id)->restore();

        $product = Product::where('item_id',$item_id)->first();
        LazadaTraits::restore($product);
        return redirect()->route('lazada.index');
    }


}
