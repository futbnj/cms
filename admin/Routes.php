<?php

/**
 * List of Routes for Admin Panel
 */

$this->router->add('login', '/admin/login/', 'LoginController:form');
$this->router->add('dashboard', '/admin/', 'DashboardController:index');
//$this->router->add('news', '/news', 'HomeController:news');
//$this->router->add('news_single', '/news/(id:int)', 'HomeController:news');
