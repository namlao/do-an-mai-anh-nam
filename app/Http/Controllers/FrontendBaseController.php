<?php

namespace App\Http\Controllers;

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

    public function __construct(Category $category,Product $product)
    {
        $this->category = $category;
        $this->product = $product;

        $categories = $this->category->get()->toTree();
        $productBestSeller = $this->product->orderBy('buyer','desc')->take(5)->get();
        View::share([
            'categories' => $categories,
            'productBestSeller' => $productBestSeller,
        ]);
    }
}
