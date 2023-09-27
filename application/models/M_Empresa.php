<?php

class M_Empresa extends CI_Model{    
    // Busca um determinado registro
    public function buscarRegistro($empresa){
        $this->db->select('empresa.*,
                           municipio.nome as municipioDesc,
                           municipio.uf as uf');
        $this->db->from('empresa'); 
        $this->db->join('municipio', 'empresa.municipio = municipio.id','left');
        $this->db->where('empresa.id',$empresa);
        $query = $this->db->get();
        return $query;
    }
    
    // Função para alterar um registro
    public function atualizar($id,$dados){
        $this->db->where('id',$id);
        return $this->db->update('empresa', $dados);
    }
    
}