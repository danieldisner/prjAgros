<?php

class M_Imovel extends CI_Model{  
    // Busca quantidade de imoveis do cliente
    public function buscarQtdImoveis($empresa,$cpfcnpj){
        $this->db->select('count(*) as totalImoveis');
        $this->db->from('imoveis');    
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->row()->totalImoveis;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('imoveis',$dados);
    }
    
    // Função para excluir todos os registros do cliente
    public function excluir($empresa,$cpfcnpj){
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        return $this->db->delete('imoveis');
    }

    // Função para Informações do imovel
    public function alterarInformacoesImovel($empresa,$cpfcnpj,$id,$dados){
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id',$id);
        $this->db->where('tipo',1);
        return $this->db->update('imoveis',$dados);
    }

    // Função para atualizar Exploracao Agrícola do Imóvel
    public function alterarImovelExploracaoAgricola($empresa,$cpfcnpj,$id,$exploradoagricola){
        $this->db->set('exploradoagricola', $exploradoagricola);
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id',$id);
        $this->db->where('tipo',1);
        return $this->db->update('imoveis');
    }
    
    // Função para atualizar Exploracao Pecuária do Imóvel
    public function alterarImovelExploracaoPecuaria($empresa,$cpfcnpj,$id,$exploradopecuaria){
        $this->db->set('exploradopecuaria', $exploradopecuaria);
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id',$id);
        $this->db->where('tipo',1);
        return $this->db->update('imoveis');
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosRurais($empresa,$cpfcnpj,$exploradoagricola = null){
        $this->db->select('imoveis.id,
                           imoveis.cpfcnpj,
                           imoveis.nome,
                           imoveis.especie,
                           imoveis.matricula,
                           imoveis.registro,
                           imoveis.cep,
                           imoveis.endereco,
                           imoveis.nroendereco,
                           imoveis.bairro,
                           imoveis.municipio,
                           imoveis.part,
                           imoveis.sitpropriedade,
                           imoveis.estadoconservacao,
                           imoveis.gravame,
                           imoveis.cessaoterceiros,
                           imoveis.exploradoagricola,
                           imoveis.exploradopecuaria,
                           case cessaoterceiros when 0 then \'NÃO\' else \'SIM\' end as cessaoterceirosDesc,
                           format(valorhectare,2,\'de_DE\') as valorhectare,
                           format(areatotal,2,\'de_DE\') as areatotal,
                           format(valorterranua,2,\'de_DE\') as valorterranua,
                           municipio.nome as municipioDesc,
                           municipio.uf as uf,
                           especie_imovel.nome as especieDesc,
                           situacao_propriedade.nome as sitpropriedadeDesc,
                           estado_conservacao.nome as estadoconservacaoDesc,
                           gravame.nome as gravameDesc,
                           imoveis.ccir,
                           imoveis.nirf,
                           imoveis.latitude,
                           imoveis.longitude');
        $this->db->from('imoveis'); 
        $this->db->join('municipio', 'imoveis.municipio = municipio.id','left');
        $this->db->join('especie_imovel', 'imoveis.especie = especie_imovel.id','left');
        $this->db->join('situacao_propriedade', 'imoveis.sitpropriedade = situacao_propriedade.id','left');    
        $this->db->join('estado_conservacao', 'imoveis.estadoconservacao = estado_conservacao.id','left');       
        $this->db->join('gravame', 'imoveis.gravame = gravame.id','left');
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('tipo',1);
        // Verifica se o parametros está "setado"
        // Tem que ser !== null porque o php reconhece "0" e "false" como vazio
        if($exploradoagricola !== null){
            $this->db->where('exploradoagricola', $exploradoagricola);
        }
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result();
    }
        
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosUrbanos($empresa,$cpfcnpj){
        $this->db->select('imoveis.id,
                           imoveis.cpfcnpj,
                           imoveis.nome,
                           imoveis.especie,
                           imoveis.matricula,
                           imoveis.registro,
                           imoveis.cep,
                           imoveis.endereco,
                           imoveis.nroendereco,
                           imoveis.bairro,
                           imoveis.municipio,
                           imoveis.part,
                           imoveis.sitpropriedade,
                           imoveis.estadoconservacao,
                           imoveis.gravame,
                           format(areaterreno,2,\'de_DE\') as areaterreno,
                           format(areaconstruida,2,\'de_DE\') as areaconstruida,
                           format(valortotal,2,\'de_DE\') as valortotal,
                           municipio.nome as municipioDesc,
                           municipio.uf as uf,
                           especie_imovel.nome as especieDesc,
                           situacao_propriedade.nome as sitpropriedadeDesc,
                           estado_conservacao.nome as estadoconservacaoDesc,
                           gravame.nome as gravameDesc');
        $this->db->from('imoveis'); 
        $this->db->join('municipio', 'imoveis.municipio = municipio.id','left');
        $this->db->join('especie_imovel', 'imoveis.especie = especie_imovel.id','left');
        $this->db->join('situacao_propriedade', 'imoveis.sitpropriedade = situacao_propriedade.id','left');    
        $this->db->join('estado_conservacao', 'imoveis.estadoconservacao = estado_conservacao.id','left');       
        $this->db->join('gravame', 'imoveis.gravame = gravame.id','left');
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('tipo',2);
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result();
    }
}