<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Account;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "";

        $supplier = Account::where('account_type', 'purchaser')->get();
        return view("purchase.supplier.index", compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("purchase.supplier.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validate = $req->validate([
            'name' => 'required',
            'opening_balance' => 'required',
        ]);
        if ($validate) {
            $account = new Account();
            $user_id = Auth::user()->id;
            $account->account_type = "purchaser";
            $account->name = ucfirst($req->name);
            $account->phone = $req->phone;
            $account->opening_balance = $req->opening_balance;
            $account->user_id = $user_id;
            $save = $account->save();
            if ($save) {
                return redirect('/suppliers')->with('message', "Supplier Created Successfully..!");
            } else {
                return redirect('/suppliers/create');
            }
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $supplier = Account::where('id', $id)->get();
        return view('purchase.supplier.edit', ['supplier' => $supplier]);
    }


    public function update(Request $req, $id)
    {
        $validate = $req->validate([
            'name' => 'required',
            'opening_balance' => 'required',
        ]);
        if ($validate) {
            $update = DB::table('accounts')->where('id', $id)->update([
                'name' => $req->name,
                'phone' => $req->phone,
                'opening_balance' => $req->opening_balance,
                'user_id' => Auth::user()->id,
            ]);
            if ($update) {
                return redirect('/suppliers')->with('message', "Supplier Updated Successfully");
            } else {
                return redirect('/suppliers/create');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        if ($account->account_type == 'purchaser') {
            $count = Purchase::where('supplier_id', $id)->delete();


            Payment::where('account_id', $id)->where('payment_type', 'send')->delete();
            if ($account->delete()) {
                return redirect()->back()->with(['message' => ' supplier deleted successfully..!', 'type' => 'success']);
            }
        }
    }
}
