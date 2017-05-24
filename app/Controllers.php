<?php


namespace App;


use App\Exceptions\Core;

trait Controllers
{
    use View;
    protected $view;
    protected $twig;
    
    public function __construct()
    {
        $this->view = new \App\Models\News();
        $loader = new \Twig_Loader_Filesystem( ROOT . '/views');
        $this->twig = new \Twig_Environment($loader);

    }

    public function action($action)
    {
        $methodName = 'action' . $action;

        return $this->$methodName();
    }

}