<?php

namespace Engine\Core\Template;

use Admin\Model\Setting\SettingRepository;
use Engine\DI\DI;

class View
{
    /**
     * @var
     */
    public $di;

    /**
     * @var \Engine\Core\Template\Theme
     */
    protected $theme;

    /**
     * @var Setting
     */
    protected $setting;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * View constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->theme = new Theme();
        $this->setting = new Setting($di);
        $this->menu = new Menu($di);
    }

    /**
     * @param $template
     * @param array $vars
     */
    public function render($template, $vars = [])
    {
        $functions = \Theme::getThemePath() . '/functions.php';

        if (file_exists($functions)) {
            include_once $functions;
        }

        $templatePath = $this->getTemplatePath($template, ENV);

        if (!is_file($templatePath))
        {
            throw new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s"', $template, $templatePath)
            );
        }

        $this->theme->setData($vars);
        extract($vars);

        ob_start();
        ob_implicit_flush(0);

        try{
            require $templatePath;
        }catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }

        echo ob_get_clean();
    }

    /**
     * @param $template
     * @param null $env
     * @return string
     */
    private function getTemplatePath($template, $env = null)
    {

        if ($env === 'Cms')
        {
            $theme =  \Setting::get('active_theme');
            return ROOT_DIR . '/content/themes/' . $theme . '/' . $template . '.php';
        }

        return path('view') . '/' . $template . '.php';
    }

//    private function getThemePath()
//    {
//        return ROOT_DIR . '/content/themes/default';
//    }

}