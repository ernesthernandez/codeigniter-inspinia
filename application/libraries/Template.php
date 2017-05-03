
<?php
/**
 * @package Codeigniter Inspinia 2.8
 * @author  Ernest Hernandez A.K.A. Pewpewyou
 * @copyright   Copyright (c) 2014 - 2017
 * @license http://opensource.org/licenses/MIT  MIT License
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Template Class
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Parser
 * @author      Ernest Hernandez
 */
class Template
{

    /**
     * Tempplate modules
     * @var string
     */
    private $_parent;
    /**
     * @var mixed
     */
    private $_child;
    /**
     * @var mixed
     */
    private $_dir;
    /**
     * @var mixed
     */
    private $_module = null;
    /**
     * Template Assets
     * @var array
     */
    public $css_files = array();
    /**
     * @var array
     */
    public $js_files = array();
    /**
     * @var array
     */
    public $meta_tags = array();

    /**
     * Array con el contenido a procesar.
     * @var array
     */
    public $data = array();
    /**
     * @var array
     */
    public $json = array();

    /**
     * Template options.
     * @var string
     */
    public $id;
    /**
     * @var mixed
     */
    public $column;
    /**
     * @var array
     */
    protected $size = array();

    /**
     * Template elements
     * @var array
     */
    private $_actions = array();
    /**
     * @var array
     */
    private $_url       = array();
    private $_asset_url = array();
    private $_uri_count = array();
    /**
     * @var array
     */
    protected static $_theme = array();
    /**
     * @var mixed
     */
    protected static $_parser;
    /**
     * Languague name
     * @var array
     */
    protected $_lang_config = array();
    protected $_lang_dir    = array();
    public $_lang;

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     *
     * @access  public
     * @param   $var
     * @return  mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

    /**
     * __construct
     * @return void
     */
    public function __construct()
    {
        $this->load->library('session');
        $this->config->load('site', false, true);
        $this->config->load('template', false, true);
        $this->_parent   = $this->router->fetch_class();
        $this->_child    = $this->router->fetch_method();
        if (method_exists($this->router,'fetch_module')) {
            $this->_module = $this->router->fetch_module();
        }
        $this->_dir      = $this->router->directory;
        $this->_lang     = $this->session->userdata('site_lang');
        $this->_uri_count= $this->uri->total_segments();

        $this->_set_template();
        $this->_set_language();
        self::$_parser= $this->_set_library('parser');
    }

    /**
     * Parse a template
     * Parses pseudo-variables contained in the specified template view,
     * replacing them with the data in the second param.
     *
     * @param   string
     * @param   array
     * @param   bool
     * @return  string
     */
    public function view($template, $data = array(), $return = false) :string
    {
        $this->output->enable_profiler((bool) $this->item('profiler'));
        //Routes
        $data['base_url']      = $this->base_url();
        $data['ci_controller'] = $this->_parent;
        $data['ci_method']     = $this->_child;
        $data['logout_url']    = $this->base_url($this->item('logout_url'));
        $data['login_url']     = $this->base_url($this->item('login_url'));
        //Template Assets
        $data['css_files']     = $this->_process_css($this->css_files);
        $data['js_files']      = $this->_process_js($this->js_files);
        $data['meta']          = $this->_process_meta($this->meta_tags);
        //Application Info
        //$data['title']         = humanize(self::$_parser->parse_string($this->item('title'), $data, true));
        $data['title']         = $this->item('title');
        $data['favicon']       = $this->item('favicon');
        $data['company_name']  = ucfirst($this->item('company_name'));
        $data['app_name']      = ucfirst($this->item('app_name'));
        $data['app_version']   = $this->item('app_version');
        $data['app_year']      = $this->item('app_year');
        //Application Info
        $data['body_class']    = trim($this->item('body_class'));
        $data['nav_class']     = $this->_process_nav_class($this->item('body_class'));
        //Template structure
        $data['content']       = $this->render($template, $data);
        $data['menu']          = $this->_process_menu();
        $data['navigation']    = $this->render(self::$_theme['navigation'], $data);
        //Heading
        $data['breadcrumbs']   = $this->_process_breadcrumbs();
        //Language And Titles
        $data['section_title'] = $this->_process_title();
        $data['lang_list']     = $this->_process_language_list();
        $data['section_back']  = $this->_process_back_buttom();
        //Layout Structure
        $data['pageheading']   = $this->_uri_count != 0 ? $this->render(self::$_theme['pageheading'], $data) : '';
        $data['topnavbar']     = $this->render(self::$_theme['topnavbar'], $data);
        $data['footer']        = $this->render(self::$_theme['footer'], $data);
        $data['body']          = $this->render(self::$_theme['template'], $data);

        return $this->render('themes/_core', $data, $return);
    }

