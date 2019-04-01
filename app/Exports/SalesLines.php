<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesLines implements FromView
{
	private $sline;

	public function __construct($sline)
	{
		$this->sline = $sline;
	}


    public function view(): View
    {
        return view('reports.exportSalesMargins',['sline' => $this->sline]);
    }
}
