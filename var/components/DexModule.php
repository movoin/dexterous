<?php
/**
 * 模块基类
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

abstract class DexModule extends CWebModule
{
    /**
     * 模块默认行为组件
     *
     * DexAssetsBehavior 资源管理行为组件
     * DexAttributeBehavior 属性管理行为组件
     *
     * @var array
     */
    public $behaviors = array(
        'DexAssetsBehavior' => array(
            'class' => 'dexter.behaviors.DexAssetsBehavior'
        ),
        'DexAttributeBehavior' => array(
            'class' => 'dexter.behaviors.DexAttributeBehavior'
        )
    );

    /**
     * @var array 模块配置
     */
    protected $config = array(
        'name'          => 'Default',
        'shortName'     => 'Default',
        'description'   => 'Default',
        'version'       => '0.1.0',
        'menus'         => false,
        'options'       => false,
        'widgets'       => false
    );

    /**
     * @return string 模块名称, 后台模块管理显示
     */
    public function getName()
    {
        return $this->config['name'];
    }

    /**
     * @return string 模块短名称, 用于后台菜单及权限设置显示
     */
    public function getShortName()
    {
        return $this->config['shortName'];
    }

    /**
     * @return string 模块描述
     */
    public function getDescription()
    {
        return $this->config['description'];
    }

    /**
     * @return string 模块版本
     */
    public function getVersion()
    {
        return $this->config['version'];
    }

    /**
     * @return bool|array 模块管理功能菜单
     */
    public function getAdminMenus()
    {
        return $this->config['menus'];
    }

    /**
     * @return bool|array 模块允许在后台设置的挂件
     */
    public function getWidgets()
    {
        return $this->config['widgets'];
    }

    /**
     * @return bool|array 模块配置项
     */
    public function getOptions()
    {
        return $this->config['options'];
    }

    /**
     * @return bool 模块安装句柄
     */
    public function install()
    {
        return true;
    }

    /**
     * @return bool 模块卸载句柄
     */
    public function uninstall()
    {
        return true;
    }
}