    /**
     * Parse a minor template
     * Parses pseudo-variables contained in the specified template view,
     * replacing them with the data in the second param.
     *
     * @param   string
     * @param   array
     * @param   bool
     * @return  string
     */
    public function minor($template, $data = array(), $return = false) :string
    {
        $this->output->enable_profiler((bool) $this->item('profiler'));
        //Routes
        $data['base_url']      = $this->base_url();
        $data['logout_url']    = $this->base_url($this->item('logout_url'));
        $data['login_url']     = $this->base_url($this->item('login_url'));
        $data['referer_url']   = $this->base_url($this->_parent . '/' . $this->_child);
        //Template Assets
        $data['css_files']     = $this->_process_css($this->css_files);
        $data['js_files']      = $this->_process_js($this->js_files);
        $data['meta']          = $this->_process_meta($this->meta_tags);
        //Application Info
        $data['title']         = $this->item('title');
        $data['favicon']       = $this->item('favicon');
        $data['company_name']  = ucfirst($this->item('company_name'));
        $data['app_name']      = ucfirst($this->item('app_name'));
        $data['app_version']   = $this->item('app_version');
        $data['app_year']      = $this->item('app_year');
        //Application Info
        $data['body_class']    = 'gray-bg';
        $data['body']          = $this->render($template, $data);
        return $this->render('themes/_core', $data, $return);
    }

    /**
     * Fetch a config file item
     *
     * @param   string  $item   Config item name
     * @param   string  $index  Index name
     * @return  string|null The configuration item or NULL if the item doesn't exist
     */
    public function item($name, $index = '')
    {
       return $this->config->item($name, $index);
    }
    /**
     * Base URL
     *
     * Create a local URL based on your basepath.
     * Segments can be passed in as a string or an array, same as site_url
     * or a URL to a file can be passed in, e.g. to an image file.
     *
     * @param   string  $uri
     * @param   string  $protocol
     * @return  string
     */
    public function base_url($uri = '', $protocol = NULL):string
    {
        if (function_exists('base_url')) {
            return base_url($uri, $protocol);
        } else {
            $base_url = "http://".$_SERVER['HTTP_HOST'];
            $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
            return  $base_url . $uri;
        }
    }
    /**
     * Render a template
     * Parses pseudo-variables contained in the specified template view,
     * replacing them with the data in the second param
     *
     * @param   string
     * @param   array
     * @param   bool
     * @return  string
     */

    public function render($template, $data, $return = true) :string
    {
        return self::$_parser->parse($template, $data, $return);
    }
    /**
     * Render a template string.
     *
     * Parses pseudo-variables contained in the specified string,
     * replacing them with the data in the second param
     *
     * @param   string
     * @param   array
     * @param   bool
     * @return  string
     */

    public function render_string($template, $data, $return = true) :string
    {
        return self::$_parser->parse_string($template, $data, $return);
    }

    /**
     *  Render a json object.
     * @param  json  $data json data to parse
     * @param  integer $code response code
     * @return json        json string object
     */
    public function render_json($data, $code = 200)
    {
        $this->output
            ->set_status_header($code)
            ->set_content_type('application/json')
            ->set_output(json_encode($data))
            ->_display();

        // Display the data and exit execution
        exit;
    }

