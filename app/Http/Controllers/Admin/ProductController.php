<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Atributes;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $product;
    private $category;
    private $tag;
    private $image;
    private $atribute;

    public function __construct(Product $product,Category $category,Tags $tag,Image $image,Atributes $atribute)
    {
        $this->product = $product;
        $this->category = $category;
        $this->tag = $tag;
        $this->image = $image;
        $this->atribute = $atribute;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = $this->product->get();
        return view('backend.admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = $this->category->get();
        $tags = $this->tag->get();
        return view('backend.admin.product.add',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // Xử lý trong bảng product
            // Xử lý ảnh đại diện
            if($request->hasFile('feature_image')){
                // Lấy thông tin file
                $oldfile = $request->feature_image;
                // đường dẫn đến thư mục chứa file
                $path = 'images/products/'.Auth::user()->id;
                // đặt tên file: ten_product_random(10).<extension-file>
                $fileName = Str::random(20).'.'.$oldfile->getClientOriginalExtension();
                //lưu file
                $file = $request->file('feature_image')->move($path, $fileName);
            }else{
                $file = null;
            }
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'description' => $request->description,
                'image_feature_path' => $file
            ];
//        dd($data);
            $product = $this->product->create($data);
            // Xử lý Tag
            if (!empty($request->tags)){
                foreach ($request->tags as $tagsItem){
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagsItem,'slug'=> Str::slug($tagsItem)]);
                    $tagIds[] = $tagInstance->id;
                }
            }else{
                $tagIds = null;
            }
            $product->tags()->attach($tagIds);

            // Xử lý ảnh chi tiết
            if (!empty($request->image_detail)){
                foreach ($request->image_detail as $imageItem){
                    $pathItem = 'images/products/'.Auth::user()->id;
                    // đặt tên file: ten_product_random(10).<extension-file>
                    $fileNameItem = Str::slug($request->name).'_'.Str::random(10).'.'.$imageItem->getClientOriginalExtension();
                    //lưu file
                    $fileItem = $imageItem->move($pathItem, $fileNameItem);
                    $imgInstance = $this->image->create(['path'=>$fileItem]);
                    $imgIds[] = $imgInstance->id;
                }

            }else{
                $imgIds = null;
            }
            $product->images()->attach($imgIds);

            // Xử lý Atrribute của sản phẩm
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
                'weight' => $request->weight,
                'product_id' => $product->id
            ]);
            DB::commit();
            return redirect()->route('product.index');
        }catch (\Exception $e ){
            DB::rollBack();
            Log::error('Error: '.$e->getMessage().' Line: '.$e->getLine().' on file: '.$e->getFile());
        }
//        dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
        return view('backend.admin.product.edit',compact('categories','tags','product','imgDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        try {
            DB::beginTransaction();

            // Xử lý trong bảng product
            // Xử lý ảnh đại diện
            if($request->hasFile('feature_image')){
                // Lấy thông tin file
                $oldfile = $request->feature_image;
                // đường dẫn đến thư mục chứa file
                $path = 'images/products/'.Auth::user()->id;
                // đặt tên file: ten_product_random(10).<extension-file>
                $fileName = Str::random(20).'.'.$oldfile->getClientOriginalExtension();
                //lưu file
                $file = $request->file('feature_image')->move($path, $fileName);
            }else{
                $file = null;
            }
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category,
                'description' => $request->description,
                'image_feature_path' => $file
            ];
//        dd($data);
            $product = $this->product->find($id)->update($data);
            $product = $this->product->find($id);
            // Xử lý Tag
            if (!empty($request->tags)){
                foreach ($request->tags as $tagsItem){
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagsItem,'slug'=> Str::slug($tagsItem)]);
                    $tagIds[] = $tagInstance->id;
                }
            }else{
                $tagIds = null;
            }
            $product->tags()->sync($tagIds);

            // Xử lý ảnh chi tiết
            if (!empty($request->image_detail)){
                foreach ($request->image_detail as $imageItem){
                    $pathItem = 'images/products/'.Auth::user()->id;
                    // đặt tên file: ten_product_random(10).<extension-file>
                    $fileNameItem = Str::slug($request->name).'_'.Str::random(10).'.'.$imageItem->getClientOriginalExtension();
                    //lưu file
                    $fileItem = $imageItem->move($pathItem, $fileNameItem);
                    $imgInstance = $this->image->create(['path'=>$fileItem]);
                    $imgIds[] = $imgInstance->id;
                }

            }else{
                $imgIds = null;
            }
            $product->images()->sync($imgIds);

            // Xử lý Atrribute của sản phẩm
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
                'weight' => $request->weight,
                'product_id' => $product->id
            ]);
            DB::commit();
            return redirect()->route('product.index');
        }catch (\Exception $e ){
            DB::rollBack();
            Log::error('Error: '.$e->getMessage().' Line: '.$e->getLine().' on file: '.$e->getFile());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        $product->delete();
        return redirect()->route('product.index');


    }
}
