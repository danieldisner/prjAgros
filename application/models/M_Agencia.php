<?php

class M_Agencia extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('agencia');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('agencia',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('agencia',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('agencia', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('agencia');
    }
}