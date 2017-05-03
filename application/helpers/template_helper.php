<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Template Helpers
 *
 * @package	Inspinia
 * @subpackage	Helpers
 * @category	Helpers
 * @author	Pewpewyou
 * @link		https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('crud'))
{
	/**
     * Render a CRUD object using the grocery crud library.
     * @param string  $table     table name.
     * @param array   $columns   columns to display an aliases. [col_name => aliases]
     * @param array   $types     Specify colum type [field => type]
     * @param array   $unset     fields to ignore by default
     * @param array   $actions   actions to display
     * @param string  $language  languague to set, by default english
     * @return array
     * @return string
     *
     * For reference
     * @link application/libraries/Template.php
     */
     function crud()
     	{
     		$CI =& get_instance();

     		$out =  call_user_func_array(array($CI->template, 'crud'), func_get_args());

     		return $CI->template->view('themes/_crud', $out);
     	}
     }


if ( ! function_exists('css'))
{
    /**
     * Attach Cascading Style Sheet file to the current template.
     * @param string  $css_file CSS file route.
     * @return void
     */
	function css()
	{
		$CI =& get_instance();

		return call_user_func_array(array($CI->template, 'set_css'), func_get_args());
	}
}


if ( ! function_exists('js'))
{
    /**
     * Attach Javascript file to the current template.
     * @param string  $js_file JS file route.
     * @return void
     */
	function js()
	{
		$CI =& get_instance();

		return call_user_func_array(array($CI->template, 'set_css'), func_get_args());
	}
}


if ( ! function_exists('code'))
{
    /**
     * Output pretty print code for development
     * @param array  $code
     * @return void
     */
     function code($code)
     {
          print('<pre>');
          print_r($code);
          print('</pre>');

     }
}
if ( ! function_exists('dd'))
{
    /**
     * Dump and die
     * @param array  $code
     * @return void
     */
     function dd($code)
     {
          var_dump($code);
          die;
     }
}
