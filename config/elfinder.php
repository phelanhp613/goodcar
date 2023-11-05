<?php

use Illuminate\Support\Str;

return [

	/*
	|--------------------------------------------------------------------------
	| Upload dir
	|--------------------------------------------------------------------------
	|
	| The dir where to store the images (relative from public)
	|
	*/
	'dir'   => ['storage'],

	/*
	|--------------------------------------------------------------------------
	| Filesystem disks (Flysytem)
	|--------------------------------------------------------------------------
	|
	| Define an array of Filesystem disks, which use Flysystem.
	| You can set extra options, example:
	|
	| 'my-disk' => [
	|        'URL' => url('to/disk'),
	|        'alias' => 'Local storage',
	|    ]
	*/
	'disks' => [

	],

	/*
	|--------------------------------------------------------------------------
	| Routes group config
	|--------------------------------------------------------------------------
	|
	| The default group settings for the elFinder routes.
	|
	*/

	'route' => [
		'prefix'     => 'elfinder',
		'middleware' => ['web', 'auth'], //Set to null to disable middleware filter
	],

	/*
	|--------------------------------------------------------------------------
	| Access filter
	|--------------------------------------------------------------------------
	|
	| Filter callback to check the files
	|
	*/

	'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

	/*
	|--------------------------------------------------------------------------
	| Roots
	|--------------------------------------------------------------------------
	|
	| By default, the roots file is LocalFileSystem, with the above public dir.
	| If you want custom options, you can set your own roots below.
	|
	*/

	'roots' => NULL,

	/*
	|--------------------------------------------------------------------------
	| Options
	|--------------------------------------------------------------------------
	|
	| These options are merged, together with 'roots' and passed to the Connector.
	| See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
	|
	*/

	'options'      => [
		'bind'   => [
			'upload.pre mkdir.pre mkfile.pre rename.pre archive.pre ls.pre' => [
				'Plugin.Sanitizer.cmdPreprocess'
			],
			'upload.presave paste.copyfrom'                                 => [
				'Plugin.Sanitizer.onUpLoadPreSave'
			]
		],
		'plugin' => [
			'Sanitizer' => [
				'enable'   => TRUE,
				'targets'  => ['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' '], // target chars
				'replace'  => '-', // replace to this
				'callBack' => function($name, $options) {
					$nameArr = explode('.', $name);
					$ext = '';
					if (count($nameArr) > 1) {
						$ext = '.' . $nameArr[count($nameArr)-1];
					}
					$name = Str::slug(str_replace("$ext", "", $name));
					return $name . $ext;
				}
			]
		]
	],

	/*
	|--------------------------------------------------------------------------
	| Root Options
	|--------------------------------------------------------------------------
	|
	| These options are merged, together with every root by default.
	| See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1#root-options
	|
	*/
	'root_options' => [
	],

];