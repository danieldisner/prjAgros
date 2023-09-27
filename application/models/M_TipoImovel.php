<?php

class M_TipoImovel extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('tipo_imovel');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('tipo_imovel',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('tipo_imovel',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('tipo_imovel', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('tipo_imovel');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaTipoImovelCombo(){
        $this->db->select('*');
        $this->db->from('tipo_imovel');
        $consulta = $this->db->get();
        return $consulta;
    }
}