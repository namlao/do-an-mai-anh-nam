<?php

namespace App\Traits;

use App\Models\Atributes;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Lazada\LazopClient;
use Lazada\LazopRequest;
use function PHPUnit\Framework\isNull;

trait LazadaTraits
{
    public static function LazopAuthorize($url, $appkey, $appsecret, $callback)
    {
        try {
            $client = new LazopClient($url, $appkey, $appsecret);
            $request = new LazopRequest('/oauth/authorize');
            $request->addApiParam('response_type', 'code');
            $request->addApiParam('force_auth', 'true');
            $request->addApiParam('redirect_uri', $callback);
            $request->addApiParam('client_id', $appkey);
            $request->addApiParam('country', 'vn');
            print_r($client->execute($request));

        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public static function LazopToken($code, $url, $appkey, $appsecret)
    {
        try {

            $client = new LazopClient($url, $appkey, $appsecret);
            $request = new LazopRequest('/auth/token/create');
            $request->addApiParam('code', $code);
            return json_decode($client->execute($request), true);

        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage() . 'Line: ' . $e->getLine());

        }
    }

    public static function LazopRefresh($url, $appkey, $appsecret, $refresh_token)
    {
        try {
            $client = new LazopClient($url, $appkey, $appsecret);
            $request = new LazopRequest('/auth/token/refresh');
            $request->addApiParam('refresh_token', $refresh_token);
            return json_decode($client->execute($request), true);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage() . 'Line: ' . $e->getLine());

        }
    }

