<?php
use Nella\Console\Config\Extension as Extension2;
use Nella\Doctrine\Config\Extension;
use Nella\Doctrine\Config\MigrationsExtension;
use Nette\Application\Routers\Route;
use Nette\Config\Configurator;

define('LIBS_DIR', __DIR__ . '/../libs');
define('APP_DIR', __DIR__ . '/../app');
define('TMP_DIR', __DIR__ . '/../temp');

require __DIR__ . '/../libs/autoload.php';

Nette\Diagnostics\Debugger::enable(false);
Nette\Diagnostics\Debugger::$strictMode = true;

$configurator = new Configurator;

$configurator->setTempDirectory(TMP_DIR);
$configurator   ->createRobotLoader()
                ->addDirectory(APP_DIR)
                ->register();

/**
 * require helpers!
 */
require 'DummyUserStorage.php';

Extension2::register($configurator);
Extension::register($configurator);
MigrationsExtension::register($configurator);

$configurator->addConfig(APP_DIR.'/config/config.neon');
$container = $configurator->createContainer();

$container->router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);
$container->router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');


$container->removeService('nette.userStorage');
$container->addService('nette.userStorage', new DummyUserStorage());

$GLOBALS['container'] = $configurator->createContainer();