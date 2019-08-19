<?php



class Db{

     function __construct(){
        require_once "lib/rb.php";
        $db = require_once 'config/config_db.php';

        R::setup($db['dsn'], $db['user'], $db['pass']);
        if( !R::testConnection() ){
            throw new \Exception("Нет соединения с БД", 500);
        }
        //R::freeze(true);

        R::debug(true, 1);

        R::ext('xdispense', function($type){
            return \R::getRedBean()->dispense( $type );
        });
    }

    function setFields($attr, $table){
        $record=R::dispense($table);
        foreach ($attr as $name=>$value){
            $record->$name=$value;
        }
        return R::store($record);
    }

    function getAll($table,$sort){
        return R::findAll($table,"ORDER BY id {$sort}");
    }

    function delById($table, $id){
        R::trash(R::load($table, $id));
    }

    function updateById($attr, $table){
        $record = R::load($table, $attr['id']);
        foreach ($attr as $name=>$value){
            if ($value!='') {
                $record->$name = $value;
            }
        }
        return R::store($record);
    }

}