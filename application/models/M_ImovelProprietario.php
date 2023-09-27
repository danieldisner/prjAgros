<?php

class M_ImovelProprietario extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid($empresa,$cpfcnpj,$imovel){
        $this->db->select('*');
        $this->db->from('imovel_proprietario'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('imovel',$imovel);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('imovel_proprietario',$dados);
    }
    
    // Função para excluir todos os registros do cliente
    public function excluir($empresa,$cpfcnpj,$imovel){
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('imovel', $imovel);
        return $this->db->delete('imovel_proprietario');
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDados($empresa,$cpfcnpj,$imovel){
        $this->db->select('*');
        $this->db->from('imovel_proprietario'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('imovel',$imovel);
        $query = $this->db->get(); 
        return $query->result_array();
    }
}