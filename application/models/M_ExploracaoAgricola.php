<?php

class M_ExploracaoAgricola extends CI_Model{
    // Busca Próximo ID para inserir registro
    public function nextId($empresa,$cpfcnpj){
        $this->db->select('case when max(id) is null then 1 else max(id)+1 end proximo');
        $this->db->from('exploracao_agricola'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get()->row()->proximo; 
        return $query;
    }
    
    // Busca um determinado registro
    public function buscarRegistro($empresa,$cpfcnpj,$id){
        $this->db->select('exploracao_agricola.*');
        $this->db->from('exploracao_agricola'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('id',$id);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        return $this->db->insert('exploracao_agricola',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($empresa,$cpfcnpj,$id,$dados){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id', $id);
        return $this->db->update('exploracao_agricola', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($empresa,$cpfcnpj,$id){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id', $id);
        return $this->db->delete('exploracao_agricola');
    }
    
    // Busca as informações de Produção Agrícola para a Tela de Procura
    public function buscarProducaoAgricolaTelaProcura($empresa,$cpfcnpj){
        $this->db->select('exploracao_agricola.id,
                           exploracao_agricola.atividade,
                           produtos_agricola.nome as atividadeDesc,
                           exploracao_agricola.tipocultivo,
                           tipo_cultivo.nome as tipocultivoDesc,
                           concat(exploracao_agricola.anosafrainicioobtida, \'/\', exploracao_agricola.anosafrafimobtida) as safraObtida,
                           concat(exploracao_agricola.anosafrainicioprevista, \'/\', exploracao_agricola.anosafrafimprevista) as safraPrevista');
        $this->db->from('exploracao_agricola'); 
        $this->db->join('produtos_agricola', 'exploracao_agricola.atividade = produtos_agricola.id','left');
        $this->db->join('tipo_cultivo', 'exploracao_agricola.tipocultivo = tipo_cultivo.id','left');
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // Busca as informações de Produção Agrícola para a Tela de Procura
    public function buscarProducoesAgricolaCliente($empresa,$cpfcnpj){
        $this->db->select('exploracao_agricola.id,
                           exploracao_agricola.municipio,
                           exploracao_agricola.atividade,
                           exploracao_agricola.sistemaproducaoobtida,
                           exploracao_agricola.sistemaproducaoprevista,
                           exploracao_agricola.tipocultivo,
                           exploracao_agricola.irrigacao,
                           exploracao_agricola.datainiciocolheitaobtida,
                           exploracao_agricola.datafimcolheitaobtida,
                           exploracao_agricola.datainiciocolheitaprevista,
                           exploracao_agricola.datafimcolheitaprevista,
                           exploracao_agricola.datainiciocomercializacaoobtida,
                           exploracao_agricola.datafimcomercializacaoobtida,
                           exploracao_agricola.datainiciocomercializacaoprevista,
                           exploracao_agricola.datafimcomercializacaoprevista,
                           exploracao_agricola.datainicioproducaoobtida,
                           exploracao_agricola.datafimproducaoobtida,
                           exploracao_agricola.datainicioproducaoprevista,
                           exploracao_agricola.datafimproducaoprevista,
                           exploracao_agricola.anosafrainicioobtida,
                           exploracao_agricola.anosafrafimobtida,
                           exploracao_agricola.anosafrainicioprevista,
                           exploracao_agricola.anosafrafimprevista,
                           exploracao_agricola.participacaoobtida,
                           exploracao_agricola.participacaoprevista,
                           exploracao_agricola.areaobtida,
                           exploracao_agricola.areaprevista,
                           exploracao_agricola.precounitarioobtida,
                           exploracao_agricola.precounitarioprevista,
                           exploracao_agricola.produtividadeprevistaobtida,
                           exploracao_agricola.produtividadeprevistaprevista,
                           exploracao_agricola.produtividadeobtidaobtida,
                           exploracao_agricola.frustracaosafraobtida,
                           exploracao_agricola.receitabrutaobtida,
                           exploracao_agricola.receitabrutaprevista,
                           exploracao_agricola.custoproducaohectareobtida,
                           exploracao_agricola.custoproducaohectareprevista,
                           exploracao_agricola.custoproducaototalobtida,
                           exploracao_agricola.custoproducaototalprevista,
                           exploracao_agricola.custototalcomarrendamentoobtida,
                           exploracao_agricola.custototalcomarrendamentoprevista,
                           exploracao_agricola.tratoresimplementosterceirosobtida,
                           exploracao_agricola.tratoresimplementosterceirosprevista,
                           exploracao_agricola.colheitadeirasterceirosobtida,
                           exploracao_agricola.colheitadeirasterceirosprevista,
                           exploracao_agricola.receitaunidadeproducaoobtida,
                           exploracao_agricola.receitaunidadeproducaoprevista,
                           exploracao_agricola.receitaliquidaobtida,
                           exploracao_agricola.receitaliquidaprevista,
                           produtos_agricola.nome as nomeproduto,
                           produtos_agricola.codigoatividade,
                           produtos_agricola.unidade,
                           case irrigacao when 0 or null then \'NÃO\' else \'SIM\' end as irrigacaoDesc,
                           case frustracaosafraobtida when 0 then \'NÃO\' else \'SIM\' end as frustracaosafraobtida,
                           municipio.nome as municipioDesc,
                           tipo_cultivo.nome as tipocultivoDesc');
        $this->db->from('exploracao_agricola');
        $this->db->join('produtos_agricola', 'exploracao_agricola.atividade = produtos_agricola.id','left');
        $this->db->join('tipo_cultivo', 'exploracao_agricola.tipocultivo = tipo_cultivo.id','left');
        $this->db->join('municipio', 'exploracao_agricola.municipio = municipio.id','left');
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->order_by('exploracao_agricola.id');
        $query = $this->db->get(); 
        return $query->result();
    }
    
    public function buscarResumoExploracaoAgricola($empresa,$cpfcnpj){
        $this->db->select('sum(receitabrutaobtida) as receitabrutaanualobtida,
                            sum(receitaliquidaobtida) as receitaliquidaanualobtida,
                            (sum(receitaliquidaobtida)/12) receitaliquidamensalobtida,
                            sum(receitabrutaprevista) as receitabrutaanualprevista,
                            sum(receitaliquidaprevista) as receitaliquidaanualprevista,
                            (sum(receitaliquidaprevista)/12) receitaliquidamensalprevista');
        $this->db->from('exploracao_agricola'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get();
        //retorna apenas o primeiro registro
        return $query->result()[0];
    }
}