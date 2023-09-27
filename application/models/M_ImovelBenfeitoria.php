<?php

class M_ImovelBenfeitoria extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid($empresa,$cpfcnpj,$imovel){
        $this->db->select('imovel_benfeitoria.benfeitoria,
                           benfeitoria.nome AS benfeitoriaDesc,
                           format(imovel_benfeitoria.dimensao,2,\'de_DE\') as dimensao,
                           benfeitoria.unidade,
                           imovel_benfeitoria.idade,
                           format(imovel_benfeitoria.valor,2,\'de_DE\') as valor');
        $this->db->from('imovel_benfeitoria'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('imovel',$imovel);
        $this->db->join('benfeitoria', 'imovel_benfeitoria.benfeitoria = benfeitoria.id');
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('imovel_benfeitoria',$dados);
    }
    
    // Função para excluir todos os registros do cliente
    public function excluir($empresa,$cpfcnpj,$imovel){
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('imovel', $imovel);
        return $this->db->delete('imovel_benfeitoria');
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDados($empresa,$cpfcnpj,$imovel){
        $this->db->select('imovel_benfeitoria.benfeitoria,
                           benfeitoria.nome AS benfeitoriaDesc,
                           format(imovel_benfeitoria.dimensao,2,\'de_DE\') as dimensao,
                           benfeitoria.unidade,
                           benfeitoria.codigo,
                           imovel_benfeitoria.idade,
                           format(imovel_benfeitoria.valor,2,\'de_DE\') as valor');
        $this->db->from('imovel_benfeitoria'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('imovel',$imovel);
        $this->db->join('benfeitoria', 'imovel_benfeitoria.benfeitoria = benfeitoria.id');
        $query = $this->db->get(); 
        return $query->result_array();
    }
}