    /**
     *  Render a html string.
     * @param  html  $data html data to parse
     * @param  integer $code response code
     * @return html        html string object
     */
    public function render_html($data, $code = 200)
    {
        $this->output
            ->set_status_header($code)
            ->set_content_type('text/html')
            ->set_output($data)
            ->_display();

        // Display the data and exit execution
        exit;
    }

    /**
     * Process classes for navbar depends of body class, only  takes effect if
     * you use ADMIN LTE, INSPINIA or any bootsrap admin template.
     * @return string
     */
    private function _process_nav_class($class) :string
    {
        if(strpos($class, 'fixed-nav') == false)
            $class = 'navbar-static-top';
        else
            $class = 'navbar-fixed-top';

        return $class;
    }

    /**
     * Process all stylesheets for template.
     * @param $files
     * @return string
     */
    private function _process_css($files) :string
    {
        $css_files = array_merge($this->item('css_files'), $files);
        $html = array();

        foreach ($css_files as $css)
        {
            $html[] = '<link href="' . $css . '" rel="stylesheet">';
        }

        return implode(PHP_EOL, $html);
    }

    /**
     * Process all javascript files for template.
     * @param $files
     * @return string
     */
    private function _process_js($files) :string
    {
        $js_files = array_merge($this->item('js_files'), $files);
        $html = array();

        foreach ($js_files as $js)
        {
            $html[] = '<script src="' . $js . '"></script>';
        }

        return implode(PHP_EOL, $html);
    }

    /**
     * Process meta tags from a configuration file.
     * @param $tags
     */
    private function _process_meta($tags) :string
    {
        $meta_tags = array_merge($tags, $this->item('meta'));
        $html = array();

        foreach ($meta_tags as $name => $content)
        {
            $html[] = '<meta name="' . $name . '" content="' . $content . '">';
        }

        return implode(PHP_EOL, $html);
    }

    /**
     * Generates meta tags from an array of key/values
     *
     * @param   array
     * @param   string
     * @return  object
     */
    public function set_meta($name = '', $content = '') :self
    {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if (!is_array($name))
            $meta_tags[] = array($name => $content);
        else
            $meta_tags[] = $name;

        return $this;
    }

    /**
     * Attach Cascading Style Sheet file to the current template.
     * @param array  $css_file CSS file route.
     * @return void
     */
    public function set_css()
    {
        $css_files = func_get_args();

        foreach ($css_files as $css_file)
        {
            $is_external = filter_var($css_file, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);

            if (!$is_external)
            {
                $this->css_files[sha1($css_file)] = $this->_get_path($css_file, 'css');
            }
            else
            {
                $this->css_files[sha1($css_file)] = $css_file;
            }
        }
    }

