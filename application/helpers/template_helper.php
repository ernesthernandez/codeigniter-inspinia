<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Template Helpers
 *
 * @package   CodeIgniter
 * @subpackage  Helpers
 * @category  Helpers
 * @author    EllisLab Dev Team
 * @link    https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('css'))
{
    /**
     * Attach Cascading Style Sheet file to the current template.
     * @param string  $css_file CSS file route.
     * @return void
     */
  function css($styles)
  {
    $CI =& get_instance();

    return $CI->template->set_css($styles);
  }
}


if ( ! function_exists('js'))
{
    /**
     * Attach Javascript file to the current template.
     * @param string  $js_file JS file route.
     * @return void
     */
  function js($scripts)
  {
    $CI =& get_instance();

    return $CI->template->set_js($scripts);
  }
}


if ( ! function_exists('code'))
{
    /**
     * Output pretty print code for development
     * @param array  $code
     * @return void
     */
     function code($code, $exit = true)
     {
          print('<pre>');
          print_r($code);
          print('</pre>');
          if ($exit)
          {
            exit;
          }
     }
}


if ( ! function_exists('view'))
{
    /**
     * render view
     * @param array  $code
     * @return void
     */
     function view($view, $params, $return = FALSE)
     {
          $CI =& get_instance();

          return $CI->template->view($view, $params, $return);
     }
}

if ( ! function_exists('template'))
{
    /**
     * render template
     * @param array  $code
     * @return void
     */
     function template($view, $params, $return = FALSE)
     {
          $CI =& get_instance();

          return $CI->template->minor($view, $params, $return);
     }
}

if ( ! function_exists('json'))
{
    /**
     * output json string
     * @param array
     * @return string
     */
     function json($json, $status = 200)
     {
          $CI =& get_instance();

          return $CI->template->render_json($json, $status);

     }
}
if ( ! function_exists('html'))
{
    /**
     * output html string
     * @param string
     * @return string
     */
     function html($html, $status = 200)
     {
          $CI =& get_instance();

          return $CI->template->render_html($html, $status);

     }
}

if ( ! function_exists('success'))
{
    /**
     * output success string
     * @param array
     * @return string
     */
     function success($message, $url = '')
     {
          $CI =& get_instance();

          $array = ['response' => 'success', 'message'=> $message, 'success' => true, 'redirect' => $url];

          return $CI->template->render_json($array);

     }
}


if ( ! function_exists('error'))
{
    /**
     * output error string
     * @param array
     * @return string
     */
     function error($message, $url = '')
     {
          $CI =& get_instance();

          $array = ['response' => 'error', 'message'=> $message, 'success' => false, 'redirect' => $url];

          return $CI->template->render_json($array);

     }
}


if ( ! function_exists('response'))
{
    /**
     * output response string
     * @param array
     * @return string
     */
     function response($status = 200)
     {
          $CI =& get_instance();

          return $CI->template->render_json([], $status);

     }
}


if (!function_exists('safe_string')) {
   /**
    * Output safe string.
    *
    * @param      string  $code   codigo a escapar
    * @return     string
    */

   function safe_string($code) {
       $chars = [
      '/\'/',
      '/\"/',
      '/\</',
      '/\>/',
      '/\&/',
      '/\n/',
      '/\r/',
      '/\t/',
      '/\//',
      '/\!/'
       ];

       $rep = [
      '\\\'',
      '\\\"',
      '\\\<',
      '\\\>',
      '\\\&',
      '\\\n',
      '\\\r',
      '\\\t',
      '\\\/',
      '\\\!'
       ];

      return preg_replace($chars, $rep, $code);
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