<?php

namespace Technodrive\Core\Interface;

/**
 *
 */
interface FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @return mixed
     */
    public function __invoke(ContainerInterface $container);

}