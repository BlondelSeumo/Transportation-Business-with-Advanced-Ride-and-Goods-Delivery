<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeZone;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Empty the table
        $timezones = TimeZone::all();

        // dd($timezones);

        if (sizeof($timezones)==0) {
            // Get all from the JSON file
            $JSON_timezones = TimeZone::allJSON();

            foreach ($JSON_timezones as $timezone) {
                TimeZone::create([
                'name'      => ((isset($timezone['name'])) ? $timezone['name'] : null),
                'timezone'      => ((isset($timezone['value'])) ? $timezone['value'] : null),
            ]);
            }
        }
    }
}
