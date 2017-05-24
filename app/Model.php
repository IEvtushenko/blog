<?php

namespace App;

abstract class Model
{
    const TABLE = '';

    public $id = false;

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query('SELECT * FROM ' . static::TABLE, [], static::class);
    }

    public static function findById($id)
    {
        $db = Db::instance();
        return $db->query('SELECT * FROM ' . static::TABLE . " WHERE id = ?", array($id), static::class);
    }

    /**
     * Проверяет существует ли запись
     * @return bool
     */
    public function isNew()
    {
        return $this->id == false;
    }

    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ($this as $k => $v) {
            if (('id' == $k) || ('data' == $k)) {
                continue;
            }
            $columns[] = $k;
            $values[':' . $k] = $v;
        }
        $sql = 'INSERT INTO ' . static::TABLE . ' (' . implode(',', $columns) . ') VALUES (' . implode(',', array_keys($values)) . ')';

        $db = Db::instance();
        $result = $db->execute($sql, $values);
        $this->id = $this->lastId();
    }

    public function update()
    {
        $id = [];
        $columns = [];
        $values = [];

        foreach ($this as $k => $v) {
            if ('is_new' == $k || 'date' == $k || ('data' == $k)) {
                continue;
            }
            $values[":" . $k] = $v;
            if (('id' == $k) || ('is_new' == $k) || 'date' == $k || ('data' == $k)) {
                $id[] = ":" . $k;
                continue;
            }

            $columns[] = $k . "= " . ":" . $k;
        }

        $sql = "UPDATE " . static::TABLE . " SET " . implode(', ', $columns) . " WHERE id = " . $id[0];
        $db = Db::instance();

        $result = $db->execute($sql, $values);

        if (true == $result) {
            return true;
            echo "<meta http-equiv=\"refresh\" content=\"0; url=''\">";
        } else {
            require_once(ROOT . "/views/admin/save.php");
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM " . static::TABLE . " WHERE id = :id";
        $db = Db::instance();
//        $db->execute($sql, array(":id" => $id));
        if ($db->execute($sql, array(":id" => $id))) {
            //todo-vanya Доделать нормально удаление файлов
            unlink(ROOT . "/templates/img/big/$id.jpg");
            unlink(ROOT . "/templates/img/small/$id.jpg");
            unlink(ROOT . "/templates/img/recommended/$id.jpg");
            header("Location: \\admin");
        }
        return false;
    }

    /**
     * Определяет сохранить запись или перезаписать
     */
    public function save()
    {
        if ($this->isNew()) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    /**
     * @return string id Последней записи
     */
    public function lastId()
    {
        $db = Db::instance();
        return $db->lastId();
    }


    

}