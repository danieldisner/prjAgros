<?php

class M_ImovelExploradoAgricola extends CI_Model{
    
    // Função para buscar um registro
    public function buscarDados($empresa,$cpfcnpj,$exploracaoagricola){
        $this->db->select('empresa,
                           imovel,
                           cpfcnpj,
                           exploracaoagricola,
                           format(areaexploradaobtida,2,\'de_DE\') as areaexploradaobtida,
                           format(areaexploradaprevista,2,\'de_DE\') as areaexploradaprevista,');
        $this->db->from('imovel_explorado_agricola'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('exploracaoagricola', $exploracaoagricola);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('imovel_explorado_agricola',$dados);
    }
    
    // Função para excluir todos os registros de uma exploração
    public function excluirRegistrosExploracao($empresa,$cpfcnpj,$exploracaoagricola){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('exploracaoagricola', $exploracaoagricola);
        return $this->db->delete('imovel_explorado_agricola');
    }
    
    // Função para buscar os dados e imprimir no relatorio
    public function buscarDadosRelatorio($empresa,$cpfcnpj,$exploracaoagricola){
        $this->db->select('imoveis.nome as imovelDesc,
                           areaexploradaobtida,
                           areaexploradaprevista,');
        $this->db->from('imovel_explorado_agricola');
        $this->db->join('imoveis', 'imovel_explorado_agricola.empresa = imoveis.empresa and imovel_explorado_agricola.imovel = imoveis.id and imovel_explorado_agricola.cpfcnpj = imoveis.cpfcnpj and imoveis.tipo=1');
        $this->db->where('imovel_explorado_agricola.empresa', $empresa);
        $this->db->where('imovel_explorado_agricola.exploracaoagricola', $exploracaoagricola);
        $this->db->where('imovel_explorado_agricola.cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->result();
    }
}