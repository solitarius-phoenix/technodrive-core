<?php

namespace Technodrive\Core\Factory;

use Technodrive\Core\Application;
use Technodrive\Core\Interface\ContainerInterface;
use Technodrive\Core\Interface\FactoryInterface;
use Technodrive\Core\Service\ServiceManager;
use Technodrive\Process\ProcessManager;

/**
 *
 */
class ApplicationFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return Application
     */
    public function __invoke(ContainerInterface $container)
    {
        $stepManager = $container->get(ProcessManager::class);
        return new Application($container, $stepManager);
    }
}