    public static function callApi($url, $appkey, $appsecret, $apiName, $method = 'POST', $apiParams = [], $access_token = null)
    {
        try {
            $client = new LazopClient($url, $appkey, $appsecret);
            $request = new LazopRequest($apiName, $method);
            foreach ($apiParams as $key => $apiParam) {
                $request->addApiParam($key, $apiParam);
            }

            return json_decode($client->execute($request, $access_token), true);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage() . 'Line: ' . $e->getLine());

        }


    }


    ///////////////////////////////////////////////////////////////////////////////
    // Các hàm gọi api
    //Hàm tạo sản phẩm
    public static function createProduct($product)
    { //
        //call api create product
        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)) {
            return redirect('admin/lazada/authorize');
        }
        $detail_imgs = $product->images->all();
        $image = '';
        $brand = Brand::find($product->brand_id);

        // image
        foreach ($detail_imgs as $itemImg) {
            $image .= '<Image>' . url($itemImg->path) . '</Image>';
        }

        if ($product->delivery == 0) {
            $delivery = 'No';
        } else {
            $delivery = 'Yes';
        }

        $data = [
            'category' => $product->category->lzd_category_id,
            'img_feature' => url($product->image_feature_path),
            'attribute' => [
                'name' => $product->name,
                'description' => strip_tags(html_entity_decode($product->description)), //str_replace('&nbsp;', ' ', strip_tags($product->description)),
                'short_description' => $product->short_description,
                'brand' => $product->brand->name,
                'delivery' => $delivery,
                'warranty' => $product->warranty,
            ],
            'skus' => [
                'SellerSku' => $product->sellerSku,
                'quantity' => $product->quantity,
                'price' => $product->price,
                'length' => $product->length,
                'height' => $product->height,
                'weight' => $product->weight,
                'width' => $product->width,
                'image' => $image
            ]

        ];
        $payload = '<Request><Product><PrimaryCategory>' . $data['category'] . '</PrimaryCategory><SPUId/><AssociatedSku/><Images><Image>' . $data['img_feature'] . '</Image></Images><Attributes><name>' . $data['attribute']['name'] . '</name><description>' . $data['attribute']['description'] . '</description><short_description>' . $data['attribute']['short_description'] . '</short_description><brand>' . $data['attribute']['brand'] . '</brand><delivery_option_sof>' . $data['attribute']['delivery'] . '</delivery_option_sof><warranty_type>' . $data['attribute']['warranty'] . '</warranty_type></Attributes><Skus><Sku><SellerSku>' . $data['skus']['SellerSku'] . '</SellerSku><Status>inactive</Status><size>40</size><quantity>' . $data['skus']['quantity'] . '</quantity><price>' . $data['skus']['price'] . '</price><package_length>' . $data['skus']['length'] . '</package_length><package_height>' . $data['skus']['height'] . '</package_height><package_weight>' . $data['skus']['weight'] . '</package_weight><package_width>' . $data['skus']['width'] . '</package_width><Images>' . $data['skus']['image'] . '</Images></Sku></Skus></Product></Request>';
        $params = [
            'payload' => $payload
        ];
        return LazadaTraits::callApi('https://api.lazada.vn/rest', $shop->appkey, $shop->appsecret, '/product/create', 'POST', $params, $shop->access_token);

    }


    //Hàm update sản phẩm
    public static function updateProduct($product, $image)
    {
        // itemd_id
        // sku_id
        // SellerSku
        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)) {
            return redirect('admin/lazada/authorize');
        }

        $detail_imgs = $product->images->all();

        if ($image) {
            $images = '<Images>';
            foreach ($detail_imgs as $itemImg) {
                $images .= '<Image>' . url($itemImg->path) . '</Image>';
            }
            $images .= '</Images>';
        } else {
            $images = '';
        }


        if ($product->delivery == 0) {
            $delivery = "No";
        } else {
            $delivery = "Yes";
        }


        $payload = '<Request><Product><ItemId>' . $product->item_id . '</ItemId><Attributes><name>' . $product->name . '</name><short_description>' . $product->short_description . '</short_description><description>' . strip_tags(html_entity_decode($product->description)) . '</description><delivery_option_sof>' . $delivery . '</delivery_option_sof><brand>' . $product->brand->name . '</brand><warranty_type>' . $product->warranty . '</warranty_type></Attributes><Skus><Sku><SkuId>' . $product->sku_id . '</SkuId><SellerSku>' . $product->sellerSku . '</SellerSku><quantity>' . $product->quantity . '</quantity><price>' . $product->price . '</price><package_length>' . $product->length . '</package_length><package_height>' . $product->height . '</package_height><package_weight>' . $product->weight . '</package_weight><package_width>' . $product->width . '</package_width>' . $images . '</Sku></Skus></Product></Request>';
        $params = [
            'payload' => $payload
        ];
        return LazadaTraits::callApi('https://api.lazada.vn/rest', $shop->appkey, $shop->appsecret, '/product/update', 'POST', $params, $shop->access_token);


    }


    // Hàm xem thông tên seller
    public static function getSeller()
    {
        $shop = User::find(Auth::user()->id)->lazadaShop;
        return LazadaTraits::callApi(
            'https://api.lazada.vn/rest',
            $shop->appkey,
            $shop->appsecret,
            '/seller/get',
            'GET',
            [],
            $shop->access_token);
    }


    // Hàm lấy toàn bộ sản phẩm
    public static function getProducts($filter)
    {
        $shop = User::find(Auth::user()->id)->lazadaShop;
        return LazadaTraits::callApi(
            'https://api.lazada.vn/rest',
            $shop->appkey,
            $shop->appsecret,
            '/products/get',
            'GET',
            ['filter' => $filter],
            $shop->access_token
        );
    }

    //Hàm  đặt trạng thái sản phẩm
    public static function statusProduct($product, $status)
    {

        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)) {
            return redirect('admin/lazada/authorize');
        }

        $payload = '<Request><Product><ItemId>' . $product->item_id . '</ItemId><Skus><Sku><SkuId>' . $product->sku_id . '</SkuId><SellerSku>' . $product->sellerSku . '</SellerSku><Status>' . $status . '</Status></Sku></Skus></Product></Request>';


        $params = [
            'payload' => $payload
        ];
        return LazadaTraits::callApi('https://api.lazada.vn/rest', $shop->appkey, $shop->appsecret, '/product/update', 'POST', $params, $shop->access_token);


    }

    // Hàm xóa sản phẩm
    public static function remove($product)
    {
        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)) {
            return redirect('admin/lazada/authorize');
        }

        //[\"SkuId_1717024314_7647585635\"]
        $seller_sku_list = "[\"SkuId_" . $product->item_id . "_" . $product->sku_id . "\"]";
        $params = [
            'seller_sku_list' => $seller_sku_list
        ];

        return LazadaTraits::callApi('https://api.lazada.vn/rest', $shop->appkey, $shop->appsecret, '/product/remove', 'POST', $params, $shop->access_token);
    }


    // Hàm tự động lấy các đẩy sản phẩm vào csdl có status là all(inactive,active)
    public static function autoGetProduct()
    {
        $json = LazadaTraits::getProducts('all');
        if (isset($json['data']['products'])) {
//            dd($json);
            foreach ($json['data']['products'] as $item) {
                $product = Product::where('item_id', $item['item_id'])->first();

                // không có sản phẩm thì tạo mới
                !isset($product)?ProductFunc::createProduct($item):ProductFunc::updateProduct($item);

            }
        }

    }

    public static function checkDelete($item_id){
        $json = LazadaTraits::getProducts('deleted');
        $products = $json['data']['products'];
        if (isset($products)){
            foreach($products as $product){
                if ($item_id == $product['item_id']){
                    return true;
                }
            }
        }
//        dd($json['data']['products']);

        return false;
    }

    public static function getProductItem($item_id,$seller_sku){
        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)) {
            return redirect('admin/lazada/authorize');
        }
        $param = [
            'item_id' => $item_id,
            'seller_sku' => $seller_sku
        ];
        return LazadaTraits::callApi('https://api.lazada.vn/rest', $shop->appkey, $shop->appsecret,'/product/item/get','GET',$param,$shop->access_token);
    }
}

