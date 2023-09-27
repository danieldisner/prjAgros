<?php

class M_Menus extends CI_Model{
    // Função responsável por buscar os menus que o grupo possui autorização
    public function buscaMenus($grupo){
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->join('autorizacao', 'menu.nome = autorizacao.menu');
        $this->db->where('autorizacao.grupo = ',$grupo);
        $this->db->order_by('ordem');

        $consulta = $this->db->get();

        return $consulta;
    }
}