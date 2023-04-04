<?php

namespace Technodrive\Core\Service;

use Technodrive\Core\Configurator;
use Technodrive\Core\Exception\BadFactoryException;
use Technodrive\Core\Factory\ModuleFactory;
use Technodrive\Core\Interface\ContainerInterface;
use Technodrive\Core\Interface\FactoryInterface;
use Technodrive\Core\Interface\ServiceFactoryInterface;
use Technodrive\Module\Module;

/**
 *
 */
class ServiceManager implements ContainerInterface
{

    /**
     * @var Configurator
     */
    protected Configurator $configurator;

    /**
     * Already loaded services
     * @var array
     */
    protected array $services = [];

    /**
     * @param Configurator $configurator
     */
    public function __construct(Configurator $configurator)
    {
        $this->configurator = $configurator;
    }

    /**
     * @param string $className
     * @return mixed
     * @throws BadFactoryException
     */
    public function get(string $className)
    {
        if(isset($this->services[$className])){
            return $this->services[$className];
        }

        $serviceFactory = $this->getFactory($className);

        $this->services[$className] = $serviceFactory($this);
        return $this->services[$className];
    }

    /**
     * @param object $object
     * @return void
     */
    public function add(object $object): void
    {
        $this->services[$object::class] = $object;
    }

    /**
     * @param $className
     * @return FactoryInterface
     * @throws BadFactoryException
     */
    protected function getFactory(string $className): FactoryInterface
    {
        $factories = $this->configurator->getConfig('factories');

        if(! isset($factories[$className])) {
            throw new BadFactoryException(sprintf('Factory not found for className : %1$s', $className));
        }

        return new $factories[$className];
    }

    /**
     * @return \ArrayObject
     */
    public function getConfig(): \ArrayObject
    {
        return $this->configurator->getConfigs();
    }

    /**
     * @return Configurator
     */
    public function getConfigurator()
    {
        return $this->configurator;
    }
}