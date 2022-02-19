<?php
namespace App\Traits;

use App\Models\Atributes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Random;

trait ProductFunc
{
    static function searchBrand($name)
    {
        $brand = Brand::where('name', $name)->first();

        return $brand->id;
    }

    static function searchCategory($id)
    {
        $category = Category::where('lzd_category_id', $id)->first();
        return $category->id;
    }

    static function file_get_contents_curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    static function saveFile($url,$name){
        //https://vn-live.slatic.net/p/d4cd4728ee601666bc30b1260f20daa9.jpg
        $data = ProductFunc::file_get_contents_curl ($url);
        $name = Str::slug($name);
        $name .= '-'.Str::random(5);
        $fp = public_path('images/products/'.Auth::user()->id.'/'.$name.'.jpg');
        file_put_contents( $fp, $data );
        // Function to write image into file
        file_put_contents( $fp, $data );

        return 'images/products/'.Auth::user()->id.'\\'.$name.'.jpg';
    }

    public static function deleteProduct(){
        $products = Product::all();

        foreach ($products as $product){
            if(LazadaTraits::checkDelete($product->item_id)){
                Product::find($product->id)->delete();
//                var_dump($product->id.': '.LazadaTraits::checkDelete($product->item_id));
            }

        }
    }

    // có khi trong thùng rác có sp, không có khi trong thùng rác không co sản phẩm
    public static function checkTrashProduct($item_id){
        $product = Product::withTrashed()->where('item_id',$item_id)->first();
        if ($product){
            return true;
        }
        return false;
    }

    public static function createProduct($item)
    {
        $data = [
            'name' => $item['attributes']['name'],
            'description' => $item['attributes']['description'] ?? '',
            'short_description' => isset($item['attributes']['short_description']) ? strip_tags($item['attributes']['short_description']): '',
            'brand_id' => ProductFunc::searchBrand($item['attributes']['brand']),
            'warranty' => $item['attributes']['warranty_type'],
            'category_id' => ProductFunc::searchCategory($item['primary_category']),
            'image_feature_path' => ProductFunc::saveFile($item['images'][0],$item['attributes']['name']),
            'price' =>  $item['skus'][0]['price'],
            'quantity' => $item['skus'][0]['quantity'],
            'delivery' => 0,
            'weight' => $item['skus'][0]['package_weight'],
            'length' => $item['skus'][0]['package_length'],
            'width' => $item['skus'][0]['package_width'],
            'height' => $item['skus'][0]['package_height'],
            'item_id' => $item['item_id'],
            'sku_id' => $item['skus'][0]['SkuId'],
            'sellerSku' => $item['skus'][0]['SellerSku'],

        ];
        $product = Product::create($data);
        Atributes::create(['product_id'=>$product->id ]);

    }

    public static function updateProduct($item){
        $product = Product::where('item_id', $item['item_id'])->first();

        Product::find($product->id)->update([
            'name' => $item['attributes']['name'],
            'description' => $item['attributes']['description'] ?? '',
            'short_description' => isset($item['attributes']['short_description']) ? strip_tags($item['attributes']['short_description']): '',
            'brand_id' => ProductFunc::searchBrand($item['attributes']['brand']),
            'warranty' => $item['attributes']['warranty_type'],
            'category_id' => ProductFunc::searchCategory($item['primary_category']),
            'image_feature_path' => $product->image_feature_path,
            'price' =>  $item['skus'][0]['price'],
            'quantity' => $item['skus'][0]['quantity'],
            'delivery' => 0,
            'weight' => $item['skus'][0]['package_weight'],
            'length' => $item['skus'][0]['package_length'],
            'width' => $item['skus'][0]['package_width'],
            'height' => $item['skus'][0]['package_height'],
            'item_id' => $item['item_id'],
            'sku_id' => $item['skus'][0]['SkuId'],
            'sellerSku' => $item['skus'][0]['SellerSku'],

        ]);
    }



}
