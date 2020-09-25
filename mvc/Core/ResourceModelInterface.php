<?php
namespace MVC\Core;

interface ResourceModelInterface{
    function _init($table,$id,$model);
    function save($model);
    function delete($model);
}