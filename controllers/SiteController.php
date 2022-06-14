<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * @author  Jonathan Walumbe
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'name' => "Walumbe"
        ];
        return $this->render('home', $params);
//        return Application::$app->router->renderView('home', $params);
    }
    public function contact()
    {
        return $this->render('contact');
//        return Application::$app->router->renderView('contact');
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return $body;
    }
}