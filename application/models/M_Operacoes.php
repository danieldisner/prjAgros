<?php

class M_Operacoes extends CI_Model{    
    // Busca um determinado registro
    public function buscarRegistro($empresa,$cpfcnpj,$tipooperacao,$finalidade,$ciclocanoinicio,$ciclocanofim){
        $this->db->select('tipooperacao,
                          finalidade,
                          ciclocanoinicio,
                          ciclocanofim,
                          status,
                          linhacreditoprojeto,
                          format(taxajurosprojeto,2,\'de_DE\') as taxajurosprojeto,
                          DATE_FORMAT(datainicioprojeto, \'%d/%m/%Y\') as datainicioprojeto,
                          DATE_FORMAT(dataconclusaoprojeto, \'%d/%m/%Y\') as dataconclusaoprojeto,
                          aprovado,
                          linhacreditoanalise,
                          DATE_FORMAT(dataliberacaoanalise, \'%d/%m/%Y\') as dataliberacaoanalise,
                          format(taxajurosanalise,2,\'de_DE\') as taxajurosanalise,
                          DATE_FORMAT(prazoanalise, \'%d/%m/%Y\') as prazoanalise,
                          DATE_FORMAT(datareembolsoanalise, \'%d/%m/%Y\') as datareembolsoanalise,
                          DATE_FORMAT(dataconclusaoanalise, \'%d/%m/%Y\') as dataconclusaoanalise');
        $this->db->from('operacoes'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('tipooperacao',$tipooperacao);
        $this->db->where('finalidade',$finalidade);
        $this->db->where('ciclocanoinicio',$ciclocanoinicio);
        $this->db->where('ciclocanofim',$ciclocanofim);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Função para inserir um registro
    public function incluir($dados){
       return $this->db->insert('operacoes',$dados);
    }
    
    // Função para inserir um registro
    public function alterar($empresa,$cpfcnpj,$tipooperacao,$finalidade,$ciclocanoinicio,$ciclocanofim,$dados){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('tipooperacao',$tipooperacao);
        $this->db->where('finalidade',$finalidade);
        $this->db->where('ciclocanoinicio',$ciclocanoinicio);
        $this->db->where('ciclocanofim',$ciclocanofim);
        return $this->db->update('operacoes',$dados);
    }
    
    // Função para excluir todos os registros do cliente
    public function excluir($empresa,$cpfcnpj,$tipooperacao,$finalidade,$ciclocanoinicio,$ciclocanofim){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $this->db->where('tipooperacao',$tipooperacao);
        $this->db->where('finalidade',$finalidade);
        $this->db->where('ciclocanoinicio',$ciclocanoinicio);
        $this->db->where('ciclocanofim',$ciclocanofim);
        return $this->db->delete('operacoes');
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid($empresa,$cpfcnpj){
        $this->db->select('tipooperacao,
                          finalidade,
                          ciclocanoinicio,
                          ciclocanofim,
                          status,
                          linhacreditoprojeto,
                          format(taxajurosprojeto,2,\'de_DE\') as taxajurosprojeto,
                          DATE_FORMAT(datainicioprojeto, \'%d/%m/%Y\') as datainicioprojeto,
                          DATE_FORMAT(dataconclusaoprojeto, \'%d/%m/%Y\') as dataconclusaoprojeto,
                          aprovado,
                          linhacreditoanalise,
                          DATE_FORMAT(dataliberacaoanalise, \'%d/%m/%Y\') as dataliberacaoanalise,
                          format(taxajurosanalise,2,\'de_DE\') as taxajurosanalise,
                          DATE_FORMAT(prazoanalise, \'%d/%m/%Y\') as prazoanalise,
                          DATE_FORMAT(datareembolsoanalise, \'%d/%m/%Y\') as datareembolsoanalise,
                          DATE_FORMAT(dataconclusaoanalise, \'%d/%m/%Y\') as dataconclusaoanalise');
        $this->db->from('operacoes'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosRelatorioProcessos($empresa,$cpfcnpj,$ciclocanoinicio = NULL,$ciclocanofim = NULL){
        $this->db->select('tipooperacao,
                          finalidade,
                          ciclocanoinicio,
                          ciclocanofim,
                          status,
                          linhacreditoprojeto,
                          format(taxajurosprojeto,2,\'de_DE\') as taxajurosprojeto,
                          DATE_FORMAT(datainicioprojeto, \'%d/%m/%Y\') as datainicioprojeto,
                          DATE_FORMAT(dataconclusaoprojeto, \'%d/%m/%Y\') as dataconclusaoprojeto,
                          aprovado,
                          linhacreditoanalise,
                          DATE_FORMAT(dataliberacaoanalise, \'%d/%m/%Y\') as dataliberacaoanalise,
                          format(taxajurosanalise,2,\'de_DE\') as taxajurosanalise,
                          DATE_FORMAT(prazoanalise, \'%d/%m/%Y\') as prazoanalise,
                          DATE_FORMAT(datareembolsoanalise, \'%d/%m/%Y\') as datareembolsoanalise,
                          DATE_FORMAT(dataconclusaoanalise, \'%d/%m/%Y\') as dataconclusaoanalise');
        $this->db->from('operacoes'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        // Verifica se o parâmetro está vazio
        if(!empty($ciclocanoinicio)){
            $this->db->where('ciclocanoinicio',$ciclocanoinicio);
        }
        if(!empty($ciclocanofim)){
            $this->db->where('ciclocanofim',$ciclocanofim);
        }
        $this->db->order_by('ciclocanoinicio,ciclocanofim', 'desc');
        $query = $this->db->get(); 
        return $query->result();
    }
}