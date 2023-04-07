<?php

namespace Technodrive\Core\Config;

use Technodrive\Core\Factory\ApplicationFactory;
use Technodrive\Core\Factory\ModuleFactory;
use Technodrive\Core\Factory\RequestFactory;
use Technodrive\Core\Factory\ResponseFactory;
use Technodrive\Core\Request;
use Technodrive\Core\Response;
use Technodrive\Dispatcher\Dispatcher;
use Technodrive\Dispatcher\Listener\DispatcherListener;
use Technodrive\Dispatcher\Factory\DispatcherFactory;
use Technodrive\Dispatcher\Listener\Factory\DispatcherListenerFactory;
use Technodrive\Module\Module;
use \Technodrive\Module\Listener\LoadModulesListener;
use \Technodrive\Module\Factory\LoadModulesListenerFactory;
use \Technodrive\Core\Application;
use Technodrive\Mvc\Factory\LayoutRendererFactory;
use Technodrive\Mvc\Factory\ViewRendererFactory;
use Technodrive\Mvc\LayoutRenderer;
use Technodrive\Mvc\Listener\Factory\LayoutRendererListenerFactory;
use Technodrive\Mvc\Listener\Factory\ViewRendererListenerFactory;
use Technodrive\Mvc\Listener\LayoutRendererListener;
use Technodrive\Mvc\Listener\ViewRendererListener;
use Technodrive\Mvc\View_helpers\Factory\HeadTitleHelperFactory;
use Technodrive\Mvc\View_helpers\Factory\TestHelperFactory;
use Technodrive\Mvc\View_helpers\HeadtitleHelper;
use Technodrive\Mvc\View_helpers\TestHelper;
use Technodrive\Mvc\ViewRenderer;
use Technodrive\Router\Listener\Factory\RouterListenerFactory;
use Technodrive\Router\Factory\RouterFactory;
use Technodrive\Router\Listener\RouterListener;
use Technodrive\Router\Router;
use Technodrive\Process\Enumeration\StepEnum;

return [
    'factories' => [
        Application::class => ApplicationFactory::class,
        Module::class => ModuleFactory::class,
        Request::class => RequestFactory::class,
        Response::class => ResponseFactory::class,
        Router::class => RouterFactory::class,
        Dispatcher::class => DispatcherFactory::class,
        ViewRenderer::class => ViewRendererFactory::class,
        LayoutRenderer::class => LayoutRendererFactory::class,
    ],
    'listeners' => [
        'listen' => [
            StepEnum::load->name => [
                LoadModulesListener::class,
            ],
            StepEnum::route->name => [
                RouterListener::class,
            ],
            StepEnum::dispatch->name => [
                DispatcherListener::class,
            ],
            StepEnum::view_render->name => [
                ViewRendererListener::class,
            ],
            StepEnum::layout_render->name => [
                LayoutRendererListener::class,
            ],
        ],
        'factories' => [
            LoadModulesListener::class => LoadModulesListenerFactory::class,
            RouterListener::class => RouterListenerFactory::class,
            DispatcherListener::class => DispatcherListenerFactory::class,
            ViewRendererListener::class => ViewRendererListenerFactory::class,
            LayoutRendererListener::class => LayoutRendererListenerFactory::class,
        ],
    ],
    'views_helpers' => [
        'factories' => [
            'headTitle' => HeadTitleHelperFactory::class,
            'testHelper' => TestHelperFactory::class,
        ],
    ]
];