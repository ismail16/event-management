<?php

// SSLCommerz configuration
return [
	'apiCredentials' => [
		'store_id' => env("SSLCZ_STORE_ID"),
		'store_password' => env("SSLCZ_STORE_PASSWORD"),
	],
	'apiUrl' => [
		'make_payment' => "/gwprocess/v4/api.php",
		'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
		'order_validate' => "/validator/api/validationserverAPI.php",
		'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
		'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'invoice' => "/gwprocess/v4/invoice.php",
	],
    'apiDomain' => env('SSLCZ_API_DOMAIN', 'https://securepay.sslcommerz.com'),
	'connect_from_localhost' => env("IS_LOCALHOST", false), // For Sandbox, use "true", For Live, use "false"
	'success_url' => '/admin/success',
	'failed_url' => '/admin/fail',
	'cancel_url' => '/admin/cancel',
	'ipn_url' => '/admin/ipn',
];
