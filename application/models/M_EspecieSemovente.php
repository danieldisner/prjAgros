<?php

class M_EspecieSemovente extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('especie_semovente.*,grupo_especie.nome as grupoDesc');        
        $this->db->join('grupo_especie', 'especie_semovente.grupo = grupo_especie.id','left');
        $query = $this->db->get('especie_semovente');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('especie_semovente',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $result = $this->db->insert('especie_semovente',$dados);
        return $result;
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('especie_semovente', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('especie_semovente');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaEspeciesSemoventeCombo(){
        $this->db->select('*');
        $this->db->from('especie_semovente');
        $consulta = $this->db->get();
        return $consulta;
    }
}