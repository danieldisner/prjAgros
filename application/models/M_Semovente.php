<?php

class M_Semovente extends CI_Model{
    // Busca quantidade de semoventes do cliente
    public function buscarQtdSemoventes($empresa,$cpfcnpj){
        $this->db->select('count(*) as totalSemoventes');
        $this->db->from('semoventes');   
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->row()->totalSemoventes;
    }

    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('semoventes',$dados);
    }
    
    // Função para excluir todos os semoventes do cliente
    public function excluir($empresa,$cpfcnpj){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        return $this->db->delete('semoventes');
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosSemoventes($empresa,$cpfcnpj){
        $this->db->select('semoventes.id,
                           semoventes.cpfcnpj,
                           semoventes.especie,
                           semoventes.quantidade,
                           semoventes.finalidade,
                           semoventes.raca,
                           semoventes.graumesticagem,
                           semoventes.idade,
                           semoventes.gravame,
                           semoventes.seguro,
                           semoventes.sitpropriedade,
                           format(semoventes.valorunitario,2,\'de_DE\') as valorunitario,
                           format(semoventes.valortotal,2,\'de_DE\') as valortotal,
                           semoventes.part,
                           semoventes.imovel,
                           semoventes.tipoimovel,
                           semoventes.pelagem,
                           imoveis.matricula as matricula,
                           especie_semovente.nome as especieDesc,
                           finalidade_semovente.nome as finalidadeDesc,
                           raca.nome as racaDesc,
                           gravame.nome as gravameDesc,
                           case seguro when 0 then \'NÃO\' else \'SIM\' end as seguroDesc,
                           situacao_propriedade.nome as sitpropriedadeDesc');
        $this->db->from('semoventes'); 
        $this->db->join('especie_semovente', 'semoventes.especie = especie_semovente.id','left');
        $this->db->join('finalidade_semovente', 'semoventes.finalidade = finalidade_semovente.id','left');
        $this->db->join('raca', 'semoventes.raca = raca.id','left');
        $this->db->join('gravame', 'semoventes.gravame = gravame.id','left');
        $this->db->join('situacao_propriedade', 'semoventes.sitpropriedade = situacao_propriedade.id','left'); 
        $this->db->join('imoveis', 'semoventes.empresa = imoveis.empresa and semoventes.imovel = imoveis.id and semoventes.cpfcnpj = imoveis.cpfcnpj and semoventes.tipoimovel = imoveis.tipo','left');
        $this->db->where('semoventes.empresa',$empresa);
        $this->db->where('semoventes.cpfcnpj',$cpfcnpj);
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result();
    }
}