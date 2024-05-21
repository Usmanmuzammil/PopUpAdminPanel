<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $user_id=Auth::user()->id;
        $account=Account::where('account_type','shop-account')->orderBy('id','DESC')->get();
        return view("accounts.index",compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("accounts.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validate=$req->validate([
            'name'=>'required',
            'opening_balance'=>'required',
        ]);
        if($validate){
            $account=new Account();
           $user_id= Auth::user()->id;
            $account->account_type='shop-account';
            $account->name=ucfirst($req->name);
            $account->account_no=$req->account_no;
            $account->phone=$req->phone;
            $account->opening_balance=$req->opening_balance;
            $account->user_id=$user_id;
            $save=$account->save();
            if($save){
                return redirect('/account')->with(['success'=>"Account Created Successfully..!",'type'=>'success']);
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
        $account=Account::where('id',$id)->get();
     return view('accounts.edit',['account'=>$account]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validate=$req->validate([
            'account_no'=>'required',
            'name'=>'required',
            'opening_balance'=>'required',
        ]);
        if($validate){
            $update=DB::table('accounts')->where('id',$id)->update([
                'account_no'=>$req->account_no,
                'name'=>$req->name,
                'opening_balance'=>$req->opening_balance
            ]);
            if($update){
                return redirect()->route('account.index')->with(['success'=>"Account Updated Successfully..",'type'=>'success']);
            }else{
                return redirect()->back();
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



        $count= Bill::where('pay_account_id',$id)->count();
        if( intval($count) > 0){
            return redirect()->back()->with(['danger'=>'Cant Delete this account, this account is in use','type'=>'danger']);
        }else{

            $delete=Account::where('id',$id)->delete();

            if($delete){
                return redirect('/account')->with('danger','Account Deleted Successfully..');
            }
        }

    }

    public function update_account_status(Request $request)
    {
        // Set the status of all accounts to '1' (off) except the selected account
        Account::where('id', '!=', $request->accountId)->update(['status' => 1]);

        // Set the status of the selected account to 'default'
        Account::where('id', $request->accountId)->update(['status' => 'default']);

        return "done";
    }



}
