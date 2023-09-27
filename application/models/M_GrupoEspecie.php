<?php

class M_GrupoEspecie extends CI_Model{
    // Busca os dados da tabela para preencher o grid
    public function buscarDadosGrid(){
        $this->db->select('*');        
        $query = $this->db->get('grupo_especie');
        return $query->result();
    }
    
    // Busca um determinado registro
    public function buscarRegistro($where){
        $query = $this->db->get_where('grupo_especie',array('id'=> $where));
        return $query;
    }
    
    // Função para inserir um registro
    public function inserir($dados){
        $this->db->insert('grupo_especie',$dados);
    }
    
    // Função para alterar um registro
    public function alterar($id,$dados){
        $this->db->where('id', $id);
        $this->db->update('grupo_especie', $dados);
    }
    
    // Função para excluir um registro
    public function excluir($id){
        $this->db->where('id', $id);
        $this->db->delete('grupo_especie');
    }
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaGrupoEspecieCombo(){
        $this->db->select('*');
        $this->db->from('grupo_especie');
        $consulta = $this->db->get();
        return $consulta;
    }
}