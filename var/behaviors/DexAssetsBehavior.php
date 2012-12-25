<?php
/**
 * 资源文件管理支持
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

class DexAssetsBehavior extends CBehavior
{
    private $_assetsUrl;

    /**
     * @return string 返回资源文件发布地址
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl===null)
        {
            $alias = $this->getOwner()->getId();
            $type = '';

            if ($this->getOwner() instanceof DexWidget)
                $type = 'application.widgets.';
            else if ($this->getOwner() instanceof DexPlugin)
                $type = 'application.plugins.';

            $this->_assetsUrl = CHtml::asset(Yii::getPathOfAlias($type.$alias.'.assets'),
                false,
                -1,
                YII_DEBUG
            );
        }
        return $this->_assetsUrl;
    }
}

