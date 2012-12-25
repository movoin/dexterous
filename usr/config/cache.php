<?php
/**
 * 缓存配置
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    application
 * @category   config
 * @version    $Id$
 * @since 1.0
 */

return array(
    'components' => array(
        'cache' => array(
            //'class' => 'CApcCache',
            'class' => 'CFileCache',
            'cachePath' => RUNTIME_PATH.DS.'cache'
        )
    )
);

