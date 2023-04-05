<?php

namespace Technodrive\Core;

use Technodrive\Core\Service\ServiceManager;
use Technodrive\Module\Module;
use Technodrive\Process\Enumeration\StepEnum;
use Technodrive\Process\Interface\StepInterface;
use Technodrive\Process\ProcessManager;
use Technodrive\Process\Process;
use Technodrive\Router\Router;

/**
 *
 */
class Application
{
    /**
     * @var ServiceManager
     */
    protected ServiceManager $serviceManager;
    /**
     * @var ProcessManager
     */
    protected ProcessManager $processManager;
    /**
     * @var Process
     */
    protected Process $process;
    /**
     * @var StepInterface
     */
    protected StepInterface $step;

    /**
     * @param $config
     * @return void
     * @throws Exception\BadFactoryException
     */
    public static function init($config)
    {
        //we need to have a boot module
        $configurator = new Configurator($config);
        $serviceManager = new ServiceManager($configurator);
        $serviceManager->add($configurator);
        $module = $serviceManager->get(Module::class);
        $module->loadModules();
        $serviceManager
            ->get(Application::class)
            ->bootstrap()
            ->run()
        ;
    }

    /**
     * @param ServiceManager $serviceManager
     * @param ProcessManager $processManager
     */
    public function __construct(ServiceManager $serviceManager, ProcessManager $processManager)
    {
        $this->setServiceManager($serviceManager);
        $this->setProcessManager($processManager);
    }

    /**
     * @return $this
     * @throws Exception\BadFactoryException
     */
    public function bootstrap(): self
    {
        $this->process = $process = $this->processManager->getProcess();
        $process
            ->setCurrentStep(StepEnum::bootstrap)
            ->setRequest($this->serviceManager->get(Request::class))
            ->setResponse($this->serviceManager->get(Response::class))
            //->setRouter($this->serviceManager->get(Router::class))
        ;
        $this->processManager->triggerStep($process);
        return $this;
    }

    /**
     * @return void
     */
    public function run()
    {
        //routing
        $this->process
            ->setCurrentStep(StepEnum::route)
        ;
        $this->processManager->triggerStep($this->process);
        //dispatching
        $this->process
            ->setCurrentStep(StepEnum::dispatch)
        ;
        $this->processManager->triggerStep($this->process);
        //view rendering
        $this->process
            ->setCurrentStep(StepEnum::view_render);
        ;
        $this->processManager->triggerStep($this->process);

        $this->process
            ->setCurrentStep(StepEnum::layout_render);
        ;
        $this->processManager->triggerStep($this->process);

        echo $this->process->getResponse()->getBody();
    }

    /**
     * @return ServiceManager
     */
    public function getServiceManager(): ServiceManager
    {
        return $this->serviceManager;
    }

    /**
     * @param ServiceManager $serviceManager
     * @return Application
     */
    public function setServiceManager(ServiceManager $serviceManager): Application
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * @return ProcessManager
     */
    public function getProcessManager(): ProcessManager
    {
        return $this->processManager;
    }

    /**
     * @param ProcessManager $processManager
     * @return Application
     */
    public function setProcessManager(ProcessManager $processManager): Application
    {
        $this->processManager = $processManager;
        return $this;
    }

}