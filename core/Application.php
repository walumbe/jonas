<?php
namespace  app\core;

use app\models\User;

/**
 * @package app\core
 */

Class Application
{
    public static string $ROOT_DIR;

    public string $userClass;
    public Router $router;
    public Request  $request;
    public Response $response;
    public Session $session;
    public Database $database;
    public ?DBModel $user;
    public Controller $controller;
    public static Application $app;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->database = new Database($config['database']);

        $primaryValue = $this->session->get('user');
        if($primaryValue)
        {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else {
            $this->user = null;
        }

    }

    public function run()
    {
        echo $this->router->resolve();
    }

    /**
     * @return \app\core\Controller
    */

    public function getController(): \app\core\Controller
    {
        return  $this->controller;
    }

    /**
     * @param \app\core\Controller $controller
    */

    public function setController(\app\core\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(DBModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');

    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
}