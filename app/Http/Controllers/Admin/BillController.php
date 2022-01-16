<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    private $bill;
    public function __construct(Bill $bill)
    {
        $this->bill = $bill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */



    public function index()
    {
        //
        $bills = $this->bill->all();
        return view('backend.admin.bill.index',compact('bills'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $customer = Bill::find($id);
        $customerId = $customer->customer_id;
        $customerInfo = DB::table('customers')
            ->join('bills', 'customers.id', '=', 'bills.customer_id')
            ->select('customers.*', 'bills.id as bill_id', 'bills.total as bill_total', 'bills.note as bill_note', 'bills.status as bill_status')
            ->where('customers.id', '=', $customerId)
            ->first();

        $billInfo = DB::table('bills')
            ->join('bill_details', 'bills.id', '=', 'bill_details.bill_id')
            ->leftjoin('products', 'bill_details.product_id', '=', 'products.id')
            ->where('bills.customer_id', '=', $customerId)
            ->select('bills.*', 'bill_details.*', 'products.name as product_name')
            ->get();

        $user = User::where('id','=',$customerInfo->user_id)->first();
        $email = $user->email;
        $customerInfo->email = $email;
        $this->data['customerInfo'] = $customerInfo;
        $this->data['billInfo'] = $billInfo;
        return view('backend.admin.bill.show',$this->data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $bill =Bill::find($id);
        $billdetail = BillDetail::where('bill_id','=',$id)->first();
        $billdetail = BillDetail::find($billdetail->id);
        $bill->delete();
        $billdetail->delete();
        return back();
    }

    public function status(Request $request,$id){

        $bill = Bill::find($id);
        $bill->status = $request->status;
        $bill->update();
        return back();
    }
}
