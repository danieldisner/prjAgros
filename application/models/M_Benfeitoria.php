<?php

class M_Benfeitoria extends CI_Model{
    // Função para buscar todos os registros para criar um combobox
    public function buscaBenfeitoriaCombo(){
        $this->db->select('*');
        $this->db->from('benfeitoria');
        $consulta = $this->db->get();
        return $consulta;
    }
}