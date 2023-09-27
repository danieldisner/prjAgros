<?php

class M_LogUsuario extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('logusuario');
        return $query->result();
    }
    
    // Função para inserir um registro
    public function gravarLog($dados){
        $this->db->insert('logusuario',$dados);
    }
}