<?php
/**
 * 环境配置文件
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    application
 * @category   config
 * @version    $Id$
 * @since 1.0
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

return array(
    'name' => 'OCPM',
    'basePath' => USR_PATH,
    'runtimePath' => RUNTIME_PATH,
    'preload' => array('log'),
    'import' => array(
        'application.widgets.*',
        'application.components.*'
    ),
    'components' => array(
        'themeManager' => array(
            'basePath' => USR_PATH.DS.'themes'
        ),
        'errorHandler' => array(
            'errorAction' => 'content/page/error'
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'cssFile' => false
                )
            )
        )
    )
);

