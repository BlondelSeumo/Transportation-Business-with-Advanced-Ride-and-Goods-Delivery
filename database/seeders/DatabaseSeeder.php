<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TimeZoneSeeder::class);
        // $this->call(DriverNeededDocumentSeeder::class);
        $this->call(CarMakeAndModelSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(CancellationReasonSeeder::class);
        $this->call(ComplaintTitleSeeder::class);
        $this->call(FrontpageHeaderTableSeeder::class);
        $this->call(GoodsTypeSeeder::class);
        $this->call(MailTemplateSeeder::class);
        $this->call(ThirdPartySettingSeeder::class);

$this->call(OnboardingSeeder::class);




    }
}
