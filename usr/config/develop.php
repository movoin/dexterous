<?php
/**
 * 开发模式配置
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    config
 * @category   develop
 * @version    $Id$
 * @since 1.0
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

return array(
    'components' => array(
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class'         => 'CFileLogRoute',
                    'categories'    => 'application',
                    'levels'        => 'trace',
                    'logPath'       => RUNTIME_PATH.DS.'log',
                    'logFile'       => 'trace.log',
                    'filter'        => 'CLogFilter',
                    'maxFileSize'   => 1024
                ),
                array(
                    'class'         => 'CFileLogRoute',
                    'categories'    => 'application',
                    'levels'        => 'error',
                    'logPath'       => RUNTIME_PATH.DS.'log',
                    'logFile'       => 'error.log',
                    'filter'        => 'CLogFilter',
                    'maxFileSize'   => 1024
                )
            )
        )
    )
);
