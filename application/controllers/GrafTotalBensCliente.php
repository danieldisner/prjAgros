<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GrafTotalBensCliente extends MY_Controller{
    
    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_grafTotalBensCliente';
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        $this->load->view('v_layout',$dados);
    }
    
    public function dadosGrafico(){
        // Carrega o Model
        $this->load->model('M_Cliente', 'modelCliente');
        $result = $this->modelCliente->buscaDadosGraficoTotalBens($this->session->userdata('empresa')); 
        echo json_encode($result);
    }
}
