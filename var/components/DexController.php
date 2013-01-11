<?php
/**
 * 控制器基类
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

abstract class DexController extends CController
{
    /**
     * @var string 主题模板资源访问地址
     */
    private $_themeAssetsUrl;

    /**
     * @return string 返回主题资源文件访问地址
     */
    public function getThemeAssetsUrl()
    {
        if ($this->_themeAssetsUrl === null)
        {
            $this->_themeAssetsUrl = CHtml::asset(Yii::getPathOfAlias('application.themes.'
                .Yii::app()->theme->name.'.assets'),
                false,
                -1,
                YII_DEBUG
            );
        }
        return $this->_themeAssetsUrl;
    }

    /**
     * 当视图中的 <body> 输出后触发事件
     *
     * @return void
     */
    public function afterBodyStart()
    {
        Yii::app()->onAfterBodyStart(new DexEvent($this));
    }

    /**
     * 当视图中的 </body> 输出后触发事件
     *
     * @return void
     */
    public function beforeBodyEnd()
    {
        Yii::app()->onBeforeBodyEnd(new DexEvent($this));
    }

    /**
     * @throws CHttpException
     */
    protected function pageNotFound()
    {
        throw new CHttpException(404, Yii::t('dexter', 'Page not found!'));
    }

    /**
     * @throws CHttpException
     */
    protected function forbidden()
    {
        throw new CHttpException(403, Yii::t('dexter', 'Forbidden!'));
    }
}
