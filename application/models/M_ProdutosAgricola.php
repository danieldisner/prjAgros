<?php

class M_ProdutosAgricola extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('produtos_agricola');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('produtos_agricola',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('produtos_agricola',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('produtos_agricola', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('produtos_agricola');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaProdutosAgricolaCombo(){
        $this->db->select('*');
        $this->db->from('produtos_agricola');
        $consulta = $this->db->get();
        return $consulta;
    }
}