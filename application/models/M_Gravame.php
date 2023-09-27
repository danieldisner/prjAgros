<?php

class M_Gravame extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('gravame');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('gravame',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('gravame',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('gravame', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('gravame');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaGravameCombo(){
        $this->db->select('*');
        $this->db->from('gravame');
        $consulta = $this->db->get();
        return $consulta;
    }
}