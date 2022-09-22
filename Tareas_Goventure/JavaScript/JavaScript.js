function comprobarCheckBox() {
    var checkBoxes = document.getElementsByClassName('boxCategorias');
    var isChecked = false;
    for (let i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].checked) {
            isChecked = true;
        };
    };
    if (!isChecked) {

        return false;
    } 
    return true;
}

function guardarTarea(){ //Guarda una tarea con AJAX
    let xmlhttp;

    let tablaTarea=document.getElementById('tablaTareas');
    let denonTareaNueva=document.getElementById('inpTarea').value;

    let tareaConCategorias= []; //La tarea con las categorias seleccionadas
    tareaConCategorias.push(denonTareaNueva);
    let inputElements = document.getElementsByClassName('boxCategorias');
    for(let i=0; inputElements[i]; ++i){
      if(inputElements[i].checked){
        tareaConCategorias.push(inputElements[i].value);
      }
    }
    // console.log(tareaConCategorias);
    let arrayJSON=JSON.stringify(tareaConCategorias);//Para enviarlo como String

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
        /* Creamos el objeto request para conexiones http,
        compatible con los navegadores descritos*/
    }
    else {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        /*Como el explorer va por su cuenta, el objeto es un ActiveX */
    }
    xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        // let nuevoTr=document.createElement('tr');
        // nuevoTr.innerHTML=xmlhttp.responseText;
        // tablaTarea.appendChild(nuevoTr);
        if(xmlhttp.responseText=="<h2> Conexión establecida con el servidor</h2><br><h2> Conexión establecida con la base de datos bdd_prueba_pedromm</h2><br>True"){
            let nuevoTr=document.createElement('tr');
            let tdTarea=document.createElement('td');
            tdTarea.setAttribute('class','totalTareas');
            tdTarea.appendChild(document.createTextNode(denonTareaNueva));
            nuevoTr.appendChild(tdTarea);
            let tdCategoria=document.createElement('td');
            for(let i=1;i<tareaConCategorias.length;i++){
            let h3Categoria=document.createElement('h3');
            h3Categoria.appendChild(document.createTextNode(tareaConCategorias[i]));
            tdCategoria.appendChild(h3Categoria);
            }
            nuevoTr.appendChild(tdCategoria);
            let tdBorrar=document.createElement('td');
            let botonBorrar=document.createElement('button');
            botonBorrar.appendChild(document.createTextNode('Borrar'));
            botonBorrar.onclick=function(){eliminarTarea(denonTareaNueva)};
            tdBorrar.appendChild(botonBorrar);
            tdBorrar.setAttribute('id','eliminar_'+denonTareaNueva);
            nuevoTr.appendChild(tdBorrar);

            if(document.getElementById('thEscondidos')){
                let thEscondidos=document.getElementById('thEscondidos');
                thEscondidos.hidden=false;
                let sinTareas=document.getElementById('sinTareas');
                sinTareas.hidden=true;
            }

            if(document.getElementById('thNoEscondidos')){
                let thEscondidos=document.getElementById('thNoEscondidos');
                thEscondidos.hidden=false;
                let sinTareas=document.getElementById('sinTareas');
                sinTareas.hidden=true;
            }

            tablaTarea.appendChild(nuevoTr);
        }
    }
    }
    xmlhttp.open("GET","../Controladores/ControladorAJAX_AltaTarea.php?TareaCategorias="+arrayJSON,true);

        /*Mandamos al PHP encargado de traer los datos, el valor de referencia */
    xmlhttp.send();
}

function eliminarTarea(tarea){ //Borra del servidor la tarea y de la tabla
    // alert('Elimino la tarea '+tarea);
    let xmlhttp;

    if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
    }
    else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) { //Si se elimina de base de datos tambien de la tabla
        if(xmlhttp.responseText=="<h2> Conexión establecida con el servidor</h2><br><h2> Conexión establecida con la base de datos bdd_prueba_pedromm</h2><br>True"){
            if(document.getElementsByClassName("totalTareas")[0]){
                let tareas=document.getElementsByClassName("totalTareas");
                for(let i=0;i<tareas.length;i++){
                    if(tarea==tareas[i].innerHTML){
                        let trEliminado=tareas[i].parentNode;
                        trEliminado.remove();
                        if(tareas.length==0){
                            if(document.getElementById('thNoEscondidos'))document.getElementById('thNoEscondidos').hidden=true;
                            if(document.getElementById('thEscondidos'))document.getElementById('thEscondidos').hidden=true;
                            document.getElementById('sinTareas').hidden=false;
                        }
                    }
                }
            }
        }
    }}
    xmlhttp.open("GET","../Controladores/ControladorAJAX_BajaTarea.php?TareaBaja="+tarea,true);
    xmlhttp.send();
}

function comprobar(){ //Comprueba que los inputs esten seleccionados y que no se repite una tarea
    let denonTareaNueva=document.getElementById('inpTarea');
    if(!comprobarCheckBox() || denonTareaNueva.value==""){ //Si no se ha escrito tarea o no se ha seleccionado al menos una categoria
        if(denonTareaNueva.value=="") alert('Debes escribir una tarea.')
        else if(!comprobarCheckBox()) alert('Debes seleccionar al menos una categoria.');
    }else{ //Comprueba que la tarea no este repetida
        if(document.getElementsByClassName("totalTareas")[0]){
            let isRepetida=false;
            let tareas=document.getElementsByClassName("totalTareas");
            for(let i=0;i<tareas.length;i++){
                if(denonTareaNueva.value==tareas[i].innerHTML){
                    isRepetida=true;
                    alert('Esta tarea ya está repetida.');
                }
            }
            if(!isRepetida){
                guardarTarea();
            }
        }else{
            guardarTarea();
        }
    }
}