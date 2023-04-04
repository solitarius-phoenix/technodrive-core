<?php
namespace Technodrive\Core\Config;

use Technodrive\Core\Factory\ApplicationFactory;
use Technodrive\Core\Factory\ModuleFactory;
use Technodrive\Core\Factory\RequestFactory;
use Technodrive\Core\Request;
use Technodrive\Module\Module;
use \Technodrive\Module\Listener\LoadModulesListener;
use \Technodrive\Module\Factory\LoadModulesListenerFactory;
use \Technodrive\Core\Application;
use Technodrive\Router\Listener\Factory\RouterListenerFactory;
use Technodrive\Router\Factory\RouterFactory;
use Technodrive\Router\Listener\RouterListener;
use Technodrive\Router\Router;

return [
    'factories'=>[
        Application::class=>ApplicationFactory::class,
        Module::class=>ModuleFactory::class,
        Request::class=>RequestFactory::class,
        Router::class=>RouterFactory::class,
    ],
    'listeners'=>[
        'listen'=>[
            'load'=>[
                LoadModulesListener::class,
            ],
            'route'=>[
                RouterListener::class,
            ],
        ],
        'factories'=>[
            LoadModulesListener::class=>LoadModulesListenerFactory::class,
            RouterListener::class=>RouterListenerFactory::class,
        ],
    ],
];