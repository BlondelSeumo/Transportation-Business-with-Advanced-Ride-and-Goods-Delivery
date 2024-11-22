<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Request\Request as req;
use App\Models\Request\RequestBill as r1;
use App\Models\User;
use App\Models\Admin\Driver;

class InvoiceController2 extends Controller
{
    public function download($item)
    {

        $query=req::where( 'id',$item)->first();
        $query1=r1::where( 'request_id',$item)->first();

        $user=user::where('id', $query->user_id)->first();
        $driver=driver::where('id', $query->driver_id)->first();
        // dd( $user->name,$driver->name);
        $currentDateTime = date('Y-m-d H:i:s');

// dd($query1);
        $data = [
            'title' => 'Invoice Details',
            'id' => $query->id,
            'service_tax' => $query1->service_tax,
            'Base Price' => $query1->base_price,
            'promo_discount' => $query1->promo_discount,
            'Base Distance' => $query1->admin_commision,
            'Total Distance' => $query1->driver_commision,
            'Total Time' => $query1->total_amount,
            'currentDateTime' => $currentDateTime,

        ];


// dd( $data);

        $pdf = PDF::loadView('invoice',compact( 'data',  'user','driver'));

        return $pdf->download('invoice.pdf');
    }
}

