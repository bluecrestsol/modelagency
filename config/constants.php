<?php

return [

	'admins' => [
		'roles' => [
			1 => 'Admin',
			2 => 'Manager',
			3 => 'Booker',
			4 => 'Accountant',
		],
		'status' => [
			0 => 'Disabled',
			1 => 'Active',
		],
		'title' => [
			1=>'Mr', 2=>'Mrs', 3=>'Miss'
		],
	],

	'agencies' => [

		'status' => [
			0 => 'disabled',
			1 => 'enabled',
			2 => 'blacklisted'
		],

	],

	'models' => [

		'sex' => [
			1 => 'Male',
			2 => 'Female',
			3 => 'Transgender'
	 	],

	 	'doc_type' => [
			1 => 'passport',
			2 => 'id card',
			3 => 'drivers license',
	 	],

	 	'location' => [
	 		1 => 'local',
	 		2 => 'import',
	 	],

	 	'status' => [
	 		1 => 'Active',
	 		2 => 'Invisible',
	 		0 => 'Disabled',
	 		3 => 'Submission in Progress',
	 		4 => 'Submitted'
	 	],

	 	'type' => [
	 		1 => 'model',
	 		2 => 'talent',
	 	],

	 	'level' => [
	 		1=>'Beginner',
	 		2=>'Intermediate',
	 		3=>'Fluent',
	 		4=>'Native',
	 	],
	],

	'notes' => [

		'owner' => [
			1 => 'agency',
			2 => 'model',
			3 => 'customer',
		],

	],

	'transaction_types' => [
		'types' => [
			1 => 'booking',
			2 => 'expense',
		],
	],

	'availabilities' => [
		'types' => [
			1 => 'available',
			2 => 'not available',
		],
	],

	'file_types' => [
		'owner_types' => [
			0=>'company', 
			1=>'agency' , 
			2=>'model', 
			3=>'customer',
		],
	]
	

];