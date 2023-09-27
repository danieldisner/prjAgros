<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CadRaca extends MY_Controller{
    // Campos Usados no Preenchimento dos Formularios
    protected $camposForm = array('id'=>'','nome'=>'', 'btnIncluir'=>'false','btnAlterar'=>'false','btnExcluir'=>'false');

    public function index(){
        // Consulta os menus
        $consulta = $this->modelMenu->buscaMenus($this->session->userdata('grupo'));
        // Atribui ao array dados o nome da View
        $dados['nome_view'] = 'v_cadRaca';
        
        // Busca os Grupos de Espécies
        $this->load->model('M_GrupoEspecie', 'modelGrupoEspecie');
        $tiposImovel = $this->modelGrupoEspecie->buscaGrupoEspecieCombo();
        $dados['gruposEspecie'] = $tiposImovel->result_array(); 
        
        // Atribui ao array dados o os Menus que tem Permissão
        $dados['menus'] = $consulta->result_array();
        $this->load->view('v_layout',$dados);
    }
    
    public function buscaRegistro(){
        // Carrega o Model
        $this->load->model('M_Raca', 'modelRaca');
        // Busca o Registro
        $result = $this->modelRaca->buscarRegistro($this->input->post('id'));
        // Verifica se encontrou o registro e atribui os dados aos campos do formulário
        if($result->num_rows() > 0){
            $this->camposForm['id']         = $result->row()->id;
            $this->camposForm['nome']       = $result->row()->nome;
            $this->camposForm['grupo']       = $result->row()->grupo;
            $this->camposForm['btnIncluir'] = false;
            $this->camposForm['btnAlterar'] = true;
            $this->camposForm['btnExcluir'] = true;
        }else{
            $this->camposForm['id']         = '';
            $this->camposForm['nome']       = '';
            $this->camposForm['grupo']      = 1;
            $this->camposForm['btnIncluir'] = true;
            $this->camposForm['btnAlterar'] = false;
            $this->camposForm['btnExcluir'] = false;
        }
        echo json_encode($this->camposForm);
    }

    public function incluir(){
        // Carrega o Model
        $this->load->model('M_Raca', 'modelRaca');
        // Insere os dados
        $this->modelRaca->inserir($this->input->post());
        // Log de usuário
        $log = array(
          'empresa' => $this->session->userdata('empresa'),
          'usuario' => $this->session->userdata('usuario'),
          'acao'    => 16,
          'registro'=> 'ID: ' . $this->db->insert_id()
        );
        $this->modelLogUsuario->gravarLog($log);
    }
    
    public function alterar(){
        // Carrega o Model
        $this->load->model('M_Raca', 'modelRaca');
        // Prepara o Array com os dados a serem inseridos
        $dados = array(
            'nome' => $this->input->post('nome'),
            'grupo' => $this->input->post('grupo')
        );
        // Insere os dados
        $this->modelRaca->alterar($this->input->post('id'),$dados);      
        // Log de usuário
        $log = array(
          'empresa' => $this->session->userdata('empresa'),
          'usuario' => $this->session->userdata('usuario'),
          'acao'    => 17,
          'registro'=> 'ID: ' . $this->input->post('id')
        );
        $this->modelLogUsuario->gravarLog($log);  
    }
    
    public function excluir(){
        // Carrega o Model
        $this->load->model('M_Raca', 'modelRaca');
        // Insere os dados
        $this->modelRaca->excluir($this->input->post('id'));   
        
        // Log de usuário
        $log = array(
          'empresa' => $this->session->userdata('empresa'),
          'usuario' => $this->session->userdata('usuario'),
          'acao'    => 18,
          'registro'=> 'ID: ' . $this->input->post('id')
        );
        $this->modelLogUsuario->gravarLog($log);  
    }
    
    public function dadosGrid(){
        // Carrega o Model
        $this->load->model('M_Raca', 'modelRaca');
        
        $result = $this->modelRaca->buscarDadosGrid(); 
        
        $dados = array(
            'num_rows'=>count($result),
            'rows' => $result            
        );
        echo json_encode($dados);
    }
}
