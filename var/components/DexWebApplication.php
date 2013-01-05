<?php
/**
 * Dexterous 应用基类
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

class DexWebApplication extends CWebApplication
{
    /**
     * @var string 语言设置
     */
    public $sourceLanguage = 'zh_cn';

    /**
     * @return DexPluginManager 返回插件管理组件句柄
     */
    public function getPluginManager()
    {
        return $this->getComponent('pluginManager');
    }

    /**
     * 判断是否是指定模块
     *
     * @param string $moduleName 模块名称
     *
     * @return boolean
     */
    public function isModule($moduleName)
    {
        return Yii::app()->getController() && Yii::app()->getController()->getModule()->getId() === $moduleName;
    }

    /**
     * 判断是否是指定控制器类
     *
     * @param string $controllerName 控制器名称
     *
     * @return boolean
     */
    public function isController($controllerName)
    {
        return Yii::app()->getController() && Yii::app()->getController()->getId() === $controllerName;
    }

    /**
     * 判断是否是指定控制器方法
     *
     * @param string $actionName 控制器方法名称
     *
     * @return boolean
     */
    public function isAction($actionName)
    {
        return Yii::app()->getController() && Yii::app()->getController()->getAction() &&
                Yii::app()->getController()->getAction()->getId() === $actionName;
    }

    /**
     * 匹配当前方法的模块, 控制器及控制器方法
     *
     * @param string $controllerName 控制器名称
     * @param string $actionName 控制器方法名称
     * @param string $moduleName 模块名称
     *
     * @return boolean
     */
    public function isControllerAction($controllerName, $actionName=null, $moduleName=null)
    {
        if (!empty($controllerName) && !empty($actionName) && !empty($moduleName))
            return $this->isModule($moduleName) && $this->isController($controllerName) && $this->isAction($actionName);
        else if (empty($moduleName))
            return $this->isController($controllerName) && $this->isAction($actionName);
        else
            return false;
    }

    /**
     * 事件定义, 当视图中的 <body> 输出后被触发
     * 此事件由 DexController 中的 afterBodyStart() 方法注册
     * afterBodyStart() 方法在 Layout 视图中 <body> 标签输出后触发
     *
     * @param CEvent $event 事件句柄
     *
     * @return void
     */
    public function onAfterBodyStart($event)
    {
        $this->raiseEvent('onAfterBodyStart', $event);
    }

    /**
     * 事件定义, 当视图中的 </body> 输出后被触发
     * 此事件由 DexController 中的 beforeBodyEnd() 方法注册
     * beforeBodyEnd() 方法在 Layout 视图中 </body> 标签输出后触发
     *
     * @param CEvent $event 事件句柄
     *
     * @return void
     */
    public function onBeforeBodyEnd($event)
    {
        $this->raiseEvent('onBeforeBodyEnd', $event);
    }

    /**
     * 注册核心组件
     *
     * @access protected
     * @return void
     */
    protected function registerCoreComponents()
    {
        parent::registerCoreComponents();

        $components = array(
            'cache' => array(
                'class' => 'CFileCache',
            ),
            'pluginManager' => array(
                'class' => 'DexPluginManager',
            ),
            'user' => array(
                'class' => 'DexWebUser',
            ),
        );

        $this->setComponents($components);
    }

    /**
     * 初始化应用
     *
     * @access protected
     */
    protected function preinit()
    {
        // 设置 dexter 路径别名
        Yii::setPathOfAlias('dexter', VAR_PATH);
    }
}
