<!doctype html>
<?php
    include_once '../Modelo/Categoria.php';
    session_start();
    $ArrayTareas=$_SESSION['ArrayTareas'];
    $ArrayObjCategorias=$_SESSION['ArrayCategorias'];
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="Home.css" media="screen">
        <title>Gestor de Tareas</title>    
   </head>
   <body>
    <h1>Gestor de tareas</h1>

    <article id="NuevaTarea">
    <section id="crearTarea">
        <!-- <form action="../Controladores/Controlador_AltaTarea.php" id="formTarea" name="form" redirect="true"> -->
            <input type="text" id="inpTarea" name="denominacionTarea" placeholder="Introduzca su tarea..." required>
            <div id="categoriasBox">
            <?php foreach($ArrayObjCategorias as $Categoria){ ?>
                <p><input type="checkbox" class="boxCategorias" name="categorias" value="<?php echo $Categoria->getDenominacion() ?>"><?php echo $Categoria->getDenominacion() ?></p>
            <?php } ?>
            </div>
            <button id="botonAñadir" onclick="comprobar()">Añadir Tarea</button>
    </section>
    </article>

    <article id="TodasTareas">
    <section id="padretablaTareas">
        <table id='tablaTareas'>
            <?php
                // $console = 'console.log(' . json_encode($ArrayCategorias) . ');';
                // $console = sprintf('<script>%s</script>', $console);
                // echo $console;
                if(count($ArrayTareas)==0){
            ?>
            <tr id="thEscondidos" hidden>
                <th id="THTarea">Tarea</th>
                <th>Categorias</th>
                <th>Acciones</th>
            </tr>
            <tr>
            <th id="sinTareas">Aún no hay ninguna tarea</th>
            </tr>
            <?php
                }else{
            ?>
            <th id="sinTareas" hidden>Aún no hay ninguna tarea</th>
            <tr id="thNoEscondidos">
                <th id="THTarea">Tarea</th>
                <th>Categorias</th>
                <th>Acciones</th>
            </tr>
            <?php
                $ArrayRepetidos=array();
                foreach($ArrayTareas as $Object){ 
                if(!in_array($Object->denominacionTarea, $ArrayRepetidos)){
                $ArrayCategorias=array();
                for($i=0;$i<count($ArrayTareas);$i++){
                    if($Object->denominacionTarea==$ArrayTareas[$i]->denominacionTarea){
                        $ArrayCategorias[]=$ArrayTareas[$i]->denominacionCategoria;
                    }
                }            
            ?>
            <tr>
                <td class="totalTareas"><?php echo $Object->denominacionTarea ?></td>
                <td><?php foreach($ArrayCategorias as $Categoria){ ?>
                    <h3><?php echo $Categoria ?></h3>
                <?php } ?></td>
                <td id='eliminar_<?php echo $Object->denominacionTarea ?>'><button onclick="eliminarTarea('<?php echo $Object->denominacionTarea ?>')">Borrar</button></td>
            </tr>
            <?php
            $ArrayRepetidos[]=$Object->denominacionTarea;
                }}
            }
            ?>
        </table>
    </section>
    </article>
    <script src="../JavaScript/JavaScript.js"></script>
   </body>
 </html>