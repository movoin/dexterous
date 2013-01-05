<?php
define('ROOT_PATH', dirname(__FILE__));
// fix for fcgi
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));
defined('YII_DEBUG') or define('YII_DEBUG', true);

require ROOT_PATH.'/var/Dexter.php';

$app = Dexter::bootstrap('console');
$app->commandRunner->addCommands(USR_PATH . '/commands');
$app->commandRunner->addCommands(VAR_PATH . '/commands');

$env = @getenv('YII_CONSOLE_COMMANDS');
if(!empty($env))
    $app->commandRunner->addCommands($env);
$app->run();

