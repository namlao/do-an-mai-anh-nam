<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Models\Atributes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\Tags;
use App\Models\User;
use App\Traits\LazadaTraits;
use App\Traits\ProductFunc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lazada\LazopClient;
use Lazada\LazopRequest;
use Symfony\Component\HttpFoundation\Session\Session;
use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    use LazadaTraits;

    private $product;
    private $category;
    private $tag;
    private $image;
    private $atribute;
    private $productImage;

    public function __construct(Product $product, Category $category, Tags $tag, Image $image, Atributes $atribute, Brand $brand, ImageProduct $productImage)
    {
        $this->product = $product;
        $this->category = $category;
        $this->tag = $tag;
        $this->image = $image;
        $this->atribute = $atribute;
        $this->productImage = $productImage;
        $this->brand = $brand;
        $this->middleware('auth');
        $this->middleware(['role:admin|content']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        LazadaTraits::autoGetProduct();
        ProductFunc::deleteProduct();

        $products = $this->product->get();

        return view('backend.admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)) {
            return redirect('admin/lazada/authorize');
        }

        $categories = $this->category->get();
        $tags = $this->tag->get();
        $brands = $this->brand->get();
        return view('backend.admin.product.add', compact('categories', 'tags', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function store(AddProductRequest $request) //
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            // X??? l?? trong b???ng product
            // X??? l?? ???nh ?????i di???n
            if ($request->hasFile('feature_image')) {
                // L???y th??ng tin file
                $oldfile = $request->feature_image;
                // ???????ng d???n ?????n th?? m???c ch???a file
                $path = 'images/products/' . Auth::user()->id;
                // ?????t t??n file: ten_product_random(10).<extension-file>
                $fileName = Str::random(20) . '.' . $oldfile->getClientOriginalExtension();
                //l??u file
                $file = $request->file('feature_image')->move($path, $fileName);
            } else {
                $file = null;
            }
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'image_feature_path' => $file,
                'quantity' => $request->quantity,
                'brand_id' => $request->brand,
                'delivery' => $request->delivery,
                'warranty' => $request->warranty,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'sellerSku' => Str::replace(' ', '-', $request->name) . '-man'
            ];
//        dd($data);
            $product = $this->product->create($data);


            // X??? l?? Tag
//            if (!empty($request->tags)){
//                foreach ($request->tags as $tagsItem){
//                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagsItem,'slug'=> Str::slug($tagsItem)]);
//                    $tagIds[] = $tagInstance->id;
//                }
//            }else{
//                $tagIds = null;
//            }
//            $product->tags()->attach($tagIds);

            // X??? l?? ???nh chi ti???t
            if (!empty($request->image_detail)) {
                foreach ($request->image_detail as $imageItem) {
                    $pathItem = 'images/products/' . Auth::user()->id;
                    // ?????t t??n file: ten_product_random(10).<extension-file>
                    $fileNameItem = Str::slug($request->name) . '_' . Str::random(10) . '.' . $imageItem->getClientOriginalExtension();
                    //l??u file
                    $fileItem = $imageItem->move($pathItem, $fileNameItem);
                    $imgInstance = $this->image->create(['path' => $fileItem]);
                    $imgIds[] = $imgInstance->id;
                }

            } else {
                $imgIds = null;
            }
            $product->images()->attach($imgIds);

            // X??? l?? Atrribute c???a s???n ph???m
            $this->atribute->create([
                'cpu' => $request->cpu,
                'ram' => $request->ram,
                'hard_drive' => $request->hard_drive,
                'screen' => $request->screen,
                'graphic_card' => $request->graphic_card,
                'connect_port' => $request->connect_port,
                'special' => $request->special,
                'os' => $request->os,
                'design' => $request->design,
                'product_id' => $product->id
            ]);

            DB::commit();
            $json = LazadaTraits::createProduct($product);
            if (!is_null($json)){
                if ($json['code'] == '0') {
                    $skuData = [
                        'item_id' => $json['data']['item_id'],
                        'sku_id' => $json['data']['sku_list'][0]['sku_id']
                    ];
                    $product->find($product->id)->update($skuData);
                    return redirect()->route('product.index');
                } else {
                    return back()->with('lazada',$json['message']);
                }
            }else{
                return route('product.index');
            }


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' on file: ' . $e->getFile());
        }
//        dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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


        $product = $this->product->find($id);
//        dd($product->image_feature_path);
        $categories = $this->category->get();
        $tags = $this->tag->get();
        $imgDetails = $product->images->all();
        $brands = $this->brand->get();


        return view('backend.admin.product.edit', compact('categories', 'tags', 'product', 'imgDetails', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditProductRequest $request, $id)
    {
        //

        try {
            DB::beginTransaction();
            $product = $this->product->find($id);

            // X??? l?? trong b???ng product
            // X??? l?? ???nh ?????i di???n
            if ($request->hasFile('feature_image')) {
                // L???y th??ng tin file
                $oldfile = $request->feature_image;
                // ???????ng d???n ?????n th?? m???c ch???a file
                $path = 'images/products/' . Auth::user()->id;
                // ?????t t??n file: ten_product_random(10).<extension-file>
                $fileName = Str::random(20) . '.' . $oldfile->getClientOriginalExtension();
                //l??u file
                $file = $request->file('feature_image')->move($path, $fileName);
            } else {
                $file = $product->image_feature_path;
            }
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'image_feature_path' => $file,
                'quantity' => $request->quantity,
                'brand_id' => $request->brand,
                'delivery' => $request->delivery,
                'warranty' => $request->warranty,
                'weight' => $request->weight,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ];
//        dd($data);
            $product = $this->product->find($id)->update($data);

            $product = $this->product->find($id);
//            // X??? l?? Tag
//            if (!empty($request->tags)){
//                foreach ($request->tags as $tagsItem){
//                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagsItem,'slug'=> Str::slug($tagsItem)]);
//                    $tagIds[] = $tagInstance->id;
//                }
//            }else{
//                $tagIds = null;
//            }
//            $product->tags()->sync($tagIds);
//


            // X??? l?? ???nh chi ti???t


//            dd($imgOld[0]->id);

            if ($request->hasFile('image_detail')) {
                $change = true;
                foreach ($request->image_detail as $imageItem) {
                    $this->productImage->where('product_id', $id)->delete();
                    $pathItem = 'images/products/' . Auth::user()->id;
                    // ?????t t??n file: ten_product_random(10).<extension-file>
                    $fileNameItem = Str::slug($request->name) . '_' . Str::random(10) . '.' . $imageItem->getClientOriginalExtension();
                    //l??u file
                    $fileItem = $imageItem->move($pathItem, $fileNameItem);
                    $imgInstance = $this->image->create(['path' => $fileItem]);
                    $imgIds[] = $imgInstance->id;
                }

            } else {
                $change = false;
                foreach ($product->images as $test) {
                    $imgIds[] = $test->id;
                }
            }
            $product->images()->sync($imgIds);

            // X??? l?? Atrribute c???a s???n ph???m
            $this->atribute->update([
                'cpu' => $request->cpu,
                'ram' => $request->ram,
                'hard_drive' => $request->hard_drive,
                'screen' => $request->screen,
                'graphic_card' => $request->graphic_card,
                'connect_port' => $request->connect_port,
                'special' => $request->special,
                'os' => $request->os,
                'design' => $request->design,
                'product_id' => $product->id
            ]);
            DB::commit();
            if (!is_null($product->item_id)) {
                $json = LazadaTraits::updateProduct($product, $change);
                if ($json['code'] == "0") {
//                    dd('hihihi');
                    return redirect('admin/product');
                } else {
                    request()->session()->flash('message',$json['message']);
                    return back()->with('message');
                }
            }


        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage() . ' Line: ' . $e->getLine() . ' on file: ' . $e->getFile());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        if ($product->item_id) {
            LazadaTraits::remove($product);
        }

        $product->delete();


        return redirect()->route('product.index');


    }

    public function sync($id){
        $product = $this->product->find($id);
        $json = LazadaTraits::createProduct($product);
        if(is_null($json)){
            return redirect('admin/product')->with('lazadaError','Kh??ng th??? k???t n???i ???????c v???i Lazada');
        }
        if ($json['code'] == '0') {
            $skuData = [
                'item_id' => $json['data']['item_id'],
                'sku_id' => $json['data']['sku_list'][0]['sku_id']
            ];
            $product->update($skuData);
            return redirect()->route('product.index');
        }
        return back();

    }
}
