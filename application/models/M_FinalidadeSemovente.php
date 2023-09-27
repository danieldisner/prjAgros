<?php

class M_FinalidadeSemovente extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('finalidade_semovente');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('finalidade_semovente',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('finalidade_semovente',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('finalidade_semovente', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('finalidade_semovente');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaFinalidadeCombo(){
        $this->db->select('*');
        $this->db->from('finalidade_semovente');
        $consulta = $this->db->get();
        return $consulta;
    }
}