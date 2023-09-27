<?php

class M_Tecnico extends CI_Model{
    
    // Busca um registro
    public function buscarRegistro($empresa,$id){
        $this->db->select('*');
        $this->db->from('tecnico'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('id',$id);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Busca os registros pela empresa
    public function buscarTecnicosEmpresa($empresa){
        $this->db->select('*');
        $this->db->from('tecnico'); 
        $this->db->where('empresa',$empresa);
        $query = $this->db->get(); 
        return $query;
    }
}