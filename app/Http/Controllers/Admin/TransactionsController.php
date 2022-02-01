<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionsController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = TransactionDetail::with(['product', 'transaction'])->get();

            return DataTables::of($query)
                    ->addColumn('action', function($item){
                        return '
                        <div class="action">
                        <a href="' . route('products-admin.edit', $item->id) . '" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                        <a href="#" data-url="'. route('products-admin.destroy', $item->id) . '" data-id="' .$item->id. '" data-token="' . csrf_token() . '" id="hapus" class="hapus btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                        </div>
                        ';
                    })
                    ->rawColumns(['action'])
                    ->make();
        }

        $item = TransactionDetail::with(['product', 'transaction'])->get();
        return view('pages.admin.transaction.seller', compact('item'));
    }
}
