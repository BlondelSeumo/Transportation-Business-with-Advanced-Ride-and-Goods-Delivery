<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Roles and Permissions (Access)
		    |--------------------------------------------------------------------------
		    |
		    | All the configurations related to the roles and permissions
		    | implementation.
		    |
	*/

	'cache' => [
		'tag' => 'access',
		'ttl' => [
			'roles' => 60 * 24, // 24 Hours
			'permissions' => 60 * 24, // 24 Hours
		],
	],

];
