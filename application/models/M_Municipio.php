<?php

class M_Municipio extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('municipio');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('municipio',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('municipio',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('municipio', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('municipio');
    }
    
    // Busca municipios pela UF
    public function buscarMunicipiosUF($uf){
        $this->db->select('*');
        $this->db->from('municipio'); 
        $this->db->where('uf',$uf);
        $query = $this->db->get(); 
        return $query;
    }
}