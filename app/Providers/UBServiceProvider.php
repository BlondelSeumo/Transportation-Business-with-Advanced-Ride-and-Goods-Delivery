<?php

namespace App\Providers;

use App\Base\Services\Hash\HashGenerator;
use App\Base\Services\Hash\HashGeneratorContract;
use App\Base\Services\ImageEncoder\ImageEncoder;
use App\Base\Services\ImageEncoder\ImageEncoderContract;
use App\Base\Services\ImageUploader\ImageUploader;
use App\Base\Services\ImageUploader\ImageUploaderContract;
use App\Base\Services\OTP\Generator\OTPGenerator;
use App\Base\Services\OTP\Generator\OTPGeneratorContract;
use App\Base\Services\OTP\Handler\DatabaseOTPHandler;
use App\Base\Services\OTP\Handler\OTPHandlerContract;
use App\Base\Services\PDF\Creator\PDFCreator;
use App\Base\Services\PDF\Creator\PDFCreatorContract;
use App\Base\Services\PDF\Generator\PDFGenerator;
use App\Base\Services\PDF\Generator\PDFGeneratorContract;
use App\Base\Services\Setting\DatabaseSetting;
use App\Base\Services\Setting\SettingContract;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class UBServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMorphMaps();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HashGeneratorContract::class, HashGenerator::class);

        $this->app->singleton(ImageEncoderContract::class, ImageEncoder::class);
        $this->app->singleton(ImageUploaderContract::class, ImageUploader::class);

        $this->app->singleton(OTPGeneratorContract::class, OTPGenerator::class);
        $this->app->singleton(OTPHandlerContract::class, DatabaseOTPHandler::class);

        $this->app->singleton(PDFGeneratorContract::class, PDFGenerator::class);
        $this->app->singleton(PDFCreatorContract::class, PDFCreator::class);

        $this->app->singleton(SettingContract::class, DatabaseSetting::class);
    }

    /**
     * Custom model relationship morph maps.
     *
     * @return void
     */
    protected function registerMorphMaps()
    {
        // Relation::morphMap([
        //     'Vendor' => 'App\Models\Admin\Merchants'
        // ]);
    }
}
