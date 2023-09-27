<?php

class M_Movel extends CI_Model{  
    // Busca quantidade de imoveis do cliente
    public function buscarQtdMoveis($empresa,$cpfcnpj){
        $this->db->select('count(*) as totalMoveis');
        $this->db->from('moveis');     
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->row()->totalMoveis;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('moveis',$dados);
    }
    
    // Função para excluir todos os registros do cliente
    public function excluir($empresa,$cpfcnpj){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        return $this->db->delete('moveis');
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosMoveis($empresa,$cpfcnpj){
        $this->db->select('moveis.id,
                           moveis.cpfcnpj,
                           moveis.especie,
                           moveis.fabricante,
                           moveis.modelo,
                           moveis.anomodelo,
                           moveis.sitpropriedade,
                           moveis.gravame,
                           moveis.seriechassi,
                           moveis.potencia,
                           moveis.potenciatipo,
                           moveis.estadoconservacao,
                           moveis.part,
                           format(valor,2,\'de_DE\') as valor,
                           moveis.imovel,
                           moveis.tipoimovel,
                           imoveis.matricula as matricula,
                           especie_movel.nome as especieDesc,
                           situacao_propriedade.nome as sitpropriedadeDesc,
                           gravame.nome as gravameDesc,
                           estado_conservacao.nome as estadoconservacaoDesc');
        $this->db->from('moveis'); 
        $this->db->join('especie_movel', 'moveis.especie = especie_movel.id','left');
        $this->db->join('situacao_propriedade', 'moveis.sitpropriedade = situacao_propriedade.id','left');     
        $this->db->join('gravame', 'moveis.gravame = gravame.id','left');
        $this->db->join('estado_conservacao', 'moveis.estadoconservacao = estado_conservacao.id','left');
        $this->db->join('imoveis', 'moveis.empresa = imoveis.empresa and moveis.imovel = imoveis.id and moveis.cpfcnpj = imoveis.cpfcnpj and moveis.tipoimovel = imoveis.tipo','left');
        $this->db->where('moveis.empresa',$empresa);
        $this->db->where('moveis.cpfcnpj',$cpfcnpj);
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result();
    }
}