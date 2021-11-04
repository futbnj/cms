<?php

namespace Engine;

use Engine\Core\Router\DispatchedRoute;
use Engine\Helper\Common;


class Cms
{
    /**
     * @var DI
     */
    private $di;

    public $router;

    /**
     * cms constructor.
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    public function run()
    {
        try{
            require_once __DIR__ . '/../' . mb_strtolower(ENV) . '/Routes.php';

            $obj = new Common;

            $routerDispatch = $this->router->dispatch($obj->getMethod(), $obj->getPathUrl());

            if ($routerDispatch == null){
                $routerDispatch = new DispatchedRoute('ErrorController:page404');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\\' . ENV .'\\Controller\\' . $class;

            $parameters = $routerDispatch->getParameters();
            call_user_func_array([new $controller($this->di), $action], $parameters);

        }catch(\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}