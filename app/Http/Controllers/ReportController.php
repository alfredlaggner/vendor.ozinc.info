<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaleInvoice;
use App\SalesOrder;
use App\Customer;
use App\Exports\SalesLines;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $defaultFrom = (new Carbon('first day of last month'))->format('m-d-Y');
        $defaultTo = new Carbon(now()->toDateString('m-d-Y'));

        if ($request->session()->exists('data')) {
            $data = $request->session()->get('data');
        } else {
            $defaultFrom = (new Carbon('first day of last month'))->format('m-d-Y');
            $defaultTo = new Carbon(now()->toDateString('m-d-Y'));
            $data = [
                'dateFrom' => $request->get('dateFrom') ? $request->get('dateFrom') : $defaultFrom,
                'dateTo' => $request->get('dateTo') ? $request->get('dateTo') : $defaultTo,
                'customer' => $request->get('customer') ? $request->get('customer') : 0,
            ];
        }
        return view('reports.enterSalesMargins', ['data' => $data, 'defaultFrom' => $defaultFrom, 'defaultTo' => $defaultTo]);

    }

    public function displaySalesMargins(Request $request)
    {
        if ( \Auth::user()->name  == 'Allegiance Wellness') {
            $product_name = 'Allegiance Wellness';
        } elseif (\Auth::user()->name == 'Can of Bliss') {
            $product_name = 'Can of Bliss';
        } else {
            print ('Access not allowed');
            return;
        }
   //     dd($product_name);

        $defaultFrom = (new Carbon('first day of last month'))->format('Y-m-d');
        $defaultTo = new Carbon(now()->toDateString('Y-m-d'));

        $data = [
            'dateFrom' => $request->get('dateFrom') ? $request->get('dateFrom') : $defaultFrom,
            'dateTo' => $request->get('dateTo') ? $request->get('dateTo') : $defaultTo,
            'customer' => $request->get('customer') ? $request->get('customer') : 0,
        ];
        session(['data' => $data]);
        $customer = $data['customer'];
        $sline = SaleInvoice::whereHas('customer')->
        where('order_date', '>=', $data['dateFrom'])
            ->where('order_date', '<=', $data['dateTo'])
            ->whereRaw("name LIKE '%" . $product_name . "%'")
            ->orderby('customer_id', 'asc')
            ->get();
        $itemCount = $sline->count();
      //  dd($itemCount);
        if ($itemCount) {
            if ($request->get('display') == 'display') {
                return view('reports.displaySalesMargins', compact('sline', 'data', 'salesperson_name', 'itemCount'));
            } else {
                return \Excel::download(new SalesLines($sline), 'customer_sales.xlsx');
            }
        } else {
            return view('nothing_found');
        }

    }

    public function show(Request $request)
    {
        $search = $request->get('q');
        $sline = SaleInvoice::search($search)->get();

        return view('reports.displaySalesMargins', compact('sline'));
    }

    public function displaySalesOrder($order_id)
    {
        $sos = SalesOrder::where('sales_order_id', $order_id)->get();
        foreach ($sos as $so) {
            $o = $so;
        }

        $sline = SaleInvoice::where('order_id', $order_id)->get();
        //	dd('xxx');
        return view('reports.displaySalesOrder', compact('sline', 'o'));
    }

    public function go_back()
    {
        url()->previous();
    }
}
