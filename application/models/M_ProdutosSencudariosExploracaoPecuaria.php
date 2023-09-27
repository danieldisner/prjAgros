<?php

class M_ProdutosSencudariosExploracaoPecuaria extends CI_Model{
    
    // Função para buscar um registro
    public function buscarDados($empresa,$cpfcnpj,$exploracaopecuaria){
        $this->db->select('empresa,
                           id,
                           cpfcnpj,
                           exploracaopecuaria,
                           format(vendasobtida,2,\'de_DE\') as vendasobtida,
                           format(vendasprevista,2,\'de_DE\') as vendasprevista,');
        $this->db->from('produtos_secundarios_exploracao_pecuaria'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('exploracaopecuaria', $exploracaopecuaria);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('produtos_secundarios_exploracao_pecuaria',$dados);
    }
    
    // Função para excluir todos os registros de uma exploração
    public function excluirRegistrosExploracao($empresa,$cpfcnpj,$exploracaopecuaria){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('exploracaopecuaria', $exploracaopecuaria);
        return $this->db->delete('produtos_secundarios_exploracao_pecuaria');
    }
}