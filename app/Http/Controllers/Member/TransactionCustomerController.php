<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('transaction', function($transaction) {
                            $transaction->where('users_id', Auth::user()->id);
                        })->orderBy('created_at', 'desc')->take(5)->get();
        return view('pages.member.transaction.customer', [
            'transactions' => $transaction,
        ], compact('transaction'));
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Transaction::findOrFail($id);
        $transactions = TransactionDetail::findOrFail($id);
        // $product = Products::findOrFail($id);
        return view('pages.member.transaction.detail-transaction', [
            'invoice' => $invoice,
            'transactions' => $transactions,
            // 'product' => $product,
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

        $transaction = TransactionDetail::with(['transaction.user', 'product.galleries'])
                        ->whereHas('transaction', function($transaction) {
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
        return $pdf->download('Laporan Transasaksi Penjualan Customer ' . Auth::user()->name . '.pdf');
    }
}
