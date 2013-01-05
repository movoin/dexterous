<?php
/**
 * 入口文件
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    public
 * @category   index
 * @version    $Id$
 * @since 1.0
 */

// 正式运行时注释两句可以得到更好的性能
defined('YII_DEBUG') or define('YII_DEBUG', true);

// 载入引导文件
include getcwd().'/../var/Dexter.php';

// 运行
Dexter::bootstrap()->run();

