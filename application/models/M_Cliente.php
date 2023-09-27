<?php

class M_Cliente extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('cliente');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($empresa,$cpfcnpj){
        $this->db->select('cliente.*,
                           agencia.nome as nomeAgencia,
                           agencia.prefixo as prefixoAgencia,
                           municipio.nome as munDesc,
                           municipio.uf as uf');
        $this->db->from('cliente'); 
        $this->db->join('municipio', 'cliente.municipio = municipio.id','left');
        $this->db->join('agencia', 'cliente.agencia = agencia.id','left');
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Busca o nome do cliente
    public function buscarNomeCliente($empresa,$cpfcnpj){
        $this->db->select('cliente.cpfcnpj,
                           cliente.nome');
        $this->db->from('cliente'); 
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj',$cpfcnpj);
        $query = $this->db->get(); 
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        return $this->db->insert('cliente',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($empresa,$cpfcnpj,$dados){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        return $this->db->update('cliente', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($empresa,$cpfcnpj){
        $this->db->where('empresa',$empresa);
        $this->db->where('cpfcnpj', $cpfcnpj);
        return $this->db->delete('cliente');
    }
    
    // Busca um determinado registro
    public function buscaDadosGraficoTotalBens($empresa){
        // PREPARA A SUBQUERY
        // #1 SubQueries no.1 -------------------------------------------
        $this->db->select('cliente.nome, 
                           sum(semoventes.valortotal) as TotalSemoventes,
                           0 as TotalImoveisRurais,
                           0 as TotalImoveisUrbanos,
                           0 as TotalMoveis');
        $this->db->join('semoventes', 'cliente.empresa = semoventes.empresa and cliente.cpfcnpj = semoventes.cpfcnpj');
        $this->db->from('cliente');
        $this->db->where('cliente.empresa',$empresa);
        $this->db->group_by('cliente.nome');
        $subQuery1 = $this->db->get_compiled_select();
        
        // #2 SubQueries no.2 -------------------------------------------
        $this->db->select('cliente.nome,
                           0 as TotalSemoventes,
                           sum(imoveis.valorterranua) as TotalImoveisRurais,
                           sum(imoveis.valortotal) as TotalImoveisUrbanos,
                           0 as TotalMoveis');
        $this->db->from('cliente');
        $this->db->where('cliente.empresa',$empresa);
        $this->db->join('imoveis', 'cliente.empresa = imoveis.empresa and cliente.cpfcnpj = imoveis.cpfcnpj');
        $this->db->group_by('cliente.nome');
        $subQuery2 = $this->db->get_compiled_select();
        
        // #3 SubQueries no.3 -------------------------------------------
        $this->db->select('cliente.nome,
                           0 as TotalSemoventes,
                           0 as TotalImoveisRurais,
                           0 as TotalImoveisUrbanos,
                           sum(moveis.valor) as TotalMoveis');
        $this->db->from('cliente');
        $this->db->where('cliente.empresa',$empresa);
        $this->db->join('moveis', 'cliente.empresa = moveis.empresa and cliente.cpfcnpj = moveis.cpfcnpj');
        $this->db->group_by('cliente.nome');
        $subQuery3 = $this->db->get_compiled_select();
        
        // Query Principal
        $this->db->select('SUBQUERY.nome,
                          sum(TotalSemoventes) as TotalSemoventes,
                          sum(TotalImoveisRurais) as TotalImoveisRurais,
                          sum(TotalImoveisUrbanos) as TotalImoveisUrbanos,
                          sum(TotalMoveis) as TotalMoveis');
        $this->db->from('('.$subQuery1. ' UNION ' . $subQuery2 . ' UNION ' . $subQuery3 . ') as SUBQUERY');
        $this->db->group_by('SUBQUERY.nome');
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistroRelatorioProcessos($empresa,$cpfcnpj = NULL){
        $this->db->select('cliente.*,
                           agencia.nome as nomeAgencia,
                           agencia.prefixo as prefixoAgencia,
                           municipio.nome as munDesc,
                           municipio.uf as uf');
        $this->db->from('cliente'); 
        $this->db->join('municipio', 'cliente.municipio = municipio.id','left');
        $this->db->join('agencia', 'cliente.agencia = agencia.id','left');
        $this->db->where('empresa',$empresa);
        // Se tiver Informado o cliente
        if(!empty($cpfcnpj)){
            $this->db->where('cpfcnpj',$cpfcnpj);
        }
        $query = $this->db->get(); 
        return $query->result();
    }
    
    // Busca o nome do cliente
    public function buscarClienteProcura($empresa,$nome){
        $this->db->select('cliente.cpfcnpj,
                           cliente.nome');
        $this->db->from('cliente'); 
        $this->db->where('empresa',$empresa);
        $this->db->like('nome',$nome);
        $query = $this->db->get(); 
        return $query->result();
    }
}