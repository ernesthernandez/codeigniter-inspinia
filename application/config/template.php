<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| TEMPLATE CONFIGURATION
| -------------------------------------------------------------------
| This file contains templates used for the libraries
|
 */
/*
| -------------------------------------------------------------------
| INSPINIA ADMIN THEME - SIDE MENU TEMPLATE
| -------------------------------------------------------------------
 */
$config['inspinia']['enable_id'] 			= false; //Assign id's to children and and conect parent via href="#{children_id}"
$config['inspinia']['list_open'] 			= '<li>';
$config['inspinia']['list_close'] 			= '</li>';
$config['inspinia']['link_open']  			= '<a>';
$config['inspinia']['link_close'] 			= '</a>';
$config['inspinia']['label_open']  			= '<span class="nav-label">';
$config['inspinia']['label_close'] 			= '</span>';
$config['inspinia']['icon_open'] 	 		= '<i>';
$config['inspinia']['icon_close'] 	 		= '</i>';
$config['inspinia']['expandable_icon'] 		= '<span class="fa arrow"></span>';
$config['inspinia']['second_level_open']    = '<ul class="nav nav-second-level">';
$config['inspinia']['second_level_close']	= '</ul>';
$config['inspinia']['third_level_open']  	= '<ul class="nav nav-third-level">';
$config['inspinia']['third_level_close'] 	= '</ul>';
$config['inspinia']['active_class']   		= 'active';
$config['inspinia']['collapse_class'] 		= 'in';
$config['inspinia']['icon_class']   		= 'fa fa-';

/*
| -------------------------------------------------------------------
| INSPINIA ADMIN THEME - TOP BAR MENU TEMPLATE
| -------------------------------------------------------------------
 */

$config['top-navigation']['enable_id'] 			= false; //Assign id's to children and and conect parent via href="#{children_id}"
$config['top-navigation']['list_open'] 			= '<li>';
$config['top-navigation']['list_close'] 		= '</li>';
$config['top-navigation']['link_open']  		= '<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" role="button">';
$config['top-navigation']['link_close'] 		= '</a>';
$config['top-navigation']['label_open']  		= '';
$config['top-navigation']['label_close'] 		= '';
$config['top-navigation']['icon_open'] 	 		= '<i>';
$config['top-navigation']['icon_close'] 		= '</i>';
$config['top-navigation']['expandable_icon']	= '<span class="caret"></span>';
$config['top-navigation']['second_level_open']  = '<ul role="menu" class="dropdown-menu">';
$config['top-navigation']['second_level_close']	= '</ul>';
$config['top-navigation']['third_level_open']  	= '<ul class="dropdown-menu">';
$config['top-navigation']['third_level_close'] 	= '</ul>';
$config['top-navigation']['active_class']   	= 'active';
$config['top-navigation']['collapse_class'] 	= 'in';
$config['top-navigation']['icon_class']   		= 'fa fa-';

/*
| -------------------------------------------------------------------
| LUNA ADMIN THEME - SIDE MENU TEMPLATE
| -------------------------------------------------------------------
 */
$config['luna']['enable_id'] 			= true; //Assign id's to children and and conect parent via href="#{children_id}"
$config['luna']['list_open'] 			= '<li>';
$config['luna']['list_close'] 			= '</li>';
$config['luna']['link_open']  			= '<a data-toggle="collapse">';
$config['luna']['link_close'] 			= '</a>';
$config['luna']['label_open']  			= '';
$config['luna']['label_close'] 			= '';
$config['luna']['icon_open'] 	 		= '<i>';
$config['luna']['icon_close'] 	 		= '</i>';
$config['luna']['expandable_icon'] 		= '<span class="sub-nav-icon"> <i class="stroke-arrow"></i> </span>';
$config['luna']['second_level_open']    = '<ul class="nav nav-second collapse">';
$config['luna']['second_level_close']	= '</ul>';
$config['luna']['third_level_open']  	= '<ul class="nav nav-third">';
$config['luna']['third_level_close'] 	= '</ul>';
$config['luna']['active_class']   		= 'active';
$config['luna']['collapse_class'] 		= 'in';
$config['luna']['icon_class']   		= 'fa fa-';

/*
| -------------------------------------------------------------------
| BREADCRUMB TEMPLATE
| -------------------------------------------------------------------
 */

$config['breadcrumb']['breadcrumb_open']   = '<ol class="breadcrumb">';
$config['breadcrumb']['breadcrumb_close']  = '</ol>';
$config['breadcrumb']['list_open']   	   = '<li>';
$config['breadcrumb']['list_close']   	   = '</li>';
$config['breadcrumb']['list_active']   	   = '<strong>';
$config['breadcrumb']['list_active_close'] = '</strong>';
$config['breadcrumb']['link_open']  	   = '<a>';
$config['breadcrumb']['link_close'] 	   = '</a>';