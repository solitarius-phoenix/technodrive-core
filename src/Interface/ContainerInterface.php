<?php

namespace Technodrive\Core\Interface;

/**
 *
 */
interface ContainerInterface
{
    /**
     * @param string $className
     * @return mixed
     */
    public function get(string $className);
}