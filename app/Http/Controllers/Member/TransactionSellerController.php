<?php

namespace App\Http\Controllers\Member;

use PDF;
use App\Models\Regency;
use App\Models\District;
use App\Models\Products;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransactionRequest;

class TransactionSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('product', function($transaction) {
                            $transaction->where('users_id', Auth::user()->id);
                        })->orderBy('created_at', 'desc')->take(5)->get();

        return view('pages.member.transaction.seller', [
            'transactions' => $transaction
        ], compact('transaction'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Transaction::findOrFail($id);
        $transactions = TransactionDetail::findOrFail($id);
        return view('pages.member.transaction.detail-my-transaction', [
            'invoice' => $invoice,
            'transactions' => $transactions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = TransactionDetail::findOrFail($id);
        return view('pages.member.transaction.edit', [
            'transactions' => $transaction,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->all();
        $transaction = TransactionDetail::findOrFail($id);
        $transaction->update($data);

        return redirect()->route('transaction-seller.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function cetak_pdf()
    {   
        // $path = base_path('/public/images/logo.png');
        $path = url('/images/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // $transaction = Transaction::all()->whereIn('users_id', Auth::user()->id);
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('product', function($transaction) {
                $transaction->where('users_id', Auth::user()->id);
            })->orderBy('created_at', 'desc')->take(5)->get();
        $revenue = $transaction->reduce(function($carry, $item) {
            return $carry + $item->transaction->total_price + $item->transaction->code_unique + $item->transaction->admin_fee;
        });
        // return view('pdf-transaction-customer', [
        //     'transactions' => $transaction,
        //     'revenue' => $revenue,
        // ], compact('pic'));
        $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf-transaction-customer', [
            'transactions' => $transaction,
            'revenue' => $revenue,
        ], compact('pic'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('Laporan Transasaksi Penjualan ' . Auth::user()->name . '.pdf');
    }


    public function my_pdf()
    {   
        // $path = base_path('/public/images/logo.png');
        $path = url('/images/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
            ->whereHas('transaction', function($transaction) {
                $transaction->where('users_id', Auth::user()->id);
            })->orderBy('created_at', 'desc')->take(5)->get();
        $revenue = $transaction->reduce(function($carry, $item) {
            return $carry + $item->transaction->total_price + $item->transaction->code_unique + $item->transaction->admin_fee;
        });
        // return view('pdf-my-transaction', [
        //     'transactions' => $transaction,
        //     'revenue' => $revenue,
        // ], compact('pic'));
        $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf-my-transaction', [
            'transactions' => $transaction,
            'revenue' => $revenue,
        ], compact('pic'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('Laporan Transasaksi Saya ' . Auth::user()->name . '.pdf');
    }
}
