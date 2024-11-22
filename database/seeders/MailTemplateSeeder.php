<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\MailTemplate;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
 protected $mailTemplate = [

    /*Welcome Mail*/
        [  'mail_type' => 'welcome_mail',
            'active' => 1,
            'description' => '<p>Hello $user_name</p>

            <p>Thank you for joining MI Softwares! We are thrilled to have you as a part of our community.</p>

            <p>Our mission is to mobility. We hope that you will find our products/services to be useful and enjoyable.</p>

            <p>To get started, please take a few moments to explore our website and familiarize yourself with our offerings. If you have any questions or concerns, our customer support team is always here to help.</p>

            <p>We look forward to working with you and providing you with a top-notch experience.</p>

            <p>Best regards,</p>

            <p>MI Softwares</p>',
        ],
    /*Welcome Mail*/
        [  'mail_type' => 'welcome_mail_driver',
            'active' => 1,
            'description' => '<p>Dear $user_name,</p>

        <p>Congratulations on becoming a newly registered driver! We are excited to welcome you to the world of driving and wanted to take a moment to extend our warmest greetings.</p>

        <p>As a registered driver, you now have the opportunity to explore new destinations, embrace independence, and experience the joys of the open road. We hope this new chapter brings you many memorable adventures and experiences.</p>

        <p>Please remember to prioritize safety as you embark on your driving journey. Observe traffic laws, wear your seatbelt, and remain attentive at all times. Safe driving not only protects you but also ensures the well-being of others around you.</p>

        <p>If you ever have any questions or need assistance along the way, our team is here to support you. Don&#39;t hesitate to reach out to us; we&#39;re more than happy to help.</p>

        <p>Once again, congratulations on your registration! Enjoy the freedom and excitement that driving offers. We wish you safe travels and an incredible journey ahead.</p>

        <p>Best regards,</p>

        <p>Tagxi</p>',
        ],


    /*trip start alert Mail Mail*/

        // [  'mail_type' => 'trip_start_mail',
        //     'active' => 1,
        //     'description' => '<p>Dear $user_name,</p>
        //                     <p>We are excited to inform you that your taxi trip has officially started! Your driver, $driver_name, has been dispatched and is on their way to pick you up at your specified location, $pickup_address.</p>

        //                     <p>To ensure a smooth and comfortable ride, please make sure that you are ready and waiting at the pickup location. If there are any changes to your pickup location or any other special requests, please contact your driver directly through the phone number provided in the confirmation message.</p>

        //                     <p>We hope you have a safe and enjoyable trip with us. If you have any questions or concerns, please don&#39;t hesitate to contact our customer support team.</p>

        //                     <p>Thank you for choosing our taxi service!</p>

        //                     <p>Best regards,</p>

        //                     <p>$app_name</p>',
        // ],
    /*Bill mail*/

        // [  'mail_type' => 'invoice_maill',
        //     'active' => 1,
        //     'description' => '<p>Thank you for using our taxi service for your recent trip. Please find below the details of your taxi bill for the trip that you took on $date:</p>
        //         <table>
        //             <thead>
        //                 <tr>
        //                     <th>Trip Details</th>
        //                     <th>Amount</th>
        //                 </tr>
        //             </thead>
        //             <tbody>
        //                 <tr>
        //                     <td>Pickup Address</td>
        //                     <td>$pickup_address</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Dropoff Address</td>
        //                     <td>$dropoff_address</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Base fair</td>
        //                     <td>$base_price</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Additional Distance Price Per Km</td>
        //                     <td>$additional_distance_price_per_Km</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Additional Time Price Per Min</td>
        //                     <td>$additional_time_price_per_min</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Waiting Charge Per Minutes</td>
        //                     <td>$waiting_Charge_per_minutes</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Cancellation Fee</td>
        //                     <td>$cancellation_fee</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Service Tax</td>
        //                     <td>$service_tax</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Promo Discount</td>
        //                     <td>$promo_discount</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Admin Commission</td>
        //                     <td>$admin_commision</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Driver Commission</td>
        //                     <td>$driver_commission</td>
        //                 </tr>
        //                 <tr>
        //                     <td>Total Amount</td>
        //                     <td>$total_amount</td>
        //                 </tr>
        //             </tbody>
        //         </table>

        //         <p>Please note that the fare includes all taxes and fees. If you have any questions or concerns regarding this bill, please feel free to contact our customer support team at any time.</p>

        //         <p>Thank you for choosing our taxi service. We hope to see you again soon.</p>

        //         <p>Best regards,</p>

        //         <p>$taxi_service_name</p>',
        // ],

    ];




    public function run()
    {
       $created_params = $this->mailTemplate;

            $value = MailTemplate::first();

                foreach ($created_params as $mailTemplate)
                {
                    MailTemplate::firstorcreate($mailTemplate);
                }


        }    
    }
