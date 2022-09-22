<?php
    include '../DAO/Operaciones.php';
    include_once '../Modelo/Tarea.php';
    include_once '../Modelo/Categoria.php';
    session_start();
    $ArrayObjCategorias=$_SESSION['ArrayCategorias'];
    $TareaCategoriasString=$_REQUEST['TareaCategorias'];

    $TareaCategorias=json_decode($TareaCategoriasString);

    $ObjTarea=new Tarea($TareaCategorias[0]);

    // $Categorias=$_GET['categorias'];
    $arrayObjCategoriasElegidas=array();
    foreach ($ArrayObjCategorias as $ObjCategoria){ //Filtro los objetos seleccionados para el insert
        for($i=1;$i<count($TareaCategorias);$i++){
            if($TareaCategorias[$i]==$ObjCategoria->getDenominacion()){
                $arrayObjCategoriasElegidas[]=$ObjCategoria;
            }
        }
    }
    // foreach($arrayObjCategoriasElegidas as $A){
    //     echo $A;
    // }
    
    try{
        $isGuardado=Operaciones::insertarTarea($ObjTarea, $arrayObjCategoriasElegidas);
        if($isGuardado){
            echo "True";
            // echo "
            // <td class='totalTareas'>".$TareaCategorias[0]."</td>
            // <td>".foreach($TareaCategoriasString as $Categoria){.
            // "<h3>".$Categoria."</h3>".}.    
            // "</td>
            // <td>Borrar</td>
            // ";
        }
        exit;
    }catch (Exception $ex) {
        echo 'Caught exception: ',  $ex->getMessage(), "\n";
    }
    