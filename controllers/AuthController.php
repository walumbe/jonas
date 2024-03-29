<?php

namespace app\controllers;

use walumbe\phpmvc\Application;
use walumbe\phpmvc\Controller;
use walumbe\phpmvc\middlewares\AuthMiddleware;
use walumbe\phpmvc\Request;
use walumbe\phpmvc\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
//        restrict access between the request and the controller
        $this->registerMiddleWare(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if($request->isPost())
        {
            $loginForm->loadData($request->getBody());
            if($loginForm->validate() && $loginForm->login())
            {
                $response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        if($request->isPost())
        {
            $user->loadData($request->getBody());

            if($user->validate() && $user->save())
            {
                Application::$app->session->setFlash('success', 'Welcome to jonas Framework!');
                Application::$app->response->redirect('/');
//                header('Location: /');
            }
//            echo '<pre>';
//            var_dump($user->errors);
//            echo '</pre>';
//            exit();
            return $this->render('register',[
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register',[
            'model' => $user
        ]);
    }

    public function logout(Request  $request,Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile()
    {

       return $this->render('profile');
    }

}