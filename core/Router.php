<?php

namespace app\core;

use http\Params;

/**
 * @author JonathanWalumbe <nathanwalumbe@gmail.com>
 * @package app\core
 *
 */

class Router
{
    public Request $request;
    public Response $response;
    protected array  $routes =[];

    /**
     * Router constructor
     *
     * @param \app\coe\Request $request
     * @param \app\coe\Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
       $path = $this->request->getPath();
       $method = $this->request->getMethod();
       $callback = $this->routes[$method][$path] ?? false;
       if($callback === false)
       {
           $this->response->getStatusCode(404);
           return $this->renderView("_404");
       }
       if(is_string($callback))
       {
           return  $this->renderView($callback);
       }
       if(is_array($callback))
       {
           /**
            * @var \app\core\Controller $controller
            * */
           $controller = new $callback[0]();
           Application::$app->controller = $controller;
           Application::$app->controller->action = $callback[1];
//           $callback[0]  = new $callback[0]();
           foreach ($controller->getMiddlewares() as $middleware)
           {
                $middleware->execute();
           }
           $callback[0] = Application::$app->controller;
       }
//       var_dump($callback);
//       exit();

       return  call_user_func($callback, $this->request, $this->response);

    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout =Application::$app->layout;
        if(Application::$app->controller)
        {
            $layout = Application::$app->controller->layout;
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