<?php

class M_ExploracaoPecuaria extends CI_Model{
    // Busca Próximo ID para inserir registro
    public function nextId($empresa,$cpfcnpj){
        $this->db->select('case when max(id) is null then 1 else max(id)+1 end proximo');
        $this->db->from('exploracao_pecuaria'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get()->row()->proximo; 
        return $query;
    }
    
    // Busca um determinado registro
    public function buscarRegistro($empresa,$cpfcnpj,$id){
        $this->db->select('exploracao_pecuaria.*');
        $this->db->from('exploracao_pecuaria'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('id',$id);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        return $this->db->insert('exploracao_pecuaria',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($empresa,$cpfcnpj,$id,$dados){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id', $id);
        return $this->db->update('exploracao_pecuaria', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($empresa,$cpfcnpj,$id){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        $this->db->where('id', $id);
        return $this->db->delete('exploracao_pecuaria');
    }
    
    // Busca as informações de Produção Pecuária para a Tela de Procura
    public function buscarProducaoPecuariaTelaProcura($empresa,$cpfcnpj){
        $this->db->select('exploracao_pecuaria.id,
                           exploracao_pecuaria.atividade,
                           atividade_pecuaria.nome as atividadeDesc, 
                           concat(DATE_FORMAT(exploracao_pecuaria.datainicioproducaoobtida,\'%m/%Y\'), \' à \', DATE_FORMAT(exploracao_pecuaria.datafimproducaoobtida,\'%m/%Y\')) as periodoproducaoObtida,
                           concat(DATE_FORMAT(exploracao_pecuaria.datainicioproducaoprevista,\'%m/%Y\'), \' à \', DATE_FORMAT(exploracao_pecuaria.datafimproducaoprevista,\'%m/%Y\')) as periodoproducaoPrevista');
        $this->db->from('exploracao_pecuaria'); 
        $this->db->join('atividade_pecuaria', 'exploracao_pecuaria.atividade = atividade_pecuaria.id','left');
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->order_by('id');
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // Busca as informações de Produção Pecuária para a Tela de Procura
    public function buscarProducoesPecuariaCliente($empresa,$cpfcnpj){
        $this->db->select('exploracao_pecuaria.id,
                           exploracao_pecuaria.municipio,
                           exploracao_pecuaria.atividade,
                           exploracao_pecuaria.sistemaproducaoobtida,
                           exploracao_pecuaria.sistemaproducaoprevista,
                           exploracao_pecuaria.produtividadeobtida,
                           exploracao_pecuaria.produtividadeprevista,
                           exploracao_pecuaria.datainicioproducaoobtida,
                           exploracao_pecuaria.datafimproducaoobtida,
                           exploracao_pecuaria.datainicioproducaoprevista,
                           exploracao_pecuaria.datafimproducaoprevista,
                           exploracao_pecuaria.participacaoobtida,
                           exploracao_pecuaria.participacaoprevista,
                           exploracao_pecuaria.quantidadeobtida,
                           exploracao_pecuaria.quantidadeprevista,
                           exploracao_pecuaria.quantidadeciclosanoobtida,
                           exploracao_pecuaria.quantidadeciclosanoprevista,
                           exploracao_pecuaria.precoobtida,
                           exploracao_pecuaria.precoprevista,
                           exploracao_pecuaria.producaototalobtida,
                           exploracao_pecuaria.producaototalprevista,
                           exploracao_pecuaria.producaounidadefinanciamentoobtida,
                           exploracao_pecuaria.producaounidadefinanciamentoprevista,
                           exploracao_pecuaria.custoproducaoobtida,
                           exploracao_pecuaria.custoproducaoprevista,
                           exploracao_pecuaria.custoproducaounidadeobtida,
                           exploracao_pecuaria.custoproducaounidadeprevista,
                           exploracao_pecuaria.receitacomvendaobtida,
                           exploracao_pecuaria.receitacomvendaprevista,
                           exploracao_pecuaria.receitatotalobtida,
                           exploracao_pecuaria.receitatotalprevista,
                           exploracao_pecuaria.receitatotalunidadefinanciamentoobtida,
                           exploracao_pecuaria.receitatotalunidadefinanciamentoprevista,
                           exploracao_pecuaria.custototalcomarrendamentoobtida,
                           exploracao_pecuaria.custototalcomarrendamentoprevista,
                           exploracao_pecuaria.receitaliquidaanoobtida,
                           exploracao_pecuaria.receitaliquidaanoprevista,
                           exploracao_pecuaria.tratoresimplementosterceirosobtida,
                           exploracao_pecuaria.tratoresimplementosterceirosprevista,
                           municipio.nome as municipioDesc,
                           atividade_pecuaria.nome as nomeatividade,
                           atividade_pecuaria.atividade as codigoatividade,
                           atividade_pecuaria.faseexploracao,
                           atividade_pecuaria.unidadeprodutividade,
                           atividade_pecuaria.unidadefinanciamento,
                           atividade_pecuaria.obs1,
                           atividade_pecuaria.unidadeproducao,
                           atividade_pecuaria.produtoprincipal,
                           atividade_pecuaria.obs2,
                           atividade_pecuaria.produto2,
                           atividade_pecuaria.produto3,
                           atividade_pecuaria.produto4,
                           atividade_pecuaria.produto5,
                           atividade_pecuaria.produto6,
                           atividade_pecuaria.produto7,');
        $this->db->from('exploracao_pecuaria');
        $this->db->join('atividade_pecuaria', 'exploracao_pecuaria.atividade = atividade_pecuaria.id','left');
        $this->db->join('municipio', 'exploracao_pecuaria.municipio = municipio.id','left');
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->order_by('exploracao_pecuaria.id');
        $query = $this->db->get(); 
        return $query->result();
    }
    
    public function buscarResumoExploracaoPecuaria($empresa,$cpfcnpj){
        $this->db->select('sum(receitatotalobtida) as receitabrutaanualobtida,
                          sum(receitaliquidaanoobtida) as receitaliquidaanualobtida,
                          (sum(receitaliquidaanoobtida)/12) receitaliquidamensalobtida,
                          sum(receitatotalprevista) as receitabrutaanualprevista,
                          sum(receitaliquidaanoprevista) as receitaliquidaanualprevista,
                          (sum(receitaliquidaanoprevista)/12) receitaliquidamensalprevista');
        $this->db->from('exploracao_pecuaria'); 
        $this->db->where('empresa', $empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get();
        //retorna apenas o primeiro registro
        return $query->result()[0];
    }
}