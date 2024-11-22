<?php

namespace App\Http\Controllers\Api\V1\Common;

use GuzzleHttp\Client;
use App\Http\Controllers\Api\V1\BaseController;

/**
 * @group Translation
 * translation api
 */
class TranslationController extends BaseController
{
    /**
    * Translation api
    */
    public function index()
    {
        $client = new Client();
        $get_api_key = get_settings('google_map_key_for_distance_matrix');

        // $sheet_id = '1J7F9JXssbN8mzSOatEF9-MLfC7Odz0SWZItX7fLSwU8';

        $sheet_id = get_settings('google_sheet_id');
        
        $response = $client->get('https://sheets.googleapis.com/v4/spreadsheets/'.$sheet_id.'/values:batchGet?ranges=Settings!A:Z&key='.$get_api_key.'&ranges=Sheet1!A:Z&ranges=Update-Config!A:Z');


        $data = json_decode($response->getBody()->getContents(), true);

        $settings = [];
        $language = [];
        $lang = [];
        $update_sheet = false;


        for ($i = 1; $i < count($data["valueRanges"][0]['values']); $i++) {
            $sett = $data["valueRanges"][0]['values'][$i];

            if($data["valueRanges"][2]['values'][1][1]=="TRUE"){
                $update_sheet = true;
            }

            if ($sett[0] != '') {
                $settings[$sett[0]][$sett[1]] = array_key_exists(2, $sett) ? $sett[2] : "TRUE";
            }
        }

        foreach ($data["valueRanges"][1]['values'] as $key => $value) {
            for ($i = 1; $i < count($value); $i++) {
                if ($key == 0) {
                    if ($value[$i] != "") {
                        if (key_exists($value[$i], $settings) && key_exists("show", $settings[$value[$i]])) {
                            if ($settings[$value[$i]]['show'] == "TRUE") {
                                $lang[$i] = array(
                                    "name" => $value[$i],
                                    "state" => true,
                                );
                            } else {
                                $lang[$i] = array(
                                    "name" => $value[$i],
                                    "state" => false,
                                );
                            }
                        } else {
                            $lang[$i] = array(
                                "name" => $value[$i],
                                "state" => true,
                            );
                        }
                    }
                } else {
                    if ($value[0] != "" && $lang[$i]["state"]) {
                        $language[$lang[$i]['name']][$value[0]] = $value[$i];
                    }
                }
            }
        }

        return response()->json(['success'=>true,'update_sheet'=>$update_sheet,'data'=>$language]);
        
        // return $this->respondOk($language);
    }

     public function flutterTrnaslation()
    {
        $client = new Client();
        $get_api_key = env('GOOGLE_SHEET_KEY');
        $response = $client->get('https://sheets.googleapis.com/v4/spreadsheets/1RjUCnHzxCBD_CZf5JqX9iaiXphHjRlyIQTVTzBPSI1Q/values:batchGet?ranges=Settings!A:Z&key='.$get_api_key.'&ranges=Sheet1!A:Z&ranges=Update-Config!A:Z');



        $data = json_decode($response->getBody()->getContents(), true);

        $settings = [];
        $language = [];
        $lang = [];
        $update_sheet = false;


        for ($i = 1; $i < count($data["valueRanges"][0]['values']); $i++) {
            $sett = $data["valueRanges"][0]['values'][$i];

            if($data["valueRanges"][2]['values'][1][1]=="TRUE"){
                $update_sheet = true;
            }

            if ($sett[0] != '') {
                $settings[$sett[0]][$sett[1]] = array_key_exists(2, $sett) ? $sett[2] : "TRUE";
            }
        }

        foreach ($data["valueRanges"][1]['values'] as $key => $value) {
            for ($i = 1; $i < count($value); $i++) {
                if ($key == 0) {
                    if ($value[$i] != "") {
                        if (key_exists($value[$i], $settings) && key_exists("show", $settings[$value[$i]])) {
                            if ($settings[$value[$i]]['show'] == "TRUE") {
                                $lang[$i] = array(
                                    "name" => $value[$i],
                                    "state" => true,
                                );
                            } else {
                                $lang[$i] = array(
                                    "name" => $value[$i],
                                    "state" => false,
                                );
                            }
                        } else {
                            $lang[$i] = array(
                                "name" => $value[$i],
                                "state" => true,
                            );
                        }
                    }
                } else {
                    if ($value[0] != "" && $lang[$i]["state"]) {
                        $language[$lang[$i]['name']][$value[0]] = $value[$i];
                    }
                }
            }
        }

        return response()->json(['success'=>true,'update_sheet'=>$update_sheet,'data'=>$language]);
        
        // return $this->respondOk($language);
    }
}
