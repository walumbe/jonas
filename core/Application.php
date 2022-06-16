<?php
namespace  app\core;

/**
 * @package app\core
 */

Class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request  $request;
    public Response $response;
    public Session $session;
    public Database $database;
    public Controller $controller;
    public static Application $app;
    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        $this->database = new Database($config['database']);
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
}