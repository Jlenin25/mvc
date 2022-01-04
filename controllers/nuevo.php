<?php

class Nuevo extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //echo "<p>Nuevo controlador Main</p>";
    }
    function render(){
        $this->view->render('nuevo/index');
    }
    function registrarAlumno(){
        $matricula = $_POST['matricula'];
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        $date = new DateTime();
        $image = $date->getTimestamp().'_'.$_FILES['image']['name'];
        $tmpImage = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmpImage,'public/img/'.$image);
        $mensaje = "";
        if($this->model->insert(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido, 'image' => $image])){
            $mensaje = "Nuevo alumno creado";
        }else{
            $mensaje = "La matrícula ya existe";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }
}