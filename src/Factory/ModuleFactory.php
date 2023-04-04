<?php

namespace Technodrive\Core\Factory;

use Technodrive\Core\Interface\ContainerInterface;
use Technodrive\Core\Interface\FactoryInterface;
use Technodrive\Module\Module;

/**
 *
 */
class ModuleFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @return Module
     */
    public function __invoke(ContainerInterface $container): Module
    {
        return new Module($container);
    }

}