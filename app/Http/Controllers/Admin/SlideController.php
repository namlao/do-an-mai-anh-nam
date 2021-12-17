<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddSlideRequest;
use App\Http\Requests\EditSlideRequest;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    /**
     * @var Slide
     */
    private $slide;

    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $slides = $this->slide->all();
        return view('backend.admin.slide.index',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.admin.slide.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddSlideRequest $request)
    {
        //
        if (is_null($request->display)){
            $display = 0;
        }else{
            $display = 1;
        }

        if($request->hasFile('img_slide_path')){
            // Lấy thông tin file
            $oldfile = $request->img_slide_path;
            // đường dẫn đến thư mục chứa file
            $path = 'images/slider/'.Auth::user()->id;
            // đặt tên file: ten_product_random(10).<extension-file>
            $fileName = Str::random(20).'.'.$oldfile->getClientOriginalExtension();
            //lưu file
            $file = $request->file('img_slide_path')->move($path, $fileName);
        }else{
            $file = null;
        }
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'display' => $display,
            'img_slide_path' => $file
        ];
        $this->slide->create($data);
        return redirect()->route('slider.index');

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
        $slide = $this->slide->find($id);
        return view('backend.admin.slide.edit',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditSlideRequest $request, $id)
    {

        if(is_null($request->display)){
            $display = 0;
        }else{
            $display = 1;
        }

        if($request->hasFile('img_slide_path')){
            // Lấy thông tin file
            $oldfile = $request->img_slide_path;
            // đường dẫn đến thư mục chứa file
            $path = 'images/slider/'.Auth::user()->id;
            // đặt tên file: ten_product_random(10).<extension-file>
            $fileName = Str::random(20).'.'.$oldfile->getClientOriginalExtension();
            //lưu file
            $file = $request->file('img_slide_path')->move($path, $fileName);
        }else{
            $file = null;
        }
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'display' => $display,
            'img_slide_path' => $file
        ];
        $this->slide->find($id)->update($data);
        return redirect()->route('slider.index');

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
        $this->slide->find($id)->delete();
        return redirect()->route('slider.index');
    }
}
