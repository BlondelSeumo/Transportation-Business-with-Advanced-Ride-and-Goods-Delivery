<?php

namespace App\Console\Commands;

use App\Base\Constants\Masters\DriverDocumentStatus;
use App\Mail\Driver\DriverDocumentExpiryMail;
use App\Models\Admin\DriverDocument;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;
class NotifyDriverDocumentExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:document:expires';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to Driver regards Document Expires';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Database $database)
    {
        parent::__construct();
        $this->database = $database;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $driverDocuments = DriverDocument::whereDate('expiry_date', '<=', Carbon::today()->toDateString())->get();

        foreach ($driverDocuments as $doc) {
            $docExpiryDate = $doc->getOriginal('expiry_date');

                    
                    if($doc->driver->approve){
                        $doc->driver->update([
                        'approve' => false,
                        'reason' => "Document Expired",
                    ]);

                    $doc->update([
                    'document_status' => DriverDocumentStatus::EXPIRED_AND_DECLINED
                    ]);

                    $notifable_driver = $doc->driver->user;

                    $title = trans('push_notifications.document_expired_title',[],$notifable_driver->lang);
                    $body = trans('push_notifications.document_expired_body',[],$notifable_driver->lang);

                    dispatch(new SendPushNotification($notifable_driver,$title,$body));

                    $this->database->getReference('drivers/driver_'.$doc->driver->id)->update(['approve'=>0,'updated_at'=> Database::SERVER_TIMESTAMP]);

                    $this->info('Declined successfully');
                
                    }
                    
        }

        $this->info('Command run successfully');
    }
}
