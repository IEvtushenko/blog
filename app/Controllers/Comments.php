<?php


namespace App\Controllers;


use App\Controllers;

class Comments
{
    use Controllers;

    public function actionCreate()
    {
        if ((!empty($_POST))) {
            $data = $_POST;
            $data['comment'] = htmlspecialchars(trim($data['comment'], ''));
            $comment = new \App\Models\Comments();
            $res = $comment->create($data);
            if ($res) {
                $this->getAjax();
            }
        }
    }

    private function getAjax()
    {
        echo '<meta http-equiv="refresh" content="0; url=urlName.com">';
    }

}