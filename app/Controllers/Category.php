<?php


namespace App\Controllers;


use App\Controllers;
use App\Models\News;
use App\Pagination;

class Category
{
    use Controllers;

    protected function actionIndex()
    {
        $page = 1;
        $limit = \App\Models\News::SHOW_DEFAULT;

        if (!empty($_GET['page'])) {
            $page = intval($_GET['page']);
        }

        $id = $_GET['id'] ?? 1;//todo-vanya Можно добавить сюда исключение

        $this->view->categories = \App\Models\Category::findAll();
//        $this->view->lastNews = \App\Models\News::getEachNews();//Генератор
        $this->view->News = \App\Models\News::allNewsByCategory($id, $page, $limit);//Генератор по страничный
        $this->view->lastNews = \App\Models\News::getLastNews();
        $total = \App\Models\Category::totalNewsByCategoryId($id)[0]->count;




        $time = \PHP_Timer::stop();
        $this->view->memory = \PHP_Timer::resourceUsage();
        $this->view->time =  \PHP_Timer::secondsToTimeString($time);


        $pagination = new Pagination($total, $page, $limit, 'category');
        $paginationGet = $pagination->get();

        $template = $this->twig->loadTemplate('/blog/index.php');
        echo $template->render([
            'pagination' =>$paginationGet,
            'lastNews'=>$this->view->lastNews,
            'News'=>$this->view->News,
            'categories' => $this->view->categories ,
            'time' => $this->view->time,
            'memory' => $this->view->memory]);
    }
}