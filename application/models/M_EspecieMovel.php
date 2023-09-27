<?php

class M_EspecieMovel extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('especie_movel');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('especie_movel',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('especie_movel',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('especie_movel', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('especie_movel');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaEspeciesMovelCombo(){
        $this->db->select('*');
        $this->db->from('especie_movel');
        $consulta = $this->db->get();
        return $consulta;
    }
}