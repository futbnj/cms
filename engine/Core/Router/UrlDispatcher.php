<?php


namespace Engine\Core\Router;


class UrlDispatcher
{
    /**
     * @var string[]
     */
    private $method = [
        'GET',
        'POST'
    ];

    /**
     * @var array[]
     */
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * @var string[]
     */
    private $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    /**
     * @param $key
     * @param $pattern
     */
    public function addPattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * @param $method
     * @return array
     */
    private function routes($method)
    {
        return $this->routes[$method] ?? [];
    }

    /**
     * @param $method
     * @param $pattern
     * @param $controller
     */
    public function register($method, $pattern, $controller)
    {
        $convert = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    /**
     * @param $pattern
     * @return array|mixed|string|string[]|null
     */
    private function convertPattern($pattern)
    {
        if(strpos($pattern, '(') === false)
        {
            return $pattern;
        }
        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $pattern);
    }

    /**
     * @param $matches
     * @return string
     */
    private function replacePattern($matches)
    {
        return'(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }

    /**
     * @param $parameters
     * @return mixed
     */
    private function processParam($parameters)
    {
        foreach ($parameters as $key => $value)
        {
            if (is_int($key))
            {
                unset($parameters[$key]);
            }
        }

        return $parameters;
    }

    /**
     * @param $method
     * @param $url
     * @return DispatchedRoute
     */
    public function dispatch($method, $url)
    {
        $routes = (array)$this->routes(strtoupper($method));
        $parameters = [];

        if(array_key_exists($url, $routes))
        {
            return new DispatchedRoute($routes[$url]);
        }

        return $this->doDispatch($method, $url);
    }

    /**
     * @param $method
     * @param $url
     * @return DispatchedRoute
     */
    private function doDispatch($method, $url)
    {
        foreach ((array)$this->routes($method) as $route => $controller)
        {
            $pattern = '#^' . $route . '$#s';

            if (preg_match($pattern, $url, $parameters))
            {
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }
    }

}