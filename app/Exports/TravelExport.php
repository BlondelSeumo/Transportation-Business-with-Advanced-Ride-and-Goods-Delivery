<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class TravelExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
     *
     */
    public function __construct($result) {
        $this->result = $result;
    }

    public function view(): View
    {
        return view('admin.request.exports.requests', [
            'results' => $this->result
        ]);
    }
}
