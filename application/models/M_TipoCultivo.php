<?php

class M_TipoCultivo extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('tipo_cultivo');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('tipo_cultivo',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('tipo_cultivo',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('tipo_cultivo', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('tipo_cultivo');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaTipoCultivoCombo(){
        $this->db->select('*');
        $this->db->from('tipo_cultivo');
        $consulta = $this->db->get();
        return $consulta;
    }
}