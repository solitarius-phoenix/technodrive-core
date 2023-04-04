<?php

namespace Technodrive\Core\Factory;

use Technodrive\Core\Interface\ContainerInterface;
use Technodrive\Core\Interface\FactoryInterface;
use Technodrive\Core\Request;

/**
 *
 */
class RequestFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @return Request
     */
    public function __invoke(ContainerInterface $container)
    {
        return new Request();
    }
}