<?php

namespace App\Http\Controllers;

use App\Models\BookerPayment;
use App\Models\Bill;
use App\Models\OrderBooker;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookerPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('booker-payments.index');
    }
    public function getPayment()
    {

        $payments =  BookerPayment::with('getBooker')->orderBy('id', 'desc');
        return  datatables($payments)
            ->addColumn('actions', function ($payments) {
                return '
                <div class="dropdown d-inline-block"><button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-more-fill align-middle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">

                  <li><a href="' . route('ordersbookers.payment.edit', $payments->id) . '" class="dropdown-item edit-item-btn"><i class="ri-edit-box-line"></i>&nbsp; Edit</a></li>
                   <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#delete' . $payments->id . '" class="dropdown-item edit-item-btn"><i class="ri-delete-bin-line"></i> &nbsp; Delete</a></li>
                </ul>
            </div>

            <div class="modal fade" id="delete' . $payments->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Payment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Do you really want to delete this bill?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <form action="' . route('orderbookers.payment.destroy', $payments->id) . '" method="post">
                  ' . csrf_field() . '
                  ' . method_field("DELETE") . '
                    <input type="submit" name="" id="" value="DELETE" class="btn btn-danger">
                </form></div>
              </div>
            </div>
          </div>
            ';
            })

            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookers = OrderBooker::all();

        return view('booker-payments.create',compact('bookers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     try{

         $request->validate([
             'booker'=>'required',
        'date'=>'required',
        'amount'=>'required',
     ]);
     BookerPayment::create([
        'booker_id'=>$request->booker,
        'amount'=>$request->amount,
        'date'=>$request->date,
        'description'=>$request->description,
        'added_by'=>Auth::user()->id,
    ]);
        return redirect()->route('orderbookers.payment.index')->with('success','payment added success..!');
}catch(Exception $ex){
    return redirect()->back()->with('error',$ex->getMessage());
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payments =BookerPayment::where('id',$id)->get();
        $bookers= OrderBooker::all();

        return view('booker-payments.edit',compact('payments','bookers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $request->validate([
                'booker'=>'required',
           'date'=>'required',
           'amount'=>'required',
        ]);
        BookerPayment::where('id',$id)->update([
           'booker_id'=>$request->booker,
           'amount'=>$request->amount,
           'date'=>$request->date,
           'description'=>$request->description,
           'added_by'=>Auth::user()->id,
       ]);
           return redirect()->route('orderbookers.payment.index')->with('success','payment updated success..!');
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            BookerPayment::find($id)->delete();
            return redirect()->back()->with('success','payment deleted successfully..!');
        }catch(Exception $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }
}
