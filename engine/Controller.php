<?php


namespace Engine;

use Engine\Core\Request\Request;
use Engine\DI\DI;

abstract class Controller
{
    /**
     * @var \Engine\DI\DI
     */
    protected $di;

    protected $db;

    protected $view;

    protected $config;

    /**
     * @var Request
     */
    protected $request;

    protected $load;

    /**
     * @var \Engine\Core\Plugin\Plugin
     */
    protected $plugin;


    /**
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di       = $di;
        $this->db       = $this->di->get('db');
        $this->view     = $this->di->get('view');
        $this->config   = $this->di->get('config');
        $this->request  = $this->di->get('request');
        $this->load     = $this->di->get('load');

        $this->initVars();
    }

    /**
     * @param $key
     * @return bool|null
     */
    public function __get($key)
    {
        return $this->di->get($key);
    }

    /**
     * @return $this
     */
    public function initVars()
    {
        $vars = array_keys(get_object_vars($this));

        foreach ($vars as $var){
            if ($this->di->has($var)) {
                $this->{$var} = $this->di->get($var);
            }
        }

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Core\Plugin\Plugin
     */
    public function getPlugin()
    {
        return $this->plugin;
    }
}