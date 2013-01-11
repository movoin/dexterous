<?php
/**
 * 后端控制器基类
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

abstract class DexAdminController extends DexController
{
    /**
     * @var string 布局设置
     */
    public $layout = '//layouts/main';
    /**
     * @var string 默认控制器方法
     */
    public $defaultAction = 'manage';

    /**
     * 控制器方法名称
     *
     * @static
     * @access public
     * @return array
     */
    public static function actionTitles()
    {
        return array();
    }

    /**
     * 控制器方法执行之前
     *
     * @param CAction $action
     * @access public
     * @return boolean
     */
    public function beforeAction($action)
    {
        $this->setTitle($action);

        return true;
    }

    /**
     * 设置页面标题
     *
     * @param string $action
     * @access public
     * @return void
     */
    public function setTitle($action)
    {
        $action_titles = call_user_func(array(get_class($action->controller), 'actionTitles'));

        if (!isset($action_titles[ucfirst($action->id)]))
            throw new CHttpException(Yii::t('dexter', 'Action `{name}` no found', array('{name}' => $action->id)));

        $this->pageTitle = $action_titles[ucfirst($action->id)];
    }
}
