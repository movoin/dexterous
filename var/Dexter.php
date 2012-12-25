<?php
/**
 * Dexterous 启动文件
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    dexterous
 * @category   bootstrap
 * @version    $Id$
 * @since 0.1
 */

/* vim: set expandtab softtabstop=4 tabstop=4 shiftwidth=4: */

/* 定义 DIRECTORY_SEPARATOR 的别名 */
defined('DS')           or define('DS', DIRECTORY_SEPARATOR);
/* 定义根目录 */
defined('ROOT_PATH')    or define('ROOT_PATH', dirname(dirname(__FILE__)));
/* 定义公开目录 */
defined('PUBLIC_PATH')  or define('PUBLIC_PATH', ROOT_PATH.'/public');
/* 定义用户目录 */
defined('USR_PATH')     or define('USR_PATH', ROOT_PATH.'/usr');
/* 定义系统目录 */
defined('VAR_PATH')     or define('VAR_PATH', ROOT_PATH.'/var');
/* 定义系统目录 */
defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH.'/runtime');
/* 定义 Vendor 目录 */
defined('VENDOR_PATH')  or define('VENDOR_PATH', ROOT_PATH.'/vendor');
/* 定义 Yii 目录 */
defined('YII_PATH')     or define('YII_PATH', VENDOR_PATH.'/yii/framework');

abstract class Dexter
{
    private static $_debug;
    private static $_app;
    private static $_cache;
    private static $_config;

    /**
     * 启动
     *
     * @static
     * @param string $type 应用类型
     * @access public
     * @return Dexter
     */
    public static function bootstrap($type='web')
    {
        self::$_debug = defined('YII_DEBUG') && YII_DEBUG;

        // 载入 Yii Framewrok
        $yii = YII_PATH.DS.'yiilite.php';
        if (self::$_debug)
            $yii = YII_PATH.DS.'yii.php';
        require($yii);

        Yii::trace('Dexterous Initialization');

        // 注册核心组件
        self::registerCoreComponents();
        // 创建应用
        if ($type === 'web') {
            // 读取配置
            self::configration();
            self::$_app = Yii::createApplication('DexWebApplication', self::$_config);
            Yii::app()->setComponent('cache', self::$_cache);
            unset(self::$_cache);
            Yii::trace('Dexterous is runing');
        } else {
            $config = include USR_PATH . '/config/database.php';
            self::$_app = Yii::createConsoleApplication(CMap::mergeArray(array(
                'basePath' => VAR_PATH,
                'runtimePath' => RUNTIME_PATH),
            $config));
            unset($config);
            Yii::trace('Dexterous console is runing');
        }
        Yii::trace('Run as '.(self::$_debug ? 'debug mode' : 'deploy mode'));

        return self::$_app;
    }

    /**
     * 配置
     *
     * @static
     * @access public
     * @return void
     */
    public static function configration()
    {
        // 创建缓存组件
        $cacheConfig = include USR_PATH.'/config/cache.php';
        self::$_cache = Yii::createComponent($cacheConfig['components']['cache']);

        // 设置过期时间
        if (self::$_debug) {
            $expire = 10;
            $mode = 'debug';
        } else {
            $expire = 86400;
            $mode = 'deploy';
        }

        // 模块配置
        $cacheId = 'modules';
        if (!($modules = self::$_cache->get($cacheId))) {
            $modules = array();
            $dirs = new DirectoryIterator(USR_PATH.'/modules');
            foreach($dirs as $dir) {
                if($dir->isDir() && !$dir->isDot() && $dir->__toString !== 'gii')
                    $modules[] = $dir->__toString();
            }
            unset($dirs);
            self::$_cache->set($cacheId, $modules, $expire);
        }

        if (!empty($modules)) {
            foreach ($modules as $module)
                Yii::trace("Load module {$module}");
        }

        // 系统配置
        $cacheId = 'config.'.$mode;
        if (!($configs = self::$_cache->get($cacheId))) {
            $files = array(
                USR_PATH.'/config/environment',
                USR_PATH.'/config/database',
                USR_PATH.'/config/routes',
                USR_PATH.'/config/params'
            );

            if (self::$_debug)
                $files[] = USR_PATH.'/config/develop';
            else
                $files[] = USR_PATH.'/config/deploy';

            $configs = $cacheConfig;
            foreach ($files as $file) {
                $filename = str_replace('/', DS, $file);
                if (!is_file($filename.'.php'))
                    continue;
                else {
                    if (is_file($filename.'-local.php')) {
                        if (php_sapi_name() != 'cli' && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1')
                            continue;
                        $filename = $filename.'-local';
                    }
                }
                $config = include $filename.'.php';
                $configs = CMap::mergeArray($configs, $config);
                unset($config);
            }
            unset($files);
            Yii::trace('Rebuild config cache');
            self::$_cache->set($cacheId, $configs, $expire);
        }

        self::$_config = CMap::mergeArray($configs, array('modules' => $modules));
        Yii::trace('Load configration');
    }

    /**
     * 注册 Dexterous 核心组件
     *
     * @static
     * @access private
     * @return void
     */
    private static function registerCoreComponents()
    {
        Yii::$classMap = array_map(function ($path) {
            return realpath(VAR_PATH.DS.$path);
        }, self::$_coreComponents);
    }

    /**
     * @var array Dexterous 核心组件
     */
    private static $_coreComponents = array(
        'DexWebApplication'       => 'components/DexWebApplication.php',
        'DexController'           => 'components/DexController.php',
        'DexEvent'                => 'components/DexEvent.php',
        'DexModule'               => 'components/DexModule.php',
        'DexPlugin'               => 'components/DexPlugin.php',
        'DexPluginManager'        => 'components/DexPluginManager.php',
        'DexSite'                 => 'components/DexSite.php',
        'DexWebUser'              => 'components/DexWebUser.php',
        'DexWidget'               => 'components/DexWidget.php',
        'DexAssetsBehavior'       => 'behaviors/DexAssetsBehavior.php',
        'DexAttributeBehavior'    => 'behaviors/DexAttributeBehavior.php',
    );
}

include VAR_PATH.'/utils/functions.php';
