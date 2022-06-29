<?php

namespace app\core;

class View
{
    public string $title = '';

    public function renderView($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function renderContent($viewContent)
    {
        return Application::$app->view->renderContent($viewContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout;
        /**
         * @var Controller $controller
         */
        if($controller)
        {
            $layout = Application::$app->layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
    protected function renderOnlyView($view, $params)
    {
//        var_dump($params);
        foreach ($params as $key => $value)
        {
//            if this evaluates as name
            $$key = $value;
        }
//        var_dump($name);
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

}