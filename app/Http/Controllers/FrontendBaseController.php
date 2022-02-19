<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class FrontendBaseController extends Controller
{
    //
    private $category;
    private $product;
    private $brand;

    public function __construct(Category $category,Product $product,Brand $brand)
    {
        $this->category = $category;
        $this->product = $product;
        $this->brand = $brand;

        $categories = $this->category->get()->toTree();
        $productBestSeller = $this->product->orderBy('buyer','desc')->take(5)->get();
        $productInStock = $this->product->where('quantity','>',0)->count();
        $productOutOfStock = $this->product->where('quantity','=',0)->count();
        $products = $this->product->count();
        $brands = $this->brand->get();
        View::share([
            'categories' => $categories,
            'productBestSeller' => $productBestSeller,
            'productInStock' => $productInStock,
            'productOutOfStock' => $productOutOfStock,
            'products' => $products,
            'brands' => $brands,
        ]);
    }
}
