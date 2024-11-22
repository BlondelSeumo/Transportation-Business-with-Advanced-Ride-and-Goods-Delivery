<?php

namespace App\Base\Libraries\QueryFilter;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class QueryFilterServiceProvider extends ServiceProvider {
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
		$this->app->bind('query-filter', QueryFilter::class);

		$this->app->alias('query-filter', QueryFilterContract::class);
	}

	/**
	 * Register the facade without the user having to add it to the app.php file.
	 */
	protected function registerFacade() {
		$this->app->booting(function () {
			$loader = AliasLoader::getInstance();
			$loader->alias('QueryFilter', QueryFilterFacade::class);
		});
	}
}
