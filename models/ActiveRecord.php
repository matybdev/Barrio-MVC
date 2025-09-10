<?php

namespace Model;


class ActiveRecord{
    protected static $db;

    //definir la conexion a la base de datos
      public static function setDB($database){
       self::$db = $database;
     }

     public static function consultarSQL($query){

        //consultar la base de datos
        $resultado = self::$db->query($query);

        //iterar 
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }


        //liberar la memoria

        $resultado->free();

        //retornar los resultados
        return $array;

    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach ($registro as $key => $value){
            if(property_exists($objeto, $key )){
                $objeto->$key = $value;     
            }
        }

        return $objeto;
    }
}