<?php

namespace Engine;

use Engine\Core\Database\Connection;
use Engine\Core\Router\Router;
//use Engine\Core\Customize\Customize;
use Engine\DI\DI;

abstract class Plugin
{
    protected $di;
    protected $db;
    protected $router;
//    protected $customize;

    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->router = $this->di->get('router');
        $this->customize = $this->di->get('customize');
    }

    abstract public function details();

    /**
     * @return mixed
     */
    public function getDi()
    {
        return $this->di;
    }

    /**
     * @return bool|null
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @return bool|null
     */
    public function getRouter()
    {
        return $this->router;
    }
}