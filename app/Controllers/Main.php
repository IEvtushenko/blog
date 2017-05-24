<?php


namespace App\Controllers;


use App\Controllers;

class Main
{
    use Controllers;

    public function actionAbout()
    {
        $template = $this->twig->loadTemplate("/blog/about.php");
        echo $template->render([]);
    }
}
