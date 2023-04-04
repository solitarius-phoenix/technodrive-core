<?php

namespace Technodrive\Core\Trait;

trait HydratorTrait
{

    public function hydrate(array $data): void
    {
        foreach($data as $key=>$value)
        {
            $method = 'set' . ucfirst(strtolower($key));
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

}