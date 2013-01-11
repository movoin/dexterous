<?php
/**
 * 别名函数
 * 提供对常用静态方法的简易调用别名
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    dexterous
 * @category   utils
 * @version    $Id$
 * @since 1.0
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

/**
 * Constructs a URL.
 * 
 * @param mixed $route 
 * @param array $params 
 * @param string $ampersand 
 * @access public
 * @return string
 */
function url($route, $params=array(), $ampersand='&')
{
    return Yii::app()->createUrl($route, $params, $ampersand);
}

/**
 * CVarDumper::dump() 方法别名
 *
 * @param mixed $vals
 * @access public
 * @return void
 */
function dump($vals)
{
    CVarDumper::dump($vals);
}
