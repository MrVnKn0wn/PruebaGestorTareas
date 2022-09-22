<?php
    include '../DAO/Operaciones.php';
    session_start();
    
    try {
        $ArrayCategorias = Operaciones::listadoCategorias(); 
        $_SESSION['ArrayCategorias'] = $ArrayCategorias;
        header("Location:../Vistas/Home.php");
    }
    catch (Exception $ex) {
        echo 'Caught exception: ',  $ex->getMessage(), "\n";
    }