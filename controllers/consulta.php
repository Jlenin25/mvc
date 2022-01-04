<?php

class Consulta extends Controller{
    public function __construct(){
        parent::__construct();
        $this->view->alumnos = [];
    }
    public function render(){
        $alumnos = $this->model->get();
        $this->view->alumnos = $alumnos;
        $this->view->render('consulta/index');
    }
    public function verAlumno($param = null){
        $idAlumno = $param[0];
        $alumno = $this->model->getById($idAlumno);
        session_start();
        $_SESSION['id_verAlumno'] = $alumno->matricula;
        $this->view->alumno = $alumno;
        $this->view->mensaje = "";
        $this->view->render('consulta/detalle');
    }
    public function actualizarAlumno(){
        session_start();
        $matricula = $_SESSION['id_verAlumno'];
        $nombre    = $_POST['nombre'];
        $apellido  = $_POST['apellido'];
        $image  = $_POST['image'];
        unset($_SESSION['id_verAlumno']);
        if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido, 'image' => $image] )){
            $alumno = new Alumno();
            $alumno->matricula = $matricula;
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;
            $this->view->alumno = $alumno;
            $this->view->mensaje = "Alumno actualizado correctamente";
        }else{
            $this->view->mensaje = "No se pudo actualizar el alumno";
        }
        $this->view->render('consulta/detalle');
    }
    public function eliminarAlumno($param = null) {
        $matricula = $param[0];
        $image = $this->db->connect()->prepare("SELECT image FROM alumnos WHERE matricula=:id");
        unlink('img/'.$image[0]['image']);
        if($this->model->delete($matricula)){
            $mensaje = "Alumno eliminado correctamente";
        }else{
            $mensaje = "No se pudo eliminar el alumno";
        }
        echo $mensaje;
    }
}