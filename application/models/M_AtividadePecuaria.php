<?php

class M_AtividadePecuaria extends CI_Model{
    
    // Função para buscar todos os registros para criar um combobox
    public function buscaAtividadePecuariaCombo(){
        $this->db->select('*');
        $this->db->from('atividade_pecuaria');
        $consulta = $this->db->get();
        return $consulta;
    }
}