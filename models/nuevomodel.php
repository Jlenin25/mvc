<?php

class NuevoModel extends Model{
    public function __construct(){
        parent::__construct();
    }
    public function insert($datos){
        try{
            $query = $this->db->connect()->prepare('INSERT INTO ALUMNOS (MATRICULA, NOMBRE, APELLIDO, IMAGE) VALUES(:matricula, :nombre, :apellido, :image)');
            $query->execute(['matricula'=>$datos['matricula'], 'nombre'=>$datos['nombre'], 'apellido'=>$datos['apellido'], 'image'=>$datos['image']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}