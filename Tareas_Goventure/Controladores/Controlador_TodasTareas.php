<?php
    include '../DAO/Operaciones.php';
    session_start();
    
    try {
        $ArrayTareas = Operaciones::listadoTareas(); //Con sus categorias
        $_SESSION['ArrayTareas'] = $ArrayTareas;
        header("Location:./Controlador_TraerCategorias.php");
        // header("Location:../Vistas/Home.php"); 
    }
    catch (Exception $ex) {
        echo 'Caught exception: ',  $ex->getMessage(), "\n";
    }