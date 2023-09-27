<?php

class M_Raca extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('raca.*,grupo_especie.nome as grupoDesc');        
        $this->db->join('grupo_especie', 'raca.grupo = grupo_especie.id','left');
        $query = $this->db->get('raca');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('raca',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('raca',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('raca', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('raca');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaRacaCombo($especie){
        $this->db->distinct();
        $this->db->select('raca.id, raca.nome');
        $this->db->from('raca');       
        $this->db->join('especie_semovente', 'especie_semovente.grupo = raca.grupo','');
        $this->db->where('especie_semovente.id',$especie);
        $query = $this->db->get(); 
        return $query;
    }
}