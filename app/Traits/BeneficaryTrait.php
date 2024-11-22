<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Exception;
use App\Base\Constants\Setting\Settings;

trait BeneficaryTrait
{

        /*
        Below is an integration flow on how to use Cashfree's payouts.
        Please go through the payout docs here: https://dev.cashfree.com/payouts
        The following script contains the following functionalities :
            1.getToken() -> to get auth token to be used in all following calls.
            2.getBeneficiary() -> to get beneficiary details/check if a beneficiary exists
            3.createBeneficiaryEntity() -> to create beneficiaries
            4.requestTransfer() -> to create a payout transfer
            5.getTransferStatus() -> to get payout transfer status.
        All the data used by the script can be found in the below assosciative arrays. This includes the clientId, clientSecret, Beneficiary object, Transaction Object.
        You can change keep changing the values in the config file and running the script.
        Please enter your clientId and clientSecret, along with the appropriate enviornment, beneficiary details and request details
        */

    public $clientId;
    public $clientSecret;



    private $env = 'test';

    private $baseUrls = array(
            'prod' => 'https://payout-api.cashfree.com',
            'test' => 'https://payout-gamma.cashfree.com',
        );

    private $urls = array(
            'auth' => '/payout/v1/authorize',
            'getBene' => '/payout/v1/getBeneficiary/',
            'addBene' => '/payout/v1/addBeneficiary',
            'requestTransfer' => '/payout/v1/requestTransfer',
            'getTransferStatus' => '/payout/v1/getTransferStatus?transferId='
        );


    private $baseurl = 'https://payout-gamma.cashfree.com';
    
    private $production_base_url = 'https://payout-api.cashfree.com';


    public function create_header($token)
    {
        $clientId = get_settings(Settings::CASH_FREE_TEST_CLIENT_ID_FOR_PAYOUT);
        $clientSecret = get_settings(Settings::CASH_FREE_TEST_CLIENT_SECRET_FOR_PAYOUT);

        if(get_settings(Settings::CASH_FREE_ENVIRONMENT)=='production'){
       
        $clientId = get_settings(Settings::CASH_FREE_PRODUCTION_CLIENT_ID_FOR_PAYOUT);
        $clientSecret = get_settings(Settings::CASH_FREE_PRODUCTION_CLIENT_SECRET_FOR_PAYOUT);

        }
        $header = array(
                "X-Client-Id: $clientId",
                "X-Client-Secret: $clientSecret",
                "Content-Type: application/json",
            );

        $headers = $header;
        if (!is_null($token)) {
            array_push($headers, 'Authorization: Bearer '.$token);
        }
        return $headers;
    }

    public function post_helper($action, $data, $token)
    {
        $baseurl = $this->baseurl;

        if(get_settings(Settings::CASH_FREE_ENVIRONMENT=='production')){
        $baseurl = $this->production_base_url;
        }

        $urls = $this->urls;


        $finalUrl = $baseurl.$urls[$action];
        $headers = $this->create_header($token);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $finalUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (!is_null($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $r = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->throwCustomException(curl_error($ch));

            // print('error in posting');
                // print(curl_error($ch));
                // die();
        }
        curl_close($ch);
        $rObj = json_decode($r, true);
        if ($rObj['status'] != 'SUCCESS' || $rObj['subCode'] != '200') {
            throw new Exception('incorrect response: '.$rObj['message']);
        }
        return $rObj;
    }

    public function get_helper($finalUrl, $token)
    {
        $headers = $this->create_header($token);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $finalUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $r = curl_exec($ch);

        if (curl_errno($ch)) {
            $this->throwCustomException(curl_error($ch));

        
        }
        curl_close($ch);

        $rObj = json_decode($r, true);
        if ($rObj['status'] != 'SUCCESS' || $rObj['subCode'] != '200') {
            throw new Exception('incorrect response: '.$rObj['message']);
        }
        return $rObj;
    }

    //get auth token
    public function getToken()
    {
        try {
            $response = $this->post_helper('auth', null, null);
            return $response['data']['token'];
        } catch (Exception $ex) {
            $this->throwCustomException($ex->getMessage());

            
        }
    }


    //add beneficiary
    public function addBeneficiary($beneficiary)
    {
        try {
            $beneficiary['beneId'] =  Str::random(40);

            $token = $this->getToken();

            $response = $this->post_helper('addBene', $beneficiary, $token);

            return $beneficiary['beneId'];
        } catch (Exception $ex) {
            $this->throwCustomException($ex->getMessage());
        }
    }

    //request transfer
    public function requestTransfer($transfer)
    {
        // dd($transfer);
        try {
            $token = $this->getToken();

            $response = $this->post_helper('requestTransfer', $transfer, $token);
        } catch (Exception $ex) {
            $this->throwCustomException($ex->getMessage());


        }
    }

    //get transfer status
    public function getTransferStatus($transferId)
    {
        try {
            $token = $this->getToken();

            $baseurl = $this->baseurl;
            $urls= $this->urls;

            $finalUrl = $baseurl.$urls['getTransferStatus'].$transferId;
            $response = $this->get_helper($finalUrl, $token);

            return json_encode($response);
        } catch (Exception $ex) {
            $this->throwCustomException($ex->getMessage());

        }
    }


}
