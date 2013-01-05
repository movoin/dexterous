<?php echo "<?php\n"; ?>
/**
 * <?php echo $moduleID; ?> 模块
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    application
 * @category   module
 * @version    $Id$
 * @since 1.0
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

class <?php echo $moduleClass; ?> extends DexModule
{
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

    public function init()
    {
        $this->setImport(array(
            '<?php echo $moduleID; ?>.models.*',
            '<?php echo $moduleID; ?>.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            return true;
        }
        else
            return false;
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
