<?php

namespace App\Base\Libraries\Access;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider {
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
		$this->app->singleton('access', Access::class);
	}

	/**
	 * Register the facade without the user having to add it to the app.php file.
	 */
	protected function registerFacade() {
		$this->app->booting(function () {
			$loader = AliasLoader::getInstance();
			$loader->alias('Access', AccessFacade::class);
		});
	}
}
