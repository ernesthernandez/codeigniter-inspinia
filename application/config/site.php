<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Site
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views when calling
| view() function.
|
| Each of them can be overrided from child controllers.
|
*/

$config['profiler'] 	  = FALSE;
$config['lang_helper'] 	= TRUE;

$config['login_url']  		 = 'auth/login';
$config['logout_url'] 		 = 'auth/logout';

//Name of the sessions to convert to template variables
$config['sessions'] = array(
		'language' 	=> 'lang',
		'user' 			=> 'full_name',
		'group' 		=> 'groupname'
	);
//Name of labels you can use lang helper
$config['labels'] = [
	'logout'  => 'Logout',// You can use lang('lang_key')
	'profile' => 'Profile',// You can use lang('lang_key')
	'search'  => 'Search'
];

// Set theme name
$config['theme'] 		= 'inspinia';
//mini-navbar fixed-sidebar fixed-nav fixed-nav-basic  boxed-layout top-navigation
$config['body_class'] 	= 'black-skin fixed-sidebar fixed-nav';
$config['title'] 				= 'CI+';
$config['favicon'] 	    = 'public/theme/img/ci.png';
$config['company_name'] = 'Github Inc.';
$config['app_name'] 		= 'Easy Inspinia Admin Theme integration with Codeigniter 3';
$config['app_version']  = CI_VERSION;
$config['app_year']     = date("Y");

$config['meta']  	= array(
						'viewport'		=> 'width=device-width, initial-scale=1.0',
						'author'		=> 'PewpewU - Ernest Hernandez',
						'description'	=> 'Easy Inspinia Admin Theme integration with Codeigniter 3',
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
							'default'		=> 'english',
							'available'		=> array(
								'en' => array(
									'label'	=> 'English',
									'value'	=> 'english',
								),
								'es' => array(
									'label'	=> 'Español',
									'value'	=> 'spanish',
								)
							),
							'autoload'		=> array('site')
							);

$config['google_analytics'] = '';








