<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->middleware('auth');
        $this->middleware(['role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comments = $this->comment->get();

        return view('backend.admin.comment.index', compact('comments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,$product)
    {

        //
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'rate' => $request->rate,
            'product_id' => $product
        ];
        $this->comment->create($data);
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $comment = $this->comment->find($id);
        $comment -> delete($id);
        return redirect()->back();
    }
}
