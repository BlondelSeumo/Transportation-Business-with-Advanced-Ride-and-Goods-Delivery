<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Config;

class DriverExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
     *
     */
    public function __construct($result) {
        $this->result = $result;
        $this->app_for = config('app.app_for');
    }

    public function view(): View
    {
        return view('admin.drivers.exports.driver', [
            'results' => $this->result,
            'app_for' => $this->app_for,
        ]);
    }
}
