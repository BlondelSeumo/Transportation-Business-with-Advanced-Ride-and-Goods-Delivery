<?php

namespace App\Base\Payment\BrainTreeTasks;
use Braintree\Gateway;

/**
 * Class BraintreeTask
 */
class BraintreeTask {
	public static $gateway;

	public function run() {

		$braintree = 'braintree';

		if (BraintreeTask::$gateway == null) {
			BraintreeTask::$gateway = new Gateway([
				'environment' => get_settings('braintree_environment'),
				'merchantId' => get_settings('braintree_merchant_id'),
				'publicKey' => get_settings('braintree_public_key'),
				'privateKey' => get_settings('braintree_private_key'),
			]);
		}
		return BraintreeTask::$gateway;

	}
}