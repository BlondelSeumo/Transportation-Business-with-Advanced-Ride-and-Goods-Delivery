<?php

namespace App\Base\Libraries\SMS;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider {
	/**
	 * Register the application services.
	 */
	public function register() {
		$this->registerAccess();

		$this->registerFacade();
	}

	/**
	 * Register the application bindings.
	 */
	protected function registerAccess() {
		$this->app->bind('sms', SMS::class);

		$this->app->alias('sms', SMSContract::class);
	}

	/**
	 * Register the facade without the user having to add it to the app.php file.
	 */
	protected function registerFacade() {
		$this->app->booting(function () {
			$loader = AliasLoader::getInstance();
			$loader->alias('SMS', SMSFacade::class);
		});
	}
}
