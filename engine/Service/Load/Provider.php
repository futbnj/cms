<?php

namespace Engine\Service\Load;

use Engine\Service\AbstractProvider;
use Engine\Load;

class Provider extends AbstractProvider
{
    /**
     * @var string
     */
    public $serviceName = 'load';


    /**
     * @return mixed|void
     */
    public function init()
    {
        $load = new Load();

        $this->di->set($this->serviceName, $load);
    }
}