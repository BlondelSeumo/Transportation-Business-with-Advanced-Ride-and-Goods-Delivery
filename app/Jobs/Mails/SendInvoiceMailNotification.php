<?php

namespace App\Jobs\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Models\Master\MailTemplate;
use Illuminate\Support\Facades\Log;


class SendInvoiceMailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request_detail;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request_detail)
    {
        $this->request_detail = $request_detail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd("ddd");
        $user = $this->request_detail->userDetail;

        $user_name = $user->name;

        $mail_template = MailTemplate::where('mail_type', 'invoice_mail')->whereActive(true)->first();
      

        // Log::info($description);
        if ($mail_template != null) {

                $pickup_address = $this->request_detail->requestPlace->pickup_address; 
                $dropoff_address = $this->request_detail->requestPlace->drop_address;
                $base_price = $this->request_detail->requestBill->base_price ?? 0;
                $additional_distance_price_per_Km = $this->request_detail->requestBill->additional_distance_price_per_Km ?? 0;
                $additional_time_price_per_min = $this->request_detail->requestBill->additional_time_price_per_min ?? 0;
                $waiting_Charge_per_minutes = $this->request_detail->requestBill->waiting_Charge_per_minutes ?? 0;
                $cancellation_fee = $this->request_detail->requestBill->cancellation_fee ?? 0;
                $service_tax = $this->request_detail->requestBill->service_tax ?? 0;
                $promo_discount = $this->request_detail->requestBill->promo_discount ?? 0;
                $admin_commision = $this->request_detail->requestBill->admin_commision ?? 0;
                $driver_commission = $this->request_detail->requestBill->driver_commission ?? 0;
                $total_amount = $this->request_detail->requestBill->total_amount ?? 0;
                $driver_name = $this->request_detail->driverDetail->name;

                $date = $this->request_detail->getConvertedTripStartTimeAttribute();
         
                $taxi_service_name = get_settings('app_name');
                       
                $search = ['$user_name', '$pickup_address', '$dropoff_address', '$base_price','$additional_distance_price_per_Km', '$additional_time_price_per_min', '$waiting_Charge_per_minutes', '$cancellation_fee', '$service_tax', '$promo_discount', '$admin_commision', '$driver_commission', '$total_amount', '$driver_name','$taxi_service_name'];
                $replace = [$user_name, $pickup_address, $dropoff_address, $base_price,$additional_distance_price_per_Km, $additional_time_price_per_min, $waiting_Charge_per_minutes, $cancellation_fee, $service_tax, $promo_discount, $admin_commision, $driver_commission, $total_amount, $driver_name, $taxi_service_name];

                $description = str_replace($search, $replace, $mail_template->description);

                $mail_template = $description;

                Mail::to($user->email)->send(new InvoiceMail($mail_template));
        }

    }

}
