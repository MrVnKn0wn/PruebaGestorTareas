<?php
    include '../DAO/Operaciones.php';
    session_start();

    $Tarea=$_REQUEST['TareaBaja']; //Denominacion de la tarea
    
    try{
        $isGuardado=Operaciones::borrarTarea($Tarea);
        if($isGuardado){
            echo "True";
        }
        exit;
    }catch (Exception $ex) {
        echo 'Caught exception: ',  $ex->getMessage(), "\n";
    }
    