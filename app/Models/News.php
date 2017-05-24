<?php

namespace App\Models;

use App\Db;
use App\Image;
use App\Model;
use App\MultiException;
use App\View;

class News extends Model
{
    use View;

    const TABLE = 'news';
    /**
     * количество записей на странице по умолчанию
     */
    const SHOW_DEFAULT = 3;

    public $title;
    public $short_title;
    public $short_content;
    public $content;
    public $category_id;
    public $status;
    public $is_recommended;
    public $author_id;

    /**
     * Возвращает последние 3 записи
     * @return array
     */
    public static function getLastNews()
    {
        $limit = 3;
        $db = Db::instance();
        $sql = "SELECT n.id as id, n.title as title, n.short_title as short_title,
		            n.content as content,
		            n.short_content as short_content,
                    n.date as date,
                    n.author_id as author_id,
                    a.name as author_name,
                    c.name as category_name,
                    n.category_id as category_id
                FROM `news` as n 
                INNER JOIN category as c on n.category_id = c.id
                INNER JOIN authors as a on n.author_id = a.id
                WHERE n.status = 1 ORDER BY n.id DESC LIMIT ?";

        return $db->query($sql, array($limit));
    }

    /**
     * Возвращает все записи
     * @return array
     */
    public static function allNews()
    {
        $db = Db::instance();
        $sql = "SELECT n.id as id, n.title as title, n.short_title as short_title,
		            n.content as content,
		            n.short_content as short_content,
                    n.date as date,
                    c.name as category_name,
                    n.author_id as author_id,
                    a.name as author_name,
                    n.status as status,
                    n.is_recommended as is_recommended,
                    n.category_id as category_id
                FROM `news` as n 
                INNER JOIN category as c on n.category_id = c.id
                INNER JOIN authors as a on n.author_id = a.id
                ORDER BY n.id DESC";

        return $db->query($sql);
    }

    /**
     * Возвращает все записи для нужной категории
     * @param $id
     * @param $page
     * @param $limit
     * @return array
     */
    public static function allNewsByCategory($id, $page, $limit)
    {
        $offset = ($page - 1) * $limit;

        $db = Db::instance();
        $sql = "SELECT n.id as id, n.title as title, n.short_title as short_title,
		            n.content as content,
		            n.short_content as short_content,
                    n.date as date,
                    c.name as category_name,
                    n.author_id as author_id,
                    a.name as author_name,
                    n.status as status,
                    n.is_recommended as is_recommended,
                    n.category_id as category_id
                FROM `news` as n 
                INNER JOIN category as c on n.category_id = c.id
                INNER JOIN authors as a on n.author_id = a.id
                WHERE n.category_id = ?
                ORDER BY n.id DESC LIMIT ? OFFSET ?";

        return $db->query($sql, array($id, $limit, $offset));
    }

    /**
     * Фильтр для определения статуса
     * @param $status
     * @return string
     */
    public static function getStatus($status)
    {
        if (1 == $status) {
            return "Опубликованно";
        }
        return "Не опубликованно";
    }


    public function __isset($property)
    {
        switch ($property) {
            case 'author':
                return !empty($this->author_id);
                break;
            default:
                return false;
                break;
        }
        return isset($this->data[$property]);
    }

    public function &__get($name)
    {
        if (is_scalar($name)) {
            if ('author' == $name) {
                return Author::findById($this->author_id)[0];
            }
            if ('category' == $name) {
                return Category::findById($this->category_id)[0];
            }
            return $this->data[$name];

        } else {
            $property = &$this->data[$name];
        }

        return $property;
    }

    /**
     * Метод заполняет объект данными перед сохранением или редактированием статьи
     * @param array $data
     * @param array $files
     * @throws MultiException
     * @throws array
     */
    public function fill($data = [], $files = [])
    {
        $e = new MultiException();

        if (empty($data['title'])) {
            $e[] = new \Exception('Отсутствует заголовок статьи');
        }
        if (empty($data['short_title'])) {
            $e[] = new \Exception('Отсутствует краткий заголовок статьи');
        }
        if (empty($data['short_content'])) {
            $e[] = new \Exception('Отсутствует краткое описание статьи');
        }
        if (empty($data['content'])) {
            $e[] = new \Exception('Отсутствует текст статьи');
        }

        //Если изображения с текущим id не существует, тогда проверить, чтобы файл обязательно был загружен и соответствовал формату,

        if  (!file_exists(ROOT . "/templates/img/small/" . $this->id . ".jpg"))
        {
            if (!empty($files['userfile']['tmp_name'])) {
                if (!getimagesize($files['userfile']['tmp_name'])) {
                    $e[] = new \Exception('Изображение не корректного формата, попробуйте загрузить другой файл');
                }
            }
            if (empty($files['userfile']['tmp_name'])) {
                $e[] = new \Exception('Файл не загружен');
            }
        }

        if (isset($e[0])) {

            throw $e;
        } else {
            $this->title = $data['title'];
            $this->short_title = $data['short_title'];
            $this->short_content = $data['short_content'];
            $this->content = $data['content'];
            $this->category_id = $data['category_id'];
            $this->status = $data['status'];
            $this->author_id = 1;
            $this->is_recommended = $data['is_recommended'];

        }
    }

