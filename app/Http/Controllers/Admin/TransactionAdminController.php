<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class TransactionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = TransactionDetail::all();
        return view('pages.admin.transaction.member', [
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
        $details = TransactionDetail::findOrFail($id);
        // $product = Products::all();
        return view('pages.admin.transaction.detail', [
            'detail' => $details,
            // 'products' => $product,
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

    public function print_transaction()
    {   
        // $path = base_path('/public/images/logo.png');
        $path = url('/images/logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $transaction = TransactionDetail::all();
        $revenue = $transaction->reduce(function($carry, $item) {
            return $carry + $item->total_price;
        });
        // return view('pdf', [
        //     'transactions' => $transaction,
        //     'revenue' => $revenue,
        // ], compact('pic'));
        $pdf= PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pdf-transaction', [
            'transactions' => $transaction,
            'revenue' => $revenue,
        ], compact('pic'))->setPaper('a4', 'landscape');
        // return $pdf->stream();
        return $pdf->download('laporan-transasaksi-member.pdf');
    }
}
