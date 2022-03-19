<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use PDF;

class TransactionSellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::whereHas('product', function($product) {
            $product->where('users_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('pages.member.transaction.edit', [
            'transaction' => $transaction,
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
        $transaction = Transaction::findOrFail($id);
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
        $path = base_path('/public/images/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        // $transaction = Transaction::all()->whereIn('users_id', Auth::user()->id);
        $transaction = Transaction::whereHas('product', function($product) {
            $product->where('users_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();
        $revenue = $transaction->reduce(function($carry, $item) {
            return $carry + $item->total_price;
        });
        // return view('pdf', [
        //     'transactions' => $transaction,
        //     'revenue' => $revenue,
        // ], compact('pic'));
        $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf-transaction-customer', [
            'transactions' => $transaction,
            'revenue' => $revenue,
        ], compact('pic'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('Laporan Transasaksi Penjualan Seller ' . Auth::user()->name . '.pdf');
        
    }


    public function my_pdf()
    {   
        $path = base_path('/public/images/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $transaction = Transaction::all()->whereIn('users_id', Auth::user()->id);
        // $transaction = Transaction::whereHas('product', function($product) {
        //     $product->where('users_id', auth()->id());
        // })->orderBy('created_at', 'asc')->get();
        $revenue = $transaction->reduce(function($carry, $item) {
            return $carry + $item->total_price;
        });
        // return view('pdf', [
        //     'transactions' => $transaction,
        //     'revenue' => $revenue,
        // ], compact('pic'));
        $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf-my-transaction', [
            'transactions' => $transaction,
            'revenue' => $revenue,
        ], compact('pic'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('Laporan Transasaksi Saya.pdf');
    }
}
