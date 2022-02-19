<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use App\Models\LazadaShop;
use App\Models\User;
use App\Traits\LazadaTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Lazada\UrlConstants;
use function PHPUnit\Framework\isNull;

class CategoryController extends Controller
{
    private $category;
    use LazadaTraits;
    public function __construct(Category $category)
    {
        $this->middleware('auth');
        $this->middleware(['role:admin|content']);
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = $this->category->with('ancestors')->paginate(15);
        return view('backend.admin.category.index',compact('categories'));
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
        if (!isNull($shop)){
            return redirect('admin/lazada/authorize');
        }
        $categoryLzd  = LazadaTraits::callApi(
            UrlConstants::$api_gateway_url_vn,
            $shop->appkey,
            $shop->appsecret,
            '/category/tree/get',
            'GET',
            ['language_code'=>'en_US']
        );
        $cateLzd = [$categoryLzd['data'][6],$categoryLzd['data'][18],$categoryLzd['data'][39]];
//        dd($cateLzd);
//         dd($cateLzd[0]['children'][0]['children']);
//         dd($cateLzd[1]['children'][0]['children']);
//         dd($cateLzd[2]['children'][0]['children']);
        $categories = $this->category
            ->with('ancestors')
            ->get();
        return view('backend.admin.category.add',compact('categories','cateLzd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddCategoryRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $category = $this->category->create([
                'name' => $request->name,
                'slug'=> Str::slug($request->name),
                'lzd_category_id' => $request->lazshop_cate_id,
            ]);
            if ($request->parent_id){
                $node = $this->category->find($request->parent_id);
                $node->appendNode($category);
            }
            DB::commit();
            return redirect()->route('category.index');
        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Error in '.$e->getMessage().' line: '.$e->getLine().' in file '.$e->getFile());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        $shop = User::find(Auth::user()->id)->lazadaShop;
        if (!isNull($shop)){
            return redirect('admin/lazada/authorize');
        }
        $categoryLzd  = LazadaTraits::callApi(
            UrlConstants::$api_gateway_url_vn,
            $shop->appkey,
            $shop->appsecret,
            '/category/tree/get',
            'GET',
            ['language_code'=>'en_US']
        );
        $cateLzd = [$categoryLzd['data'][6],$categoryLzd['data'][18],$categoryLzd['data'][39]];

        $categoryItem = $this->category->find($id);
        $categories = $this->category
            ->get();
        return view('backend.admin.category.edit',compact('categories','categoryItem','cateLzd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditCategoryRequest $request, $id)
    {
        //

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $request->parent_id,
            'lzd_category_id' => $request->lazshop_cate_id,

        ];
        Category::find($id)->update($data);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $this->category->find($id)->delete();
        return redirect()->route('category.index');
    }

}
