<?php
/**
 * 数据库配置
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
    'components' => array(
        'db' => array(
            'connectionString'      => 'mysql:host=localhost;dbname=dexterous',
            'emulatePrepare'        => true,
            'username'              => 'root',
            'password'              => '123456',
            'charset'               => 'utf8',
            'schemaCachingDuration' => 84600,
            'schemaCacheID'         => 'db.schema.cache',
            'queryCachingDuration'  => 30,
            'queryCacheID'          => 'db.query.cache',
            'tablePrefix'           => 'dex_'
        )
    )
);

