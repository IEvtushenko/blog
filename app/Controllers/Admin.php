<?php


namespace App\Controllers;

use App\Controllers;
use App\Models\Category;
use App\Models\News;
use App\MultiException;

class Admin
{
    use Controllers;

    public function __construct()
    {
        $this->view = new \App\Models\News();
        $loader = new \Twig_Loader_Filesystem( ROOT . '/views');
        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * Панель администратора
     * @throws \Twig_Error_Runtime
     */
    protected function actionIndex()
    {
        $this->view->allNews = \App\Models\News::allNews();
        for ($i = 0; $i < count($this->view->allNews); $i++) {
            $this->view->allNews[$i]->status = \App\Models\News::getStatus($this->view->allNews[$i]->status);
        }
        $template = $this->twig->loadTemplate('/admin/index.php');

        $time = \PHP_Timer::stop();
        $this->view->time =  \PHP_Timer::secondsToTimeString($time);
        $this->view->memory = \PHP_Timer::resourceUsage();

        echo $template->render(['allNews'=>$this->view->allNews , 'time' => $this->view->time, 'memory' => $this->view->memory]);

    }

    /**
     * Метод сохраняет или редактирует запись
     * @throws \Twig_Error_Runtime
     * @throws array
     */
    protected function actionSave()
    {
        //Переменная для определения шаблона
        $target = "save";
        if (isset($_GET['id'])) {
            $this->view->id = $_GET['id'];
            $this->view->article = \App\Models\News::findById($_GET['id'])[0];
            $target = 'update';
        } else {
            $target = 'save';
        }
        try {

            if (isset($_POST['submit'])) {

                $this->view->fill($_POST, $_FILES);
                $this->view->save();

                $this->view->saveImg($_FILES['userfile']['tmp_name']);

            }

        } catch (MultiException $e) {
            $this->view->errors = $e;

        }
        $this->view->categories = Category::findAll();

        $time = \PHP_Timer::stop();
        $this->view->time =  \PHP_Timer::secondsToTimeString($time);
        $this->view->memory = \PHP_Timer::resourceUsage();

        $template = $this->twig->loadTemplate("/admin/$target.php");

        echo $template->render([
            'errors'=>$this->view->errors ,
            'article' => $this->view->article ?: "" ,
            'categories' => $this->view->categories,
            'time' => $this->view->time,
            'memory' => $this->view->memory]);

    }

    public function checkImage($array)
    {
        if (!getimagesize($array['userfile']['tmp_name'])) {
            throw new Exception('Изображение не корректного формата, попробуйте загрузить другой файл');
        }
        return;
    }
    
    public function actionDelete()
    {
        if (!empty($_GET['id'])) {
            $this->view->delete($_GET['id']);
            
        }
    }

}