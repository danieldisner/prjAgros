<?php

class M_SituacaoPropriedade extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('situacao_propriedade');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('situacao_propriedade',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('situacao_propriedade',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('situacao_propriedade', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('situacao_propriedade');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaSituacaoPropriedadeCombo(){
        $this->db->select('*');
        $this->db->from('situacao_propriedade');
        $consulta = $this->db->get();
        return $consulta;
    }
}