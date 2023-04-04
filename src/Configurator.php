<?php

namespace Technodrive\Core;

/**
 *
 */
class Configurator
{
    /**
     * @var array
     */
    protected array $configs;

    /**
     *
     */
    protected const mainKeys = [
        'factories',
        'aliases',
        'routes',
    ];

    /**
     * @param \ArrayObject|array $globalConfig
     */
    public function __construct(\ArrayObject|array $globalConfig)
    {
        //@todo cache configuration
        $coreConfig = include_once __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'core.config.php';
        if(! is_array($globalConfig)){
            $globalConfig = $globalConfig->getArrayCopy();
        }
        $configs = array_replace_recursive($coreConfig, $globalConfig);
        $this->initConfig($configs);
    }

    /**
     * @param array $configs
     * @return void
     */
    protected function initConfig(array $configs): void
    {
        $this->configs = [];
        $this->addConfig($configs);
    }

    /**
     * @param array $config
     * @return void
     */
    public function addConfig(array $config)
    {
        $array = $this->updateConfig($config);
        $this->configs = array_replace_recursive($this->configs, $array);
    }

    /**
     * @param array $configs
     * @return array
     */
    protected function updateConfig(array $configs): array
    {
        $array = [];
        foreach ($configs as $key=>$config){
            if(in_array($key, self::mainKeys)) {
                if(isset($this->configs[$key])) {
                    $this->configs[$key] = array_replace_recursive($this->configs[$key], $this->updateConfig($config));
                }else{
                    $this->configs[$key] = $this->updateConfig($config);
                }
                continue;
            }
             if(is_array($config)){
                 $array[$key] = $this->updateConfig($config);
             }else{
                 $array[$key] = $config;
             }
        }
        return $array;
    }

    /**
     * @return \ArrayObject
     */
    public function getConfigs(): \ArrayObject
    {
        return new \ArrayObject($this->configs);
    }

    /**
     * @param string $key
     * @return \ArrayObject
     * @throws \Exception
     */
    public function getConfig(string $key): \ArrayObject
    {
        if(! isset($this->configs[$key])) {
            throw new \Exception(sprintf('Key %1$s not found in getConfig in file %2$s on line %3$d', $key, __FILE__, __LINE__));
        }
        if(is_array($this->configs[$key])){
            return new \ArrayObject($this->configs[$key]);
        }
        return($this->configs[$key]);
    }


}