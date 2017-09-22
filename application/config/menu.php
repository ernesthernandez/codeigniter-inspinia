<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['menu'] = array(
        'dashboard' => array(
            'icon'      => 'th-large',
            'group'     => ['user'],
            'url'       => '/',
        ),
        'github' => array(
            'icon'      => 'github',
            'group'     => ['user'],
            'url'       => 'https://github.com/pewpewu/codeigniter-inspinia',
        ),
        'levels' => array(
            'url'            => '#',
            'icon'           => 'sitemap',
            'group'          => ['user'],
            'children'       => array(
                'two'  =>  '#',
                'three' => [
                    'item'       => '#',
                    'item'       => '#',
                ]
            )
        ),
        'config' => array(
            'url'            => '#',
            'icon'           => 'cogs',
            'group'          => ['user'],
            'children'       => array(
                'user'       => 'config/user',
                'notify'     => 'config/notify'
            )
        ),
    );