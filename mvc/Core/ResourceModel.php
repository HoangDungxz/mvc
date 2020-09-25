<?php

namespace MVC\Core;

use MVC\Core\ResourceModelInterface;
use MVC\Core\Model;
use MVC\Config\Database;



class ResourceModel implements ResourceModelInterface
{
    private $id;
    private $table;
    private $model;


    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        $md = new Model;


        $modelArr = $md->getProperties($model);

        if (array_key_exists($this->id, $modelArr)) {
            unset($modelArr[$this->id]);
        }
        if (array_key_exists('created_at', $modelArr)) {
            if ($model->getCreatedAt() == NULL) {
                unset($modelArr['created_at']);
            }
        }
        if (array_key_exists('updated_at', $modelArr)) {
            if ($model->getUpdatedAt() == NULL) {
                unset($modelArr['updated_at']);
            }
        }

        if ($model->getId() == NULL) {
            $strKey = implode(",", array_keys($modelArr));
            $strValue = "\"" . implode("\",\"", $modelArr) . "\"";
            $sql = "INSERT INTO $this->table ($strKey) VALUES ($strValue)";
        } else {
            $strUpdate = implode(', ', array_map(
                function ($v, $k) {
                    return sprintf("`%s`='%s'", $k, $v);
                },
                $modelArr,
                array_keys($modelArr)
            ));
            $id = $model->getId();
            $sql = "UPDATE $this->table SET $strUpdate WHERE $this->id = $id";
        }
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE $this->id = $id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute();
    }
    public function select($id = null)
    {
        $sql = "SELECT * FROM $this->table";

        if ($id != NULL) {
            $sql .= " WHERE $this->id = $id";
        }

        $req = Database::getBdd()->prepare($sql);
        $req->execute();

        if ($id != NULL) {
            return $req->fetch();
        } else {
            return $req->fetchAll();
        }
    }
}
