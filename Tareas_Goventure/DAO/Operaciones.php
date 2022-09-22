<?php

include 'ConectarBD.php';  
include '../Modelo/ApplicationErrorException.php';
include_once '../Modelo/Tarea.php';
include_once '../Modelo/Categoria.php';

class Operaciones {

    public static function listadoTareas(){
        global $conexion;

        $ArrayTareas = array();
        $orderSQL = "SELECT T.id AS idTarea, T.denominacion AS denominacionTarea, C.id AS idCategoria, C.denominacion AS denominacionCategoria,
        TC.id AS idTC, TC.idTarea AS idTareaTC, TC.idCategoria AS idCategoriaTC
        FROM tarea T, categoria C, tarea_categoria TC
        WHERE T.id = TC.idTarea AND C.id = TC.idCategoria";

        $resultado=$conexion->query($orderSQL);
        if($resultado->num_rows>0){
            $Obj=$resultado->fetch_object(); 
            while($Obj){
                $ArrayTareas[]=$Obj;
                $Obj=$resultado->fetch_object();
            }          
        }
        return $ArrayTareas;
        // else{
        //     $Mensaje=$conexion->err;
        //     $Codigo=$conexion->errno;
        //     $Lugar="No se ha podido listar las tareas en listadoTareas()";  
        //     throw new ApplicationErrorException($Mensaje,$Codigo,$Lugar);
        // }

    }
    
    public static function listadoCategorias(){
        global $conexion;

        // $ArrayCategorias = array();
        $orderSQL = "SELECT * FROM categoria ORDER BY id ASC";

        $resultado=$conexion->query($orderSQL);

        if($resultado){
            if($resultado->num_rows==0){
            return null;
            }
            $fila=$resultado->fetch_assoc(); //Metemos los datos en objetos de tipo Categoria
            while($fila){
                $Id=$fila['id'];
                $Denominacion=$fila['denominacion'];
                
                $ObjCategoria=new Categoria($Denominacion);                
                $ObjCategoria->setId($Id);
                
                $ArrayCategorias[]=$ObjCategoria;    
                $fila=$resultado->fetch_assoc();
                
            }
            return $ArrayCategorias;
        }else{
            $Mensaje=$conexion->err;
            $Codigo=$conexion->errno;
            $Lugar="La lista de categorias no se puede mostrar en listadoCategorias()";
            throw new ApplicationErrorException($Mensaje,$Codigo,$Lugar); 
        }
    }   

    public static function insertarTarea($ObjTarea, $ArrayObjCategorias){
        global $conexion;

        $DenominacionTarea=$ObjTarea->getDenominacion();

        $ordenSQL="INSERT INTO tarea (denominacion) VALUES (?)";
        $sentencia=$conexion->prepare($ordenSQL);
        $sentencia->bind_param("s", $DenominacionTarea);
        $resultado=$sentencia->execute();

        $IdTarea=$conexion->insert_id; //El id de la tarea que acabo de insertar

        if($resultado==null){
            $Mensaje=$conexion->err;
            $Codigo=$conexion->errno;
            $Lugar="Tarea no dada de alta en insertarTarea() al insertar tarea";
            if($Codigo=='1062'){
            $Lugar="Esa tarea ya está en uso";
            }           
            throw new ApplicationErrorException($Mensaje,$Codigo,$Lugar);
            return false;
        }

        foreach($ArrayObjCategorias as $ObjCategoria){
            $CatDenominacion=$ObjCategoria->getId();
            $ordenSQL2="INSERT INTO tarea_categoria (idTarea, idCategoria) VALUES (?,?)";
            $sentencia2=$conexion->prepare($ordenSQL2);
            $sentencia2->bind_param("ii", $IdTarea,$CatDenominacion);
            $resultado2=$sentencia2->execute();

            if($resultado2==null){
                $Mensaje=$conexion->err;
                $Codigo=$conexion->errno;
                $Lugar="Tarea no dada de alta en tarea_categoria al insertar insertarTarea";
                throw new ApplicationErrorException($Mensaje,$Codigo,$Lugar);
                return false;
            }
        }

        return true;
    }

    public static function borrarTarea($DenTarea){
        global $conexion;
        
        $ordenSQL="DELETE FROM tarea_categoria WHERE idTarea=(SELECT id FROM tarea WHERE denominacion=(?));";
        $sentencia=$conexion->prepare($ordenSQL);
        $sentencia->bind_param("s", $DenTarea);
        $resultado=$sentencia->execute(); 
        if($conexion->affected_rows==0){
            $Mensaje=$conexion->err;
            $Codigo=$conexion->errno;
            $Lugar="Tarea_categoria no eliminadas en borrarTarea() en la tabla tarea_categoria";
            throw new ApplicationErrorException($Mensaje,$Codigo,$Lugar);
        }else {
            $ordenSQL2="DELETE FROM tarea WHERE denominacion=(?);";
            $sentencia2=$conexion->prepare($ordenSQL2);
            $sentencia2->bind_param("s", $DenTarea);
            $resultado2=$sentencia2->execute(); 
            if($conexion->affected_rows==0){
                $Mensaje=$conexion->err;
                $Codigo=$conexion->errno;
                $Lugar="Tarea no eliminada en borrarTarea() en la tabla tarea";
                throw new ApplicationErrorException($Mensaje,$Codigo,$Lugar);
            }else{
                return true;
            } 
        } 
    }

}
