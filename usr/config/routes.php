<?php
/**
 * 路由规则配置
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    config
 * @category   routes
 * @version    $Id$
 * @since 1.0
 */

return array(
    'components' => array(
        'urlManager' => array(
            'urlFormat'         => 'path',
            'showScriptName'    => false,
            'rules' => array(
                // Homepage
                ''                                          => 'content/page/homepage',
                // User Login
                '<a:(register|login)>'                      => 'user/account/<a>',
                // Sysadm
                'sysadm'                                    => 'cms/systemAdmin/dashboard',
                'sysadm/<m:\w+>/<c:\w+>/*'                  => '<m>/<c>Admin',
                'sysadm/<m:\w+>/<c:\w+>/<a:\w+>/*'          => '<m>/<c>Admin/<a>',
                // Default Rules
                '<controller:\w+>/<id:\d+>'                 => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'    => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'             => '<controller>/<action>',
            )
        )
    )
);
