<?php


namespace App\Models;


use App\Db;
use App\Model;
use App\View;

class Comments extends Model
{
    use View;

    const TABLE = 'comments';
    public $name;
    public $email;
    public $comment;
    public $article_id;

    public function create($array)
    {
        $this->fill($array);
        $this->save();
        return true;
    }
    
    protected function fill($array)
    {
        $this->name = $array['name'];
        $this->email = $array['email'];
        $this->comment = $array['comment'];
        $this->article_id = $array['article_id'];
    }

    public static function findByArticleId($id)
    {
        $db = Db::instance();
        return $db->query('SELECT * FROM ' . static::TABLE . " WHERE article_id = ? AND public = 1", array($id), static::class);
    }
        
}