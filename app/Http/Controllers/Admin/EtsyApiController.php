<?php

namespace App\Http\Controllers\Admin;

use App\Models\Api;
use App\Models\Category;
use App\Models\Product;
use App\Traits\OauthTrait;
use Dropbox\Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use OAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OAuthException;
use App\Helpers\checkApi;

class EtsyApiController extends Controller
{
    //
    private $api;
    private $product;
    use OauthTrait;

    public function __construct(Api $api, Product $product)
    {
        $this->api = $api;
        $this->product = $product;
    }

// connect api
    public function connect()
    {

        return view('backend.admin.api.etsy.connect');
    }

    public function postConnect(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'user_id' => Auth::user()->id,
                'api_key' => $request->api_key,
                'secret_key' => $request->secret_key
            ];

            if (!checkApi::checkApiEtsy($data['api_key'])) {
                Session::flash('error', 'Sai api key');

                return redirect('admin/etsy/connect')->with('status');
            }

            $oauth = new OAuth($data['api_key'], $data['secret_key']);
            $oauth->disableSSLChecks();
            $req_token = $oauth->getRequestToken("https://openapi.etsy.com/v2/oauth/request_token?scope=email_r%20listings_r%20listings_w", url('') . '/admin/etsy/getoauth');
            request()->session()->put('oauth_token_secret', $req_token['oauth_token_secret']);


            $apiId = $this->api->firstOrCreate($data);
            request()->session()->put('apiID', $apiId->id);
            DB::commit();
            return Redirect::away($req_token['login_url']);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Error: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }

    }

//    /**
//     * Get oauth token
//     * @throws \OAuthException
//     */
    public function getoauth()
    {

//        session_start();
        $apiId = request()->session()->get('apiID');
        $api = $this->api->find($apiId);
        $api_key = $api->api_key;
        $secret_key = $api->secret_key;

        $request_token = request()->get('oauth_token');
        $verifier = request()->get('oauth_verifier');
        $oauth_token_secret = Session::get('oauth_token_secret');

        $oauth = new OAuth($api_key, $secret_key);
        $oauth->disableSSLChecks();

        $oauth->setToken($request_token, $oauth_token_secret);

        try {
            $acc_token = $oauth->getAccessToken("https://openapi.etsy.com/v2/oauth/access_token", null, $verifier);

            $this->api->find($apiId)->update(
                [
                    'oauth_token' => $acc_token['oauth_token'],
                    'oauth_token_secret' => $acc_token['oauth_token_secret'],

                ]
            );

            request()->session()->put('oauth_token', $acc_token['oauth_token']);
            request()->session()->put('oauth_token_secret', $acc_token['oauth_token_secret']);

            return redirect('admin/etsy');
        } catch (OAuthException $e) {
            error_log($e->getMessage());
        }
    }



    // display name shop and get all listing
    public function index()
    {
        $jsonNameShop = OauthTrait::callApi($this->api,'shops/LaptopShopVietnam',OAUTH_HTTP_METHOD_GET);
        $jsonAllListting = OauthTrait::callApi($this->api,'shops/LaptopShopVietnam/listings/active',OAUTH_HTTP_METHOD_GET);
        $nameShop = $jsonNameShop['params']['shop_id'];
        $listingShops = $jsonAllListting['results'];
        return view('backend.admin.api.etsy.index', compact('nameShop', 'listingShops'));

    }

    ////////////////////////////////////////////////////////// DONE /////////////////////////////////////////////////////////////



    public function getTaxonomy()
    {
        $json = OauthTrait::callApi($this->api,'taxonomy/buyer/get',OAUTH_HTTP_METHOD_GET);
        $allTaxonomy = $json['results'];
        $elecTaxonomy = $allTaxonomy[7];
        $childId = $elecTaxonomy['children_ids'];
        $childName = $elecTaxonomy['children'];

        $taxonomyArr = [];
//        dd($childName);
        for ($i = 0; $i < count($childId); $i++) {
            if ($childId[$i] == $childName[$i]['id']) {
                $taxonomyArr[$childId[$i]] = $childName[$i]['name'];
            }
        }
        return $taxonomyArr;
    }

    public function add($id)
    {
//        dd(Http::post('https://openapi.etsy.com/v2/listings?quantity=100&title=Lorem lpsum&description=Lorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsumLorem lpsum&price=0.5&who_made=someone_else&is_supply=false&when_made=2000_2002&state=draft'));
        $product = $this->product->find($id);
        $taxonomies = $this->getTaxonomy();  //taxonomy_id
        $imgDetails = $product->images->all();
        $countriesJson = OauthTrait::callApi($this->api,'countries',OAUTH_HTTP_METHOD_GET);
        $countries = $countriesJson['results'];
//        dd($countries);
//        dd($taxonomies);
        return view('backend.admin.api.etsy.show',compact('product','imgDetails','taxonomies','countries'));
    }
//
    public function postAdd(Request $request,$id){
        $product = $this->product->find($id);
        $data = [
            'title' => str_replace(' ','%20',$product->name),
            'description' => str_replace(' ','%20',$product->description),
            'price' => $product->price,
            'quantity' => $product->quantity,
            'who_made' => 'someone_else',
            'is_supply' => false,
            'when_made' => $product->when_made,
            'state' => 'draft',
            'taxonomy_id' => $request->taxonomy_id
//            'shipping_template_id'=> '23375728'
//            'image' => $product->

        ];
        $uriListing='';
        foreach ($data as $key => $value){
            $uriListing .= $key.'='.$value.'&';
        }

        $dataPayment = [
            'shop_id' => 'LaptopShopVietnam',
            'name' => 'Mai%20Anh%20Nam',
            'first_line' => 'Thai%20Nguyen',
            'city' => 'Thai%20Nguyen',
            'state' => 'Viet%20Nam',
            'zip' => '250000',
            'country_id' => 212



        ];
        $uriPayment='';
        foreach ($dataPayment as $key => $value){
            $uriPayment .= $key.'='.$value.'&';
        }
        //.rtrim($uriPayment,'&')
        //Create payment template
//        $json = OauthTrait::callApi($this->api,'shops/LaptopShopVietnam/payment_templates?'.rtrim($uriPayment,'&'),OAUTH_HTTP_METHOD_POST);

        //get payment template
        $json = OauthTrait::callApi($this->api,'shops/LaptopShopVietnam/payment_templates',OAUTH_HTTP_METHOD_GET);
        $payment_template_id = $json['results'][0]['payment_template_id'];

        $json = OauthTrait::callApi($this->api,'/shipping/templates/'.$payment_template_id,OAUTH_HTTP_METHOD_GET);
        dd($json);
        //rtrim($uriListing,'&')
        dd(OauthTrait::callApi($this->api,'listings?title=test%20title&description=test%20description&price=25.65&quantity=100&who_made=someone_else&is_supply=false&when_made=2000_2002&state=draft&taxonomy_id=826&shipping_template_id='.$payment_template_id,OAUTH_HTTP_METHOD_POST));

    }


}
