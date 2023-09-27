<?php

class M_Autorizacao extends CI_Model{

    // Busca os dados da tabela para preencher o grid
    public function buscarAutorizacao($grupo,$menu){
        $this->db->select('*');
        $this->db->from('autorizacao'); 
        $this->db->where('grupo',$grupo);
        $this->db->where('menu',$menu);
        $query = $this->db->get(); 
        return $query;
    }
}