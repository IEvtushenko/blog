<?php

namespace App\Controllers;

use App\Controllers;
use App\Models\Comments;
use App\MultiException;
use App\Pagination;


class News
{
    use Controllers;

    protected function actionIndex($message = '')
    {
        $page = $this->getPage();
        $this->getCategoriesAndLastNews();
        $this->view->News = \App\Models\News::getEachNewsPage($page, \App\Models\News::SHOW_DEFAULT);//Генератор по страничный

        $this->view->recommended = \App\Models\News::getRecommended();

        $total = \App\Models\News::getTotalNews()[0]->count;

        $time = \PHP_Timer::stop();
        $this->view->memory = \PHP_Timer::resourceUsage();
        $this->view->time = \PHP_Timer::secondsToTimeString($time);


        $pagination = new Pagination($total, $page, \App\Models\News::SHOW_DEFAULT);
        $paginationGet = $pagination->get();

        $template = $this->twig->loadTemplate('/blog/index.php');
        echo $template->render([
            'pagination' => $paginationGet,
            'recommended' => $this->view->recommended,
            'lastNews' => $this->view->lastNews,
            'News' => $this->view->News,
            'categories' => $this->view->categories,
            'time' => $this->view->time,
            'message' => $message,
            'memory' => $this->view->memory]);
    }

    /**
     * Action для вывода одной страницы
     * @throws \Twig_Error_Runtime
     */
    protected function actionArticle()
    {
        if (!isset($_GET['id'])) {
            header('location: /');
        }

        $id = (int)$_GET['id'];
        $this->view->article = \App\Models\News::findById($id)[0];
        $this->view->comments = \App\Models\Comments::findByArticleId($id);
//        var_dump($this->view->comments);
//        die;

        $categoryName = $this->view->article->category->name;

        $this->getCategoriesAndLastNews();

        $this->view->memory = \PHP_Timer::resourceUsage();
        $time = \PHP_Timer::stop();
        $this->view->time = \PHP_Timer::secondsToTimeString($time);


        $template = $this->twig->loadTemplate('/blog/article.php');
        echo $template->render([
            'categoryName' => $categoryName,
            'lastNews' => $this->view->lastNews,
            'article' => $this->view->article,
            'categories' => $this->view->categories,
            'time' => $this->view->time,
            'comments' => $this->view->comments,
            'memory' => $this->view->memory]);
    }

    protected function actionCreate()
    {
        try {
            $article = new \App\Models\News();
            $article->fill($_POST);
            $article->save();
        } catch (MultiException $e) {
            $this->view->errors = $e;
        }

        $this->view->display(__DIR__ . "/../templates/save.php");
    }

    protected function actionGenerate()
    {


        $this->view->categories = \App\Models\Category::findAll();
        $this->view->lastNews = \App\Models\News::getLastNews();

        $template = $this->twig->loadTemplate('/blog/index.php');


        $time = \PHP_Timer::stop();
        $this->view->memory = \PHP_Timer::resourceUsage();
        $this->view->time = \PHP_Timer::secondsToTimeString($time);

        echo $template->render([
            'lastNews' => $this->view->lastNews,
            'categories' => $this->view->categories,
            'time' => $this->view->time,
            'memory' => $this->view->memory]);
    }

    /**
     * Присваивает переменным нужные категории и последние новости
     * @return bool
     */
    protected function getCategoriesAndLastNews()
    {
        $this->view->categories = \App\Models\Category::findAll();

        $this->view->lastNews = \App\Models\News::getLastNews();

        return true;
    }

    protected function getPage()
    {
        $page = 1;
        if (!empty($_GET['page'])) {
            $page = intval($_GET['page']);
        }
        return $page;
    }

    protected function actionSearch()
    {
        if (!empty($_GET['s'])) {
            $search = htmlspecialchars(strip_tags(trim($_GET['s'], ' ')));
            $this->getCategoriesAndLastNews();
            $page = $this->getPage();
            $this->view->recommended = \App\Models\News::getRecommended();

            try {
                $this->view->searchedNews = \App\Models\News::search($search);
                $total = \App\Models\News::getTotalSearch($search)[0]->count;
            } catch (\App\Exceptions\Db $e) {
                $this->actionIndex('По вашему запросу ничего не найдено');
                die;
            }


            $pagination = new Pagination($total, $page, \App\Models\News::SHOW_DEFAULT);
            $paginationGet = $pagination->get();

            $template = $this->twig->loadTemplate('/blog/search.php');
            echo $template->render([
                'pagination' => $paginationGet,
                'recommended' => $this->view->recommended,
                'lastNews' => $this->view->lastNews,
                'News' => $this->view->searchedNews,
                'categories' => $this->view->categories,
                'time' => $this->view->time,
                'memory' => $this->view->memory]);
        }
    }

}