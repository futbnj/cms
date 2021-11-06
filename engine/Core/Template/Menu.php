<?php


namespace Engine\Core\Template;

use Engine\DI\DI;
use Cms\Model\MenuItem\MenuItemRepository;

class Menu
{
    /**
     * @var DI
     */
    protected static $di;

    /**
     * @var MenuItemRepository
     */
    protected static $menuItemRepository;

    public function __construct($di)
    {
        self::$di = $di;
        self::$menuItemRepository = new MenuItemRepository(self::$di);
    }

    public static function show()
    {

    }

    public static function getItems()
    {
        return self::$menuItemRepository->getAllItems();
    }
}