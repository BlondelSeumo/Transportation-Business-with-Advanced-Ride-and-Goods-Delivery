<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         // Empty the table
        $countries = Country::all();

        // if(sizeof($countries)==0){
        // Get all from the JSON file
        $JSON_countries = Country::allJSON();
        foreach ($JSON_countries as $country) {
            $country = Country::firstOrCreate([
                'name'           => ((isset($country['name'])) ? $country['name'] : null),
                'dial_code'              => ((isset($country['dial_code'])) ? $country['dial_code'] : null),
                'code'   => ((isset($country['iso_3166_2'])) ? $country['iso_3166_2'] : null),
                'flag'   => ((isset($country['flag'])) ? $country['flag'] : null),
                'currency_name'   => ((isset($country['currency'])) ? $country['currency'] : null),
                'currency_code'   => ((isset($country['currency_code'])) ? $country['currency_code'] : null),
                'currency_symbol'   => ((isset($country['currency_symbol'])) ? $country['currency_symbol'] : null),
                'dial_min_length'   => ((isset($country['minLength'])) ? $country['minLength'] : null),
                'dial_max_length'   => ((isset($country['maxLength'])) ? $country['maxLength'] : null),
            ]);
        }
        $country->countryTranslationDetail()->firstOrCreate([
            'name' => ((isset($country['name'])) ? $country['name'] : null),
            'locale' => 'en',
        ]);
        // }
    }
}
