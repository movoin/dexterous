<?php
/**
 * 事件
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    dexterous
 * @category   components
 * @version    $Id$
 * @since 1.0
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

class DexEvent extends CEvent
{
    /**
     * @var DexModel 数据模型
     */
    private $_model;

    /**
     * 构造函数
     *
     * @param mixed $sender
     * @param mixed $model
     * @access public
     * @return void
     */
    public function __construct($sender, $model=null)
    {
        $this->_model = $model;
        parent::__construct($sender);
    }

    /**
     * @return DexModel
     */
    public function getModel()
    {
        return $this->_model;
    }
}
