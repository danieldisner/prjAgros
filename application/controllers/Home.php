<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        $dados['nome_view'] = 'v_home';
        $dados['menus'] = $consulta->result_array();
        $dados['emailconfirmado'] = $this->session->userdata('confirmado');
        $this->load->view('v_layout',$dados);
    }
}
