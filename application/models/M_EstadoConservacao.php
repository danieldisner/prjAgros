<?php

class M_EstadoConservacao extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('estado_conservacao');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('estado_conservacao',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('estado_conservacao',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('estado_conservacao', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('estado_conservacao');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaEstadoConservacaoCombo(){
        $this->db->select('*');
        $this->db->from('estado_conservacao');
        $consulta = $this->db->get();
        return $consulta;
    }
}