<?php

class M_ImovelExploradoPecuaria extends CI_Model{
    
    // Função para buscar um registro
    public function buscarDados($empresa,$cpfcnpj,$exploracaopecuaria){
        $this->db->select('empresa,
                           imovel,
                           cpfcnpj,
                           exploracaopecuaria,
                           format(areaexploradaobtida,2,\'de_DE\') as areaexploradaobtida,
                           format(areaexploradaprevista,2,\'de_DE\') as areaexploradaprevista,');
        $this->db->from('imovel_explorado_pecuaria'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('exploracaopecuaria', $exploracaopecuaria);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('imovel_explorado_pecuaria',$dados);
    }
    
    // Função para excluir todos os registros de uma exploração
    public function excluirRegistrosExploracao($empresa,$cpfcnpj,$exploracaopecuaria){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('exploracaopecuaria', $exploracaopecuaria);
        return $this->db->delete('imovel_explorado_pecuaria');
    }
    
    // Função para buscar os dados e imprimir no relatorio
    public function buscarDadosRelatorio($empresa,$cpfcnpj,$exploracaopecuaria){
        $this->db->select('imoveis.nome as imovelDesc,
                           areaexploradaobtida,
                           areaexploradaprevista,');
        $this->db->from('imovel_explorado_pecuaria');
        $this->db->join('imoveis', 'imovel_explorado_pecuaria.empresa = imoveis.empresa and imovel_explorado_pecuaria.imovel = imoveis.id and imovel_explorado_pecuaria.cpfcnpj = imoveis.cpfcnpj and imoveis.tipo=1');
        $this->db->where('imovel_explorado_pecuaria.empresa', $empresa);
        $this->db->where('imovel_explorado_pecuaria.exploracaopecuaria', $exploracaopecuaria);
        $this->db->where('imovel_explorado_pecuaria.cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->result();
    }
}