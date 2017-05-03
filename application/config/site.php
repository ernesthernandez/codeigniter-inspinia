<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Site
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views when calling
| render() function.
|
| Each of them can be overrided from child controllers.
|
*/
//Enable codeigniter 3 profiler.
$config['profiler'] 	= false;
$config['lag_helper'] 	= false;

$config['login_url']  	= 'login';
$config['logout_url'] 	= 'logout';

// Set theme name
$config['theme'] 		= 'inspinia';
//mini-navbar fixed-sidebar fixed-nav fixed-nav-basic  boxed-layout top-navigation
$config['body_class'] 	= 'md-skin fixed-sidebar fixed-nav';
$config['title'] 		= 'Codeigniter Inspinia';
$config['favicon'] 	    = 'public/theme/img/ci-icon.png';
$config['company_name'] = 'Codeigniter Framework';
$config['app_name'] 	= 'Codeigniter Inspinia';
$config['app_version']  = CI_VERSION;
$config['app_year']     = date("Y");

$config['meta']  	= array(
						'viewport'		=> 'width=device-width, initial-scale=1.0',
						'author'		=> 'Ernest Hernandez',
						'description'	=> 'A premium admin dashboard template with flat design concept.',
						'resource-type'	=> 'document',
						'robots'		=> 'all, index, follow',
						'googlebot'		=> 'all, index, follow',
					);

$config['css_files'] = array(
						'public/theme/css/style.css',
						'public/theme/css/animate.min.css'
					);

$config['js_files']  = array(
						'public/theme/js/jquery.js',
						'public/theme/js/app.js',
					);

$config['directories'] = array(
						'asset_path' 	=> 'public/theme/',
						'css_path' 		=> 'public/theme/css/',
						'js_path' 		=> 'public/theme/js/',
						'less_path' 	=> 'public/theme/less/',
						'img_path' 		=> 'public/theme/img/',
						'upload_path' 	=> 'public/upload/',
						'download_path' => 'public/download/'
					);

$config['multilingual'] = array(
							'default'		=> 'english',		// to decide which of the "available" languages should be used
							'available'		=> array(			// availabe languages with names to display on site (e.g. on menu)
								'en' => array(					// abbr. value to be used on URL, or linked with database fields
									'label'	=> 'English',		// label to be displayed on language switcher
									'value'	=> 'english',		// to match with CodeIgniter folders inside application/language/
								),
								'es' => array(
									'label'	=> 'Español',
									'value'	=> 'spanish',
								)
							),
							'autoload'		=> array('site')	// language files to autoload
							);

$config['google_analytics'] = '';

$config['menu'] = array(
		'welcome' => array(
			'icon'		=> 'th-large',
			'url'		=> '/',
		),
		'manage' => array(
			'url'			 => 'api/manage/',
			'icon'			 => 'pencil',
			'children'  	 => array(
				'projects'	 => 'api/manage',
			)
		),
		'github' => array(
			'icon'		=> 'github-alt',
			'url'		=> 'https://github.com/pewpewyou/codeigniter_plus',
		),
	);