    /**
     * Attach Javascript file to the current template.
     * @param array  $js_file JS file route.
     * @return void
     */
    public function set_js()
    {
        $js_files = func_get_args();

        foreach ($js_files as $js_file)
        {
            $is_external = filter_var($js_file, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
            if (!$is_external)
            {
                $this->js_files[sha1($js_file)] = $this->_get_path($js_file, 'js');
            }
            else
            {
                $this->js_files[sha1($js_file)] = $js_file;
            }
        }
    }

    /**
     * Create all template view paths used to load views and files.
     *
     * @return array
     */
    public function _set_template() :array
    {
        $_t_path  = 'themes/' . $this->item('theme') . '/';
        $_ci_path = APPPATH.'views/'.$_t_path;

        if (!file_exists($_ci_path))
        {
            show_error('Unable to load the requested theme directory: '.$_t_path.
                '
                <pre>
                Please make sure you have this files in your theme directory before continue:
                    _navigation.php
                    _pageheading.php
                    _topnavbar.php
                    _footer.php
                    application.php
                <pre>');
        }

        self::$_theme['navigation']  = $_t_path . '_navigation';
        self::$_theme['pageheading'] = $_t_path . '_pageheading';
        self::$_theme['topnavbar']   = $_t_path . '_topnavbar';
        self::$_theme['footer']      = $_t_path . '_footer';
        self::$_theme['template']    = $_t_path . 'application';

        return self::$_theme;
    }

    /**
     * Checks if codeigniter library is loaded. If not loaded, load it.
     * @param  string $name nombre de la clase.
     * @return object
     */
    protected function _set_library($name)
    {
        $this->load->library($name);
        return $this->$name;
    }

    /**
     * Autoload languages from configuration file.
     * @return void
     */
    private function _set_language()
    {
        $this->_lang_config = $this->item('multilingual');

        if ($this->_lang)
        {
            $this->session->set_userdata('site_lang',  $this->_lang_config['default']);
        }

        $langfile = preg_replace('/_lang$/', '', $this->_parent) . '_lang.php';
        $langpath = APPPATH . 'language/' . $this->_lang_config['default'];
        $this->_lang_dir = $langpath . '/' . $langfile;

        if (!is_dir($langpath))
        {
            mkdir($langpath, 0777, true);
        }

        $this->load->helper(['file', 'inflector']);

        if (!file_exists($this->_lang_dir) && !is_null($this->_parent))
        {
            write_file($this->_lang_dir, "<?php defined('BASEPATH') OR exit('No direct script access allowed');" . PHP_EOL);
        }

        if (isset($this->_lang_config['autoload']))
        {
            $autoload = $this->_lang_config['autoload'];
            array_push($autoload, $this->_parent);

            $this->lang->load($autoload, $this->_lang);
        }
    }

    /**
     * Add class string on a html tag
     * @param string $class    class name
     * @param string $template html tag to inject.
     * @return string
     */
    private function _set_class($class, $template)
    {
        if (is_array($class))
        {
            $class = trim(implode("\n", $class));
        }

        return str_replace('>', ' class="' . $class . '">', $template);
    }

    /**
     * Add href string on a html tag
     * @param string $url    url string
     * @param string $template html tag to inject.
     * @return string
     */
    private function _set_href($url, $template) :string
    {
        $is_url = filter_var($url, FILTER_VALIDATE_URL);

        if (!is_string($url) || is_null($url))
        {
            $url = 'javascript:void(0)';
        }
        elseif (!$is_url)
        {
            $url = $this->base_url($url);
        }

        return str_replace('>', ' href="' . trim($url) . '">', $template);
    }

    /**
     * Add an unique id for identify html element
     * @param string $id      element identifier
     * @param string $template html tag to inject.
     * @return string
     */
    private function _set_id($id = '', $template) :string
    {
        $id = empty($id) ? uniqid('element-', true) : $id;

        return str_replace('>', ' id="' . $id . '">', $template);
    }

    /**
     * Enable parametrize responsive column based on twitter bootstrap framework.
     * @param $size
     * @param $type
     * @param $offset
     * @param null $pull
     * @return string
     */
    public function set_size($size = 6, $type = 'medium', $offset = null, $pull = null) :string
    {
        $this->size[] = ['size' => $size, 'type' => $type, 'offset' => $offset, 'pull' => $pull];
        return $this->size;
    }

    /**
     * Enable to use responsive column grid for template based on bootstrap framework.
     * @return string
     */
    private function set_column() :string
    {

        $sizes = count($this->size);

        $cols = array();

        for ($i = 0; $i < $sizes; $i++) {
            $type   = $this->size[$i]['type'];
            $pull   = $this->size[$i]['pull'];
            $offset = $this->size[$i]['offset'];
            $size   = $this->size[$i]['size'];

            if ($size > 12) {
                $size = 12;
            }

            switch ($type) {
                case 'xs':
                case 'extra-small':
                case 'tiny':
                    $col = 'col-xs-';
                    break;
                case 'sm':
                case 'movil':
                case 'small':
                    $col = 'col-sm-';
                    break;
                case 'md':
                case 'tablet':
                case 'medium':
                default:
                    $col = 'col-md-';
                    break;
                case 'lg':
                case 'desktop':
                case 'large':
                    $col = 'col-lg-';
                    break;
            }

            $cols[$type] = $col . $size;

            if (!is_null($offset)) {
                $cols[] = $col . 'offset-' . $offset;
            }

            if (!is_null($pull)) {
                $cols[] = $col . 'pull-' . $pull;
            }
        }
        return implode(' ', array_unique($cols, SORT_STRING));
    }

    /**
     * Assignn all key value pairs of template data.
     * @return array
     */
    private function set_data() :array
    {
        $this->column = $this->set_column();
        $this->get_json();

        $args = $this->get_render_vars();

        $args = array_filter($args);

        foreach ($args as $key => $value) {
            $this->data[$key] = $value;

        }
        return $this->data;
    }

    /**
     * Parse array to json string.
     * @param $json
     * @return string
     */
    public function set_json($json) :string
    {
        return $this->json = json_encode($json, JSON_UNESCAPED_SLASHES);
    }

    /**
     * Set language line or create if doesn't exist.
     * @param $line
     * @param $prefix
     * @return mixed
     */
    private function set_lang($line, $prefix ='')
    {
        $lang_line = $this->lang->line($line, false);

        if ($lang_line === false)
        {
            //$this->_process_lang_line($line, $prefix);
            //return redirect($this->uri->uri_string(), 'refresh');
            $lang_line = "['" . $line . "']";
        }

        return $lang_line;
    }

    /**
     * Create an unexsistant languague key value pair language array.
     * @param $line
     * @param $prefix
     * @return void
     */
    private function _process_lang_line($line, $prefix)
    {
        switch ($prefix)
        {
            case 'menu_':
                $f = 'menu';
                break;
            case 'breadcrumb_':
                $f = 'breadcrumb';
                break;
            default:
                $f = $this->_parent;
                break;
        }
        write_file($this->_lang_dir, sprintf('%s$lang["%s%s"] = "%s";%s', PHP_EOL, $prefix, $line, humanize($line), PHP_EOL), 'a+');
    }
    /**
     * Build a dinamic menu from config file and set default template config/template.php
     *
     * @param  string $conf Configuración de menu a cargar.
     * @return string HTML raw code
     */
    private function _process_menu(): string
    {
        $menu       = $this->item('menu');
        $theme_name = $this->item('theme');
        $template   = $this->item($theme_name);

        $out = (string) '';

        foreach ($menu as $parent => $url)
        {
            $parents   = $menu[$parent];
            $children  = array_key_exists('children', $parents);
            $parent_id = basename($parents['url']);

            $out .= $this->is_parent($parent, $template['active_class'], $template['list_open']);

            $out .= $children && $template['enable_id']? $this->_set_href('#'.$parent_id,  $template['link_open']) : $this->_set_href($parents['url'], $template['link_open']);

            $out .= $this->_set_class($template['icon_class'] . $parents['icon'], $template['icon_open']);

            $out .= $template['icon_close'];

            $out .= $template['label_open'];

            $out .= $this->set_lang($parent);

            $out .= $template['label_close'];

            $out .= $children ? $template['expandable_icon'] : '';

            $out .= $template['icon_close'];

            $out .= $template['link_close'];

            if ($children)
            {
                $children = $parents['children'];

                $out .= $this->_set_id($parent_id, $template['second_level_open']);

                foreach ($children as $child => $url)
                {

                    $out .= $this->is_child($child, $template['active_class'], $template['list_open']);

                    if (is_array($children[$child]))
                    {
                        $out .= $this->_set_href($url, $template['link_open']);

                        $out .= $this->set_lang($child);

                        $out .= $template['expandable_icon'];

                        $out .= $template['icon_close'];

                        $out .= $template['link_close'];

                        $out .= $template['third_level_open'];

                        foreach ($children[$child] as $subchild => $url)
                        {

                            $out .= $this->is_subchild($subchild, $template['active_class'], $template['list_open']);

                            $out .= $this->_set_href($url, $template['link_open']);

                            $out .= $this->set_lang($child . '_' . $subchild);

                            $out .= $template['link_close'];

                            $out .= $template['list_close'];
                        }

                        $out .= $template['third_level_close'];

                    }
                    else
                    {

                        $out .= $this->_set_href($url, $template['link_open']);

                        $out .= $this->set_lang($child);

                        $out .= $template['link_close'];
                    }

                    $out .= $template['list_close'];
                }
                $out .= $template['second_level_close'];
            }

            $out .= $template['list_close'];
        }
        unset($template);
        unset($menu);
        return $out;
    }

    /**
     * Check if current controller is active.
     * @param string $parent controller name.
     * @param string $class  class name.
     * @param string $template html tag to inject.
     * @return string
     */
    private function is_parent($parent, $class, $template) : string
    {
        if ($parent == $this->_parent)
        {
            $out = $this->_set_class($class, $template);
        }
        else
        {
            $out = $template;
        }

        return $out;
    }
    /**
     * Check if current method is active.
     * @param string $child controller name.
     * @param string $class  class name.
     * @param string $template html tag to inject.
     * @return string
     */

    private function is_child($child, $class, $template): string
    {
        if ($child == $this->_child)
        {
            $out = $this->_set_class($class, $template);
        }
        else
        {
            $out = $template;
        }

        return $out;
    }

    /**
     * Check if third uri segment is active.
     * @param string $subchild controller name.
     * @param string $class  class name.
     * @param string $template html tag to inject.
     * @return string
     */

    private function is_subchild($subchild, $class, $template): string
    {
        if ($subchild == $this->uri->segment(3) && is_null($this->_module))
        {
            $out = $this->_set_class($class, $template);
        }
        elseif($subchild == $this->uri->segment(4) && !is_null($this->module))
        {
            $out = $this->_set_class($class, $template);
        }
        else
        {
            $out = $template;
        }

        return $out;
    }

    /**
     * Parse a Breadcrumb object.
     * @return string HTML of breadcrumbs.
     */
    public function _process_breadcrumbs() :string
    {
        $template = $this->item('breadcrumb');

        $uri = $this->_uri_count;

        $out = (string) '';

        $out .= $template['breadcrumb_open'];

        if ($uri !== 0)
        {
            $url = [];
            $lang_line = [];

            // default home breadcrumb

            $out .= $template['list_open'];

            $out .= $this->_set_href($this->base_url($this->_module), $template['link_open']);

            $out .= $this->set_lang('main_home');

            $out .= $template['link_close'];

            $out .= $template['list_close'];


            for ($i = 1; $i <= $uri; $i++)
            {
                $current = $this->uri->segment($i);
                $before  = $this->uri->segment($uri - 1);
                $last    = $this->uri->segment($uri);
                $url[$i] = $current;

                if (!is_numeric($current))
                {
                    $this->_url[$i] = implode('/', $url);
                    $this->_url[1]  = null;
                    if (!is_null($this->_module) && $i == 1)
                        continue;
                    elseif(!is_null($this->_module))
                        $this->_url[2]  = null;

                    $lang_line[$i]  = implode('_', $url);

                    if (($current == $last && is_string($last)) || ($current == $before && is_numeric($last)))
                    {
                        $out .= $this->_set_class('active', $template['list_open']);;

                        $out .= $template['list_active'];

                        $out .= $this->_set_href($this->_url[$i], $template['link_open']);

                        $out .= $this->set_lang($lang_line[$i]);

                        $out .= $template['link_close'];

                        $out .= $template['list_active_close'];

                        $out .= $template['list_close'];

                    }
                    else
                    {
                        $out .= $template['list_open'];

                        $out .= $this->_set_href($this->_url[$i], $template['link_open']);

                        $out .= $this->set_lang($lang_line[$i]);

                        $out .= $template['link_close'];

                        $out .= $template['list_close'];
                    }
                }
            }
    }
    else
    {
        $out .= $template['list_open'];

        $out .= $this->_set_href($this->base_url(), $template['link_open']);

        $out .= $this->set_lang($this->_parent);

        $out .= $template['link_close'];

        $out .= $template['list_close'];
    }

    $out .= $template['breadcrumb_close'];

    return $out;
    }

    /**
     * Obtain current module name.
     * @return string
     */
    private function _process_title() :string
    {
        $uri = $this->_uri_count;

        if ($uri !== 0)
        {
            $url = [];
            $lang_line = [];

            for ($i = 1; $i <= $uri; $i++)
            {
                $current = $this->uri->segment($i);
                $url[$i] = $current;

                if (!is_numeric($current))
                {
                    $lang_line[$i] = implode('_', $url);

                    $title = $this->set_lang($lang_line[$i], 'title_');
                }
            }
        }
        else
        {
            $title = $this->set_lang($this->_parent, 'title_');
        }
        return $title;
    }
    /**
     * Render a CRUD object using the grocery crud library.
     * @param string  $table     table name.
     * @param array   $columns   columns to display an aliases. [col_name => aliases]
     * @param array   $types     Specify colum type [field => type]
     * @param array   $unset     fields to ignore by default
     * @param array   $actions   actions to display
     * @param string  $language  languague to set, by default english
     * @return array
     */
    public function crud($table, $columns, $unset = null, $types = null,  $callback = null, $language = "english") :array
    {
        try

        {
            $crud = new grocery_CRUD();

            if (is_string($table)) {
                $crud->set_table($table);
            } elseif (is_array($table)) {
                $primary_table = (string) array_shift($table);
                $crud->set_table($primary_table);

                if (array_key_exists('set_relation', $table))
                {
                    foreach ($table['set_relation'] as $value) {
                        call_user_func_array(array($crud, 'set_relation'), $value);
                    }
                } elseif (array_key_exists('relation_n_n', $table)) {
                    foreach ($table['relation_n_n'] as $value) {
                        call_user_func_array(array($crud, 'set_relation_n_n'), $value);
                    }
                } else {
                    foreach (array_pop($table) as $value) {
                        call_user_func_array(array($crud, 'set_relation'), $value);
                    }
                }
            }

            $fields  = array_keys($columns);
            call_user_func_array(array($crud, 'columns'), $fields);

            if (is_array($callback))
            {
                foreach ($callback as $key => $value)
                {
                    $crud->callback_column($key, $value);
                }
            }

            if (is_array($unset))
            {
                $action_fields  = array_diff($fields, $unset);

                //call_user_func_array(array($crud, 'required_fields'), $action_fields);
                call_user_func_array(array($crud, 'add_fields'), $action_fields);
                call_user_func_array(array($crud, 'edit_fields'), $action_fields);

                $crud->unset_fields($unset);
                in_array('add', $unset) ? $crud->unset_add() : '';
                in_array('edit', $unset) ? $crud->unset_edit() : '';
                in_array('delete', $unset) ? $crud->unset_delete() : '';
                in_array('read', $unset) ? $crud->unset_read() : '';
                in_array('list', $unset) ? $crud->unset_list() : '';
                in_array('export', $unset) ? $crud->unset_export() : '';
                in_array('print', $unset) ? $crud->unset_print() : '';
            }
            elseif ($unset == 'all')
            {
                $crud->unset_operations();
            }
            unset($fields);
            unset($unset);

            foreach ($columns as $column => $aliases)
            {
                call_user_func(array($crud, 'display_as'), $column, $aliases);
            }

            if (is_array($types))
            {
                foreach ($types as $field => $type)
                {
                    if ($type == 'unique') {
                        call_user_func(array($crud, 'unique_fields'), $field);
                    }

                    call_user_func(array($crud, 'field_type'), $field, $type);
                }
            }

            unset($types);
            unset($columns);

            $lang = $this->_lang ? $this->_lang : $language;

            //$crud->set_crud_url_path($this->uri->uri_string());

            $crud->set_language($lang);
            $crud->unset_jquery()->unset_jquery_ui()->unset_bootstrap();

            $out = $crud->render();

            call_user_func_array(array($this->template, 'set_css'), $out->css_files);
            call_user_func_array(array($this->template, 'set_js'), $out->js_files + $out->js_config_files);

            return array('crud' => $out->output);
        } catch (Exception $e) {
            show_error($e->getMessage()); //$e->getTraceAsString()
        }
    }

    /**
     * Get a specific path of asset directory.
     * @param $file
     * @param $type
     * @return string
     */
    private function _get_path($file, $type = '') :string
    {
        switch ($type) {
            case 'css':
                $path = $this->item('css_path', 'directories');
                break;
            case 'js':
                $path = $this->item('js_path', 'directories');
                break;
            case 'less':
                $path = $this->item('less_path', 'directories');
                break;
            case 'img':
                $path = $this->item('img_path', 'directories');
                break;
            case 'upload':
                $path = $this->item('upload_path', 'directories');
                break;
            case 'download':
                $path = $this->item('download_path', 'directories');
                break;
            default:
                $path = $this->item('asset_path', 'directories');
                break;
        }
        return $this->base_url($path . $file);
    }


    /**
     * Get all CSS routes of the templates.
     * @return array
     */
    public function get_css_files()
    {
        return $this->css_files;
    }

    /**
     * Get all Javascript of the templates
     * @return array
     */
    public function get_js_files()
    {
        return $this->js_files;
    }

    /**
     * @return array
     */
    public function get_meta_tags()
    {
        return $this->meta_tags;
    }

    /**
     * @return string
     */
    public function get_json()
    {
        return $this->json;
    }

    /**
     * Get all template data.
     * @return array
     */
    public function get_data()
    {
        return $this->data;
    }

    public function get_template()
    {
        return self::$_theme[$this->get_widget_name()];
    }

    /**
     * Get the current size of widget.
     * @return int
     */
    public function get_size()
    {
        return $this->size;
    }
    /**
     * Get the current class variables.
     * @return array
     */
    public function get_render_vars()
    {
        return get_object_vars($this);
    }
    /**
     * Get the current class variables and his childs.
     * @return array
     */
    public function get_available_vars()
    {
        return get_class_vars(get_class($this));
    }
    /**
     * Get the current widget name.
     * @return array
     */
    public function get_widget_name()
    {
        return strtolower(get_class($this));
    }
    /**
     * Render widget view. Betä*
     * @return string
     */
    public function _process_widget()
    {
        $this->set_data();
        return $this->render($this->get_template(), $this->get_data(), true);
    }

    private function _process_back_buttom()
    {
        $label = $this->set_lang('return_label', 'section_');
        $c = count($this->_url);
        if ($c > 2 && is_null($this->_module))
        {
        $url = $this->_url[$c - 1];
        return sprintf("<a href='%s' class='btn btn-default'><i class='fa fa-arrow-left'></i>&nbsp;%s</a>", $url, $label);
        } elseif($c > 3 && !is_null($this->_module))
        {
        $url = $this->_url[$c - 1];
        return sprintf("<a href='%s' class='btn btn-default'><i class='fa fa-arrow-left'></i>&nbsp;%s</a>", $url, $label);
        }
    }

    /**
     * Creates a navbar list from array of languagues.
     * @return string
     */
    private function _process_language_list()
    {

        $langs = $this->_lang_config['available'];

        $out = '<ul class="dropdown-menu animated m-t-xs">';

        foreach ($langs as $key => $value)
        {
            $out .= '<li>';
            $out .= sprintf('<a rel="%s" data-language="%s" href="%s"> %s</a>',$key, $value['value'], $this->uri->uri_string().'?lang='. $key, $value['label']);
            $out .= '</li>';
        }

        $out .= '</ul>';

        return $out;
    }

}
