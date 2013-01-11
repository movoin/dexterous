<?php
/**
 * Shell
 *
 * @copyright  Copyright (c) 2006 - 2012 Movoin Studio. <http://www.movoin.com>
 * @license    GNU General Public License 2.0
 * @author     Allen <movoin@gmail.com>
 * @package    dexterous
 * @category   command
 * @version    $Id$
 * @since 1.0
 */

class ShellCommand extends CConsoleCommand
{
    /**
     * @return string the help information for the shell command
     */
    public function getHelp()
    {
        return <<<EOD
USAGE
  yiic shell

DESCRIPTION
  This command allows you to interact with a Web application
  on the command line. It also provides tools to automatically
  generate new controllers, views and data models.

  It is recommended that you execute this command under
  the directory that contains the entry script file of
  the Web application.

EOD;
    }

    /**
     * Execute the action.
     * @param array $args command line parameters specific for this command
     */
    public function run($args)
    {
        $entryScript = 'public/index.php';
        // fake the web server setting
        $cwd = getcwd();
        chdir(dirname($entryScript));
        $_SERVER['SCRIPT_NAME']='/'.basename($entryScript);
        $_SERVER['REQUEST_URI']=$_SERVER['SCRIPT_NAME'];
        $_SERVER['SCRIPT_FILENAME']=$entryScript;
        $_SERVER['HTTP_HOST']='localhost';
        $_SERVER['SERVER_NAME']='localhost';
        $_SERVER['SERVER_PORT']=80;

        // reset context to run the web application
        restore_error_handler();
        restore_exception_handler();
        Yii::setApplication(null);
        Yii::setPathOfAlias('application',null);

        Dexter::registerCoreComponents();
        $config = Dexter::getConsoleConfig();

        // oops, the entry script turns out to be a config file
        if(is_array($config))
        {
            chdir($cwd);
            $_SERVER['SCRIPT_NAME']='/index.php';
            $_SERVER['REQUEST_URI']=$_SERVER['SCRIPT_NAME'];
            $_SERVER['SCRIPT_FILENAME']=$cwd.DIRECTORY_SEPARATOR.'index.php';
            Yii::createWebApplication($config);
        }

        restore_error_handler();
        restore_exception_handler();

        $yiiVersion=Yii::getVersion();
        echo <<<EOD
Yii Interactive Tool v1.1 (based on Yii v{$yiiVersion})
Please type 'help' for help. Type 'exit' to quit.
EOD;
        $this->runShell();
    }

    protected function runShell()
    {
        // disable E_NOTICE so that the shell is more friendly
        error_reporting(E_ALL ^ E_NOTICE);

        $_runner_=new CConsoleCommandRunner;
        $_runner_->addCommands(dirname(__FILE__).'/shell');
        $_runner_->addCommands(Yii::getPathOfAlias('application.commands.shell'));
        if(($_path_=@getenv('YIIC_SHELL_COMMAND_PATH'))!==false)
            $_runner_->addCommands($_path_);
        $_commands_=$_runner_->commands;
        $log=Yii::app()->log;

        while(($_line_=$this->prompt("\n>>"))!==false)
        {
            $_line_=trim($_line_);
            if($_line_==='exit')
                return;
            try
            {
                $_args_=preg_split('/[\s,]+/',rtrim($_line_,';'),-1,PREG_SPLIT_NO_EMPTY);
                if(isset($_args_[0]) && isset($_commands_[$_args_[0]]))
                {
                    $_command_=$_runner_->createCommand($_args_[0]);
                    array_shift($_args_);
                    $_command_->init();
                    $_command_->run($_args_);
                }
                else
                    echo eval($_line_.';');
            }
            catch(Exception $e)
            {
                if($e instanceof ShellException)
                    echo $e->getMessage();
                else
                    echo $e;
            }
        }
    }
}

class ShellException extends CException
{
}
