<?php
error_reporting(E_ALL);

require __DIR__ . "/autoload.php";
require __DIR__ . "/vendor/autoload.php";
//require_once __DIR__ . '/vendor/twig/lib/Twig/Autoloader.php';

spl_autoload_register('standartAutoload');

define('ROOT', dirname(__FILE__));

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

Twig_Autoloader::register();



//$loader = new \Twig_Loader_Filesystem( ROOT . '/views');
//$twig = new Twig_Environment($loader);

\PHP_Timer::start();
$log = new Logger('exceptions');

$log->pushHandler(new StreamHandler(__DIR__ . '/logs/error', Logger::ERROR));

try {
    $route = new \App\Router();
    $route->run();
} catch (\App\Exceptions\Db $e) {
    $log->error('Fatal Error', ['exception' => $e]);
    require ROOT . '/views/error/404.php';
    die;
} catch (Exception $e) {
        $log->error('Fatal Error', ['exception' => $e]);
    require ROOT . '/views/error/404.php';
    die;
}
