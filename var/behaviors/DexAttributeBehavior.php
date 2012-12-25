<?php
/**
 * 基于数据库的属性读写支持
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    dexterous
 * @category   behaviors
 * @version    $Id$
 * @since 1.0
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

class DexAttributeBehavior extends CBehavior
{
    public $attributeTable = '{{options}}';
    public $attributeTypeFiled = 'type';

    private $_attributes;

    /**
     * 为组件对象附加行为组件
     *
     * @param CComponent $owner
     */
    public function attach($owner)
    {
        parent::attach($owner);
    }

    public function getAttributes()
    {
    }

    public function setAttributes($values)
    {
    }

    public function resetAttributes()
    {
    }

    public function flushAttributes()
    {
    }
}