    public static function getEachNews()
    {
        $db = Db::instance();
        $sql = "SELECT n.id as id, n.title as title,
                    n.short_title as short_title,
		            n.content as content,
		            n.short_content as short_content,
                    n.date as date,
                    n.author_id as author_id,
                    a.name as author_name,
                    c.name as category_name,
                    n.category_id as category_id
                FROM `news` as n 
                INNER JOIN category as c on n.category_id = c.id
                INNER JOIN authors as a on n.author_id = a.id
                WHERE n.status = 1 ORDER BY n.id DESC";

        return $db->queryEach($sql, array());
    }

    /**
     * Возвращает данные для новостной ленты, для передачи данных используется генератор
     * @param $page
     * @param $limit
     * @return \Generator
     */
    public static function getEachNewsPage($page, $limit)
    {
        $offset = ($page - 1) * $limit;
        $db = Db::instance();
        $sql = "SELECT n.id as id, 
                    n.title as title,
                    n.short_title as short_title,
		            n.content as content,
		            n.short_content as short_content,
                    n.date as date,
                    n.author_id as author_id,
                    a.name as author_name,
                    c.name as category_name,
                    n.category_id as category_id
                FROM `news` as n 
                INNER JOIN category as c on n.category_id = c.id
                INNER JOIN authors as a on n.author_id = a.id
                WHERE n.status = 1 ORDER BY n.id DESC LIMIT ? OFFSET ?";

        return $db->queryEach($sql, array($limit, $offset));
    }

    /**
     * Возвращает общее количество записей
     * @return array
     */
    public static function getTotalNews()
    {
        $db = Db::instance();
        $sql = "SELECT count(id) as count FROM news WHERE status = 1 ORDER BY id ";

        return $db->query($sql, array());
    }

    /**
     * Возвращает количество записей для категории
     * @param $id
     * @return array
     */
    public static function totalNewsByCategoryId($id)
    {
        $db = Db::instance();
        $sql = "SELECT count(id) as count FROM news WHERE status = 1 AND category_id = ? ORDER BY id ";

        return $db->query($sql, array($id));
    }
    /**
     * Сохраняет изображение для статей
     * @param $array Изображение
     */
    public function saveImg($image)
    {

        if (isset($this->id)) {
            $filenameB = ROOT . '/templates/img/big/' . $this->id . ".jpg";
            $filenameS = ROOT . '/templates/img/small/' . $this->id . ".jpg";
            $filenameR = ROOT . '/templates/img/recommended/' . $this->id . ".jpg";

            $new_image = new Image($image);

            $new_image->autoimageresize(500, 350);
            $new_image->imagesave($new_image->image_type, $filenameB);

            $new_image->autoimageresize(150, 80);
            $new_image->imagesave($new_image->image_type, $filenameR);

            $new_image->autoimageresize(60, 60);
            $new_image->imagesave($new_image->image_type, $filenameS);

            $new_image->imageout();



        } else {
            return;
        }
    }

    public static function getRecommended()
    {
        $limit = 8;
        $db = Db::instance();
        $sql = "SELECT n.id as id, n.title as title, n.short_title as short_title,
		            n.content as content,
		            n.short_content as short_content,
                    n.date as date,
                    n.author_id as author_id,
                    a.name as author_name,
                    c.name as category_name,
                    n.category_id as category_id
                FROM `news` as n 
                INNER JOIN category as c on n.category_id = c.id
                INNER JOIN authors as a on n.author_id = a.id
                WHERE n.status = 1 AND n.is_recommended = 1 ORDER BY n.id DESC LIMIT ?";

        return $db->query($sql, array($limit));
    }